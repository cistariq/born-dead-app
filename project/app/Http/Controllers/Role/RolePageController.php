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

class RolePageController extends Controller
{
    public function index()
    {
        $roles = RolePage::get();
        return view('roles.index',compact('roles'));
    }
    public function store(Request $request)
    {
        $role = [
            'page_id' => 'nullable|numeric|exists:role_pages,id',
            'page_name' => 'required|max:255',
            'p_url' => 'required|max:255',
            'follow_to_id' => 'nullable|exists:role_pages,id',
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
            $data['name'] = $request->page_name;
            $data['url'] = $request->p_url;
            $data['follow_to_id'] = $request->follow_to_id;
            if($request->page_id){
                $role_page = RolePage::findOrFail($request->page_id);
                $role_page->update($data);
            }else{
                $data['insert_user_id'] = Auth()->id();
                RolePage::create($data);
            }

        }catch (\Exception $exception){
            return Response::json(array('success' => false,'results'=>['message' => $exception.'يوجد خطأ في عملية الحفظ']));
        }
        return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية الحفظ بنجاح']));
    }
    public function page_user()
    {
        $data['users'] = User::get();
        return view('roles.page_user',$data);

    }
    public function getUserPageByUserId(Request $request)
    {
        $data['page_roles_main'] = RolePage::whereNull('follow_to_id')->get();
        $data['page_roles_parent'] = RolePage::whereNotNull('follow_to_id')->get();
        $data['roles_btn'] = RoleBtn::get();
        $data['page_roles_selected'] = RolePageUser::where('user_id',$request->user_id)->pluck('role_pages_id')->toArray();
        $data['roles_btns_selected'] = RoleBtnUser::where('user_id',$request->user_id)->pluck('role_btns_id')->toArray();
        return view('roles.role_user_tree',$data);
    }
    public function changeRolePageToUser(Request $request)
    {
        $role = [
            'user_id' => 'required',
            'role_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-',$validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        $rolePage = RolePageUser::where('user_id',$request->user_id)
            ->where('role_pages_id',$request->role_id)
            ->first();
        if($rolePage){
            $data['column_name'] = 'id';
            $data['old_value'] = $rolePage->user_id;
            $data['new_value'] = $rolePage->role_pages_id;
            $data['user_id'] = Auth()->id();
            $data['id_no'] = $rolePage->id;
            $data['ip'] = request()->ip();
            $data['table_name'] = 'role_page_users';
            $data['type_action'] = 'D';
           // $data['old_record'] = $rolePage;

            $rolePage->delete();
            Log::create($data);
            return Response::json(array('success' => true,'results'=>'تمت عملية سحب الصلاحية من المستخدم بنجاح'));
        }else{
            $data['user_id']= $request->user_id;
            $data['role_pages_id']= $request->role_id;
            $data['insert_user_id']=Auth()->id();
            $rolePage = RolePageUser::create($data);
            $data = [];
            $data['column_name'] = 'id';
            $data['old_value'] = $rolePage->user_id;
            $data['new_value'] = $rolePage->role_pages_id;
            $data['user_id'] = Auth()->id();
            $data['id_no'] = $rolePage->id;
            $data['ip'] = request()->ip();
            $data['table_name'] = 'role_page_users';
            $data['type_action'] = 'I';
            Log::create($data);

            return Response::json(array('success' => true,'results'=>'تمت عملية منح الصلاحية من للمستخدم بنجاح'));
        }
    }
}
