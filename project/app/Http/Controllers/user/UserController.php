<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\C_DETAILS_REFERRAL_TB;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::get();

        //$data['hospitals'] = Constant::where('parent_id',7)->get();
        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

//dd($data['hospitals']);
        return view('user.index',$data);
    }
    public function insert_user(Request $request)
    {
        $role = [
            'user_full_name' => 'required|unique:user_tb|max:255',
            'user_dref_cd' => 'nullable|exists:C_DETAILS_REFERRAL_TB,DREF_CODE',
            'password' => 'required|min:8|confirmed', // password_confirmation
            'user_username' => 'required|numeric|digits:9',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        try{
           // $data['insert_user_id'] = Auth()->id();
            $data['user_full_name'] = $request->user_full_name;
            $data['user_username'] = $request->user_username;
            $data['user_dref_cd'] = $request->user_dref_cd;
            $data['user_password'] = Hash::make($request->password);
            $data['user_id_no'] = $request->user_username;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['STATUS'] = 1;

           // dd(User::create($data));
            User::create($data);

        }catch (\Exception $exception){
            return Response::json(array('success' => false,'results'=>['message' => $exception.'يوجد خطأ في عملية الإدخال']));
        }
        return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية الإدخال بنجاح']));
    }
    public function update(Request $request)
    {
        $role = [
            'user_full_name' => 'required|unique:user_tb|max:255',
            'user_dref_cd' => 'nullable|exists:C_DETAILS_REFERRAL_TB,DREF_CODE',
            'user_username' => 'required|numeric|digits:9',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            )); // 400 being the HTTP code for an invalid request.
        }
        try{
            $user = User::findOrFail($request->id_user);
          //  dd($user);
            $data['user_full_name'] = $request->user_full_name;
            $data['user_username'] = $request->user_username;
            $data['user_dref_cd'] = $request->user_dref_cd;
            $data['updated_at'] = date('Y-m-d H:i:s');


            $user->update($data);
        }catch (\Exception $exception){
            return Response::json(array('success' => false,'results'=>['message' => $exception.'يوجد خطأ في عملية التعديل']));
        }
        return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية التعديل بنجاح']));
    }
    public function update_password(Request $request)
    {
        $role = [
            'id_user' => 'required|numeric|exists:users,id',
           'password' => 'required|min:8|confirmed', // password_confirmation
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        try{
            $user = User::findOrFail($request->id_user);
            $password  = $user->password;
            $user->password = Hash::make($request->password);
            $user->save();

            // $data = [];
            // $data['user_id'] = Auth()->id();
            // $data['id_no'] = Auth()->id();
            // $data['ip'] = request()->ip();
            // $data['table_name'] = 'users';
            // $data['column_name'] = 'password';
            // $data['old_value'] =$password;
            // $data['new_value'] =$user->password;
            // $data['type_action'] = 'U';
            // Log::create($data);
        }catch (\Exception $exception){
            return Response::json(array('success' => false,'results'=>['message' => $exception.'يوجد خطأ في عملية التعديل']));
        }
        return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية تعديل كلمة المرور بنجاح']));
    }

}
