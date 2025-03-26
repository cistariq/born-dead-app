<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Constant;
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
        $data['hospitals'] = Constant::where('parent_id',7)->get();
        return view('user.index',$data);
    }
    public function insert_user(Request $request)
    {
        $role = [
            'user_name' => 'required|unique:users|max:255',
            'hospital_id' => 'nullable|exists:constants,id',
            'password' => 'required|min:6|confirmed', // password_confirmation
            'id_no' => 'required|numeric|digits:9',
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
            $data['insert_user_id'] = Auth()->id();
            $data['name'] = $request->user_name;
            $data['user_name'] = $request->id_no;
            $data['hospital_id'] = $request->hospital_id;
            $data['password'] = Hash::make($request->password);
            User::create($data);
        }catch (\Exception $exception){
            return Response::json(array('success' => false,'results'=>['message' => $exception.'يوجد خطأ في عملية الإدخال']));
        }
        return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية الإدخال بنجاح']));
    }
    public function update(Request $request)
    {
        $role = [
            'id_user' => 'required|numeric|exists:users,id',
            'user_name' => 'required|unique:users|max:255',
            'hospital_id' => 'nullable|exists:constants,id',
            'status' => 'required|numeric|',Rule::in([1,2]),
            'id_no' => 'required|numeric|digits:9',
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
            $data['name'] = $request->user_name;
            $data['user_name'] = $request->id_no;
            $data['status'] = $request->status;
            $data['hospital_id'] = $request->hospital_id;
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
           'password' => 'required|min:6|confirmed', // password_confirmation
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

            $data = [];
            $data['user_id'] = Auth()->id();
            $data['id_no'] = Auth()->id();
            $data['ip'] = request()->ip();
            $data['table_name'] = 'users';
            $data['column_name'] = 'password';
            $data['old_value'] =$password;
            $data['new_value'] =$user->password;
            $data['type_action'] = 'U';
            Log::create($data);
        }catch (\Exception $exception){
            return Response::json(array('success' => false,'results'=>['message' => $exception.'يوجد خطأ في عملية التعديل']));
        }
        return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية تعديل كلمة المرور بنجاح']));
    }

}
