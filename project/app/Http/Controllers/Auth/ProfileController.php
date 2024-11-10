<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\RoleBtn;
use App\Models\RoleBtnUser;
use App\Models\RolePage;
use App\Models\RolePageUser;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    public function updatePassword(Request $request)
    {
        $role = [
            'current_password' => ['required'],
            'new_password' => ['required', Password::min(8)->numbers(),'confirmed','different:current_password'],
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-',$validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        $user = Auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return Response::json(array(
                'success' => false,
                'errors' => 'كلمة المرور الحالية خطأ'

            ));
        } else {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return Response::json(array('success' => true,'results'=>'تمت عملية تعديل كلمة المرور'));
        }

    }

}
