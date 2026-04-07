<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\RoleBtn;
use App\Models\RoleBtnUser;
use App\Models\RolePage;
use App\Models\RolePageUser;
//use App\Models\user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\dead\DeadController;

class LoginController extends Controller
{
    public function index()
    {

        Auth::logout();
        // dd(1);
        return view('auth.login');
    }


    public function login(Request $request)
    {
        try {
            DB::connection()->getPdo();

            // تحقق من صحة البيانات
            $validator = Validator::make($request->all(), [
                'user_name' => ['required', 'exists:user_tb,user_username'],
                'password'  => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors([
                    'msg' => 'اسم المستخدم أو كلمة المرور خاطئة ،يرجى المحاولة فيما بعد'
                ])->withInput();
            }

            // محاولة تسجيل الدخول
            if (Auth::attempt([
                'user_username' => $request->user_name,
                'password'      => $request->password
            ])) {

                $user = Auth::user();

                // تحقق من حالة الحساب
                if ($user->status == 0) {
                    Auth::logout();
                    return redirect()->back()
                        ->withErrors(['msg' => 'الحساب مجمد حالياً'])
                        ->withInput();
                }

                /** ===============================
                 *  Device Token Logic (المعدل)
                 * =============================== */

                // 🔴 1) حذف أي جلسات قديمة للمستخدم (طرد الجهاز السابق)
                DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->delete();

                // 🔴 2) إنشاء توكن جديد للجهاز الحالي
                $deviceToken = Str::uuid()->toString();

                // 🔴 3) تخزين التوكن في الجلسة
                session(['device_token' => $deviceToken]);

                // 🔴 4) تحديث التوكن في قاعدة البيانات
                DB::table('user_tb')
                    ->where('id', $user->id)
                    ->update([
                        'current_device_token' => $deviceToken
                    ]);

                /** ===============================
                 *  Log User Login
                 * =============================== */

                $user = User::where('id', $user->id)->first();

                $deadController = new DeadController();
                $deadController->logSearch('user_tb', $user->id ?: null, 'ID', json_encode($user), null, 'I');

                /** ===============================
                 *  Permissions
                 * =============================== */
                session(['permission'     => $this->getRolesUser()]);
                session(['permission_btn' => $this->getRolesBtnUser()]);

                return redirect()->route('welcome');
            }

            return redirect()->back()
                ->withErrors(['msg' => 'كلمة المرور خاطئة'])
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'msg' => 'النظام تحت الصيانة - خطأ في الاتصال بقاعدة البيانات، يرجى المحاولة فيما بعد'
            ])->withInput();
        }
    }
    public function logout(Request $request)
    {
        // تأكد من وجود مستخدم مسجّل دخوله
        if (Auth::check()) {
            // مسح توكن الجهاز من قاعدة البيانات
            DB::table('user_tb')
                ->where('id', Auth::id())
                ->update(['current_device_token' => null]);

            // تسجيل خروج المستخدم
            Auth::logout();
        }

        // تنظيف الجلسة
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // إعادة التوجيه إلى صفحة تسجيل الدخول
        return redirect()->away('http://10.20.10.100/perm/index.php/Login/');
    }

    public function getRolesUser()
    {

        $roles = RolePage::has('RolePageUserLogin')->orderBy('id')->get();

        return $roles;
    }
    public function getRolesBtnUser()
    {
        // dd(Auth()->id());
        $roles = RoleBtnUser::where('user_id', Auth()->id())->pluck('role_btns_id')->toArray();
        return $roles;
    }
    function login_from_perm($h)
    {
        // جلب بيانات المستخدم من API خارجي
        $homepage = file_get_contents('http://10.20.10.100/perm/index.php/Api/get_priv_byid/' . $h . '/186');
        $users = json_decode($homepage, true);

        if (!isset($users['USERS'][0]['USER_ID'])) {
            return abort(404);
        }

        $user_id = $users['USERS'][0]['USER_ID'];
        $user = User::where('user_id_no', $user_id)->first();

        if (!$user) {
            return abort(404);
        }

        // محاولة تسجيل الدخول
        Auth::login($user);

        // التحقق من حالة الحساب
        if ($user->status == 0) {
            Auth::logout();
            return abort(404);
        }

        /** ===============================
         *  Device Token Logic
         * =============================== */
        // if ($user->current_device_token) {
        //     Auth::logout();
        //     return redirect()->away('http://10.20.10.100/perm/index.php/Login/')
        //         ->withErrors(['msg' => 'تم تسجيل دخول الحساب من جهاز آخر. يرجى المحاولة لاحقاً']);
        // }
        // 🔴 1) حذف أي جلسات قديمة للمستخدم (طرد الجهاز السابق)
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->delete();

        // 🔴 2) إنشاء توكن جديد للجهاز الحالي
        $deviceToken = Str::uuid()->toString();

        // 🔴 3) تخزين التوكن في الجلسة
        session(['device_token' => $deviceToken]);

        // 🔴 4) تحديث التوكن في قاعدة البيانات
        DB::table('user_tb')
            ->where('id', $user->id)
            ->update([
                'current_device_token' => $deviceToken
            ]);
        /** ===============================
         *  تسجيل الـ Log
         * =============================== */

        $deadController = new DeadController();
        $deadController->logSearch('user_tb', $user->id ?: null, 'ID', json_encode($user), null, 'I');
        /** ===============================
         *  Permissions
         * =============================== */
        session(['permission'     => $this->getRolesUser()]);
        session(['permission_btn' => $this->getRolesBtnUser()]);


        return redirect()->route('welcome');
    }
    public function tabLogout(Request $request)
    {
        if (Auth::check()) {

            // حذف التوكن فقط إذا كان يخص هذا الجهاز
            DB::table('user_tb')
                ->where('id', Auth::id())
                ->where('current_device_token', session('device_token'))
                ->update(['current_device_token' => null]);

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->noContent();
    }
}
