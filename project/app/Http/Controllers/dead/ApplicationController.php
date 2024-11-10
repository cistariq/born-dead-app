<?php

namespace App\Http\Controllers\dead;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Constant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Session;

class ApplicationController extends Controller
{
    public function index()
    {
        $data['marital_status'] = Constant::where('parent_id',1)->get();
        $data['region'] = Constant::where('parent_id',25)->get();


        return view('dead.application.index', $data);
    }
    public function store(Request $request)
    {
       // dd($request);
        $role = [
            'ID_NO' => 'required|numeric|digits:9|unique:applications,id_no,'.$request->ID_NO,
            'NAME' => 'required',
            'NAME_APPLICATION' => 'required',
            'ID_NO_APPLICATION' => 'required|numeric|digits:9',
            'MOBILE' => 'required|numeric|digits_between:9,10',
            'NOTES' => 'nullable',
            'ref_no' => 'nullable',

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
            $data['user_id'] = Auth()->id();
            $data['id_no'] = $request->ID_NO;
            $data['name'] = $request->NAME;
            $data['application_name'] = $request->NAME_APPLICATION;
            $data['application_id_no'] = $request->ID_NO_APPLICATION;
            $data['mobile'] = $request->MOBILE;
            $data['notes'] = $request->NOTES;
            $data['ref_no'] = $request->ref_no;

            Application::create($data);
        }catch (\Exception $exception){
            return Response::json(array('success' => false,'results'=>['message' => $exception.'يوجد خطأ في عملية الإدخال']));
        }
        return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية الإدخال بنجاح']));
    }
    public function getDataResult(Request $request)
    {
        $role = [
            'P_ID' => 'numeric|digits:9|nullable',
            'P_INSERT_DATE'=> 'date|nullable',
        ];
        $data = $request->validate($role);
        $check = false;
        $query = Application::query();
        if($data['P_ID'] != null){
            $query->where('id_no',$data['P_ID']);
            $check = true;
        }
        if($data['P_INSERT_DATE'] != null){
            $query->whereDate('created_at', $data['P_INSERT_DATE']);
            $check = true;
        }
        if($request->has('found_checkbox') && $request->found_checkbox == 'true'){
            $query->has('martyr')->has('citizen');
            $check = true;
        }
        if($request->has('not_print_checkbox') && $request->not_print_checkbox == 'true'){
            $query->doesntHave('printLogs');
            $check = true;
        }

        if($check){
            $data_res =$query->get();
        }else{
            $data_res = [];
        }
        $result['data'] = [];
        if($data_res){
            foreach ($data_res as $key =>$value) {

                $result['data'][] = array(
                    $key+1,
                    $value->id_no,
                    $value->name,
                    $value->application_id_no,
                    $value->application_name,
                    $value->mobile,
                    $value->notes,
                    $value->created_at->toDateTimeString(),
                    $value->print_count,
                    $value->martyr->count() > 0 ? 'موجود' : 'غير موجود',
                    $value->ref_no
            );
            }
        }
        echo json_encode($result);
    }
}
