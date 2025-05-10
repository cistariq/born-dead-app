<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\RoleBtn;
use App\Models\RoleBtnUser;
use App\Models\RolePage;
use App\Models\RolePageUser;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {

        Auth::logout();
      //  dd(1);
        return view('auth.login');
    }


    public function login(Request $request)
    {
              try {
            DB::connection()->getPdo();

            $validator = Validator::make($request->all(),[
                'user_name' => ['required','exists:user_tb,user_username'],
                'password' =>  ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors(["اسم المستخدم أو كلمة المرور خاطئة ،يرجى المحاولة فيما بعد"]);
            }
           if (Auth::attempt(['user_username' => $request->user_name, 'password' => $request->password])) {
                if(Auth()->user()->status == 0){

                    Auth::logout();
                    return redirect()->back()
                    ->withErrors(['msg' => 'الحساب مجمد حالياً'])
                    ->withInput();
                }
                $data['user_id'] = Auth()->id();
                $data['id_no'] = Auth()->id();
                $data['ip'] = request()->ip();
                $data['table_name'] = 'user_tb';
                $data['column_name'] = 'user_name';
                $data['old_value'] = Auth()->user()->user_name;
                $data['type_action'] = 'I';
                Log::create($data);
                session(['permission' => $this->getRolesUser()]);
                session(['permission_btn' => $this->getRolesBtnUser()]);
                return redirect()->route('welcome');
            }
            return redirect()->back()->withErrors(["كلمة المرور خطأ"]);



        } catch (\Exception $e) {
            dd($e);
            // return "خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage();
            return redirect()->back()->withErrors(["النظام تحت الصيانة - خطأ في الاتصال بقاعدة البيانات، يرجى المحاولة فيما بعد "]);

        }
    }
    public function logout()
    {

        Auth::logout();
        return  redirect()->route('login');
    }
    public function getRolesUser()
    {
        $roles = RolePage::has('RolePageUserLogin')->orderBy('id')->get();
        return $roles;
    }
    public function getRolesBtnUser()
    {
        $roles = RoleBtnUser::where('user_id',Auth()->id())->pluck('role_btns_id')->toArray();
        return $roles;
    }
}
