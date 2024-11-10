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

class LoginController extends Controller
{
    public function index()
    {
        Auth::logout();
        return view('auth.login');
    }
   public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_name' => ['required','exists:users,user_name'],
            'password' =>  ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
            if(Auth()->user()->status == 0){
                Auth::logout();
                return redirect()->back()
                ->withErrors(['msg' => 'الحساب مجمد حالياً'])
                ->withInput();
            }
            $data['user_id'] = Auth()->id();
            $data['id_no'] = Auth()->id();
            $data['ip'] = request()->ip();
            $data['table_name'] = 'users';
            $data['column_name'] = 'user_name';
            $data['old_value'] = Auth()->user()->user_name;
            $data['type_action'] = 'I';
            Log::create($data);
            session(['permission' => $this->getRolesUser()]);
            session(['permission_btn' => $this->getRolesBtnUser()]);
            // $listRouter = HeaderMenu()->pluck('url')->toArray();
            // foreach ($listRouter as $value) {
            //     if($value != '/'){
            //         return redirect()->route($value);
            //     }
            // }
            // return abort('404');
            return redirect()->route('dashboard');

        }

        return redirect()->back()->withErrors(["كلمة المرور خطأ"]);
    }
    public function logout()
    {
        Auth::logout();
        return  redirect()->route('login');
    }
    public function getRolesUser()
    {
        $roles = RolePage::has('RolePageUserLogin')->orderBy('ID')->get();
        return $roles;
    }
    public function getRolesBtnUser()
    {
        $roles = RoleBtnUser::where('user_id',Auth()->ID())->pluck('role_btns_id')->toArray();
        return $roles;
    }
}
