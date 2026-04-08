<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\RoleBtn;
use App\Models\RoleBtnUser;
use App\Models\RolePage;
use App\Models\RolePageUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\dead\DeadController;

class RoleBtnController extends Controller
{
    public function index()
    {
        $data['rolesPage'] = RolePage::get();
        $data['rolesBtn'] = RoleBtn::get();
        return view('roles.roles_btn.index',$data);
    }
    public function store(Request $request)
    {
        $role = [
            'btn_id' => 'nullable|numeric|exists:role_btns,id',
            'btn_name' => 'required|max:255',
            'follow_to_page' => 'exists:role_pages,id',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' =>$validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        try{
            $data['name'] = $request->btn_name;
            $data['follow_to_page'] = $request->follow_to_page;
            if($request->btn_id){
                $role_btn = RoleBtn::findOrFail($request->btn_id);
                $role_btn->update($data);
            }else{
                $data['insert_user_id'] = Auth()->id();
                RoleBtn::create($data);
            }

        }catch (\Exception $exception){
            return Response::json(array('success' => false,'results'=>['message' => $exception.'يوجد خطأ في عملية الحفظ']));
        }
        return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية الحفظ بنجاح']));
    }
    public function changeRoleBtnToUser(Request $request)
    {
        $role = [
            'user_id' => 'required|exists:user_tb,id',
            'role_btn_id' => 'required|exists:role_btns,id',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-',$validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        $roleBtn = RoleBtnUser::where('user_id',$request->user_id)
            ->where('role_btns_id',$request->role_btn_id)
            ->first();
          //  dd($roleBtn);

        if($roleBtn){

                $deadController = new DeadController();
                $deadController->logSearch('role_btn_users', $roleBtn->id ?: null, 'ID', json_encode($roleBtn->user_id), json_encode($roleBtn->role_btns_id), 'D');
            $roleBtn->delete();
            return Response::json(array('success' => true,'results'=>'تمت عملية سحب الصلاحية من المستخدم بنجاح'));
        }else{
            $data['user_id']= $request->user_id;
            $data['role_btns_id']= $request->role_btn_id;
            $data['insert_user_id']=Auth()->id();
           // dd($data);
            $rolePage = RoleBtnUser::create($data);
           // dd($rolePage);


                $deadController = new DeadController();
                $deadController->logSearch('role_btn_users', $rolePage->id ?: null, 'ID', json_encode($rolePage->user_id), json_encode($rolePage->role_pages_id), 'I');
            return Response::json(array('success' => true,'results'=>'تمت عملية منح الصلاحية من للمستخدم بنجاح'));
        }
    }
}
