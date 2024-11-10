<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\CitizenDataTrait;
use App\Models\Citizen;
use App\Models\CitizenData;
use App\Models\BORNS_INFO_TB;
use App\Models\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ConstantController extends Controller
{
    use CitizenDataTrait;
    public function index()
    {
        $contants = Constant::whereNull('parent_id')->get();
        return view('constant.index',compact('contants'));
    }
    public function getConstantDtl(Request $request)
    {
        $data_res = Constant::where('parent_id',$request->parent_id)->get();
        $result['data'] = [];
        if($data_res){
            foreach ($data_res as $key =>$value) {
                $result['data'][] = array(
                    $value->id,
                    $value->name,
                    $value->Parent->name,
                    $value->created_at,
            );
            }
        }
        echo json_encode($result);
    }
    public function getConstantByParent(Request $request)
    {
        $data = [];
        if(isset($request->parent_id)){
            $data = Constant::where('parent_id', $request->parent_id)->get();
        }
        echo json_encode($data);
    }
    // public function getPersonalInfoByIdNo(Request $request)
    // {
    //     $role = [
    //         'id_no' => 'numeric|digits:9|required',
    //     ];
    //     $validator = Validator::make($request->all(), $role);
    //     if ($validator->fails())
    //     {
    //         return Response::json(array(
    //             'success' => false,
    //             'errors' => $validator->getMessageBag()->toArray()

    //         )); // 400 being the HTTP code for an invalid request.
    //     }
    //     $CitizenData = CitizenData::where('CI_ID',$request->id_no)->first();
    //     if($CitizenData){
    //         $result = $CitizenData;
    //     }else{
    //         $data = $this->getPersonalInfo($request);
    //         if(isset($data['personal_info'][0])){
    //             $result['CI_ID'] = $data['personal_info'][0]['CID'];
    //             $result['CI_FIRST_ARB'] = $data['personal_info'][0]['First_name'];
    //             $result['CI_FATHER_ARB'] = $data['personal_info'][0]['Father_name'];
    //             $result['CI_GRAND_FATHER_ARB'] = $data['personal_info'][0]['Grandfather_name'];
    //             $result['CI_FAMILY_ARB'] = $data['personal_info'][0]['Family_name'];
    //             $result['CI_BIRTH_DT'] = $data['personal_info'][0]['birth_date'];
    //         }else{
    //             return Response::json(array('success' => false,'errors'=>array('id' =>['رقم الهوية غير موجود'])));
    //         }
    //     }
    //     if(isset($result)){
    //         return Response::json(array('success' => true,'results'=>$result));
    //     }else{
    //         return Response::json(array('success' => false,'errors'=>array('id' =>['رقم الهوية غير موجود'])));
    //     }
    // }
    public function getPersonalInfoByIdNo(Request $request)
    {
        $role = [
            'id_no' => 'numeric|digits:9|required',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }

        $data = CitizenData::where('id',$request->id_no)->first();
        if(!$data){
            $data = $this->getPersonalInfo($request);
            if(isset($data['personal_info'][0])){
                $result['id'] = $data['personal_info'][0]['CID'];
                $result['fname'] = $data['personal_info'][0]['First_name'];
                $result['sname'] = $data['personal_info'][0]['Father_name'];
                $result['tname'] = $data['personal_info'][0]['Grandfather_name'];
                $result['lname'] = $data['personal_info'][0]['Family_name'];
               // $result['birth_date']  =$data['personal_info'][0]['birth_date'];
                $result['birth_date'] = Carbon::parse($data['personal_info'][0]['birth_date'])->format('d/m/Y');
                $result['sex'] = $data['personal_info'][0]['Sex'];
                $result['region'] = $data['personal_info'][0]['Region'];
                $result['religion'] = $data['personal_info'][0]['religion'];
                $result['status'] = $data['personal_info'][0]['marital_status'];
                $result['city'] = $data['personal_info'][0]['City'];
            }else{
                return Response::json(array('success' => false,'errors'=>array('id' =>['رقم الهوية غير موجود'])));
            }
        }else{
            $result = $data;
        }

        if(isset($result)){
            return Response::json(array('success' => true,'results'=>$result));
        }else{
            return Response::json(array('success' => false,'errors'=>array('id' =>['رقم الهوية غير موجود'])));
        }
    }
    public function getPersonalNameByIdNo(Request $request)
    {
        $role = [
            'id_no' => 'numeric|digits:9|required',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $data = Citizen::where('id_no',$request->id_no)->first();
        if($data){
            $result['fname'] = $data['FIRST_NAME'];
            $result['sname'] = $data['FASTHER_NAME'];
            $result['tname'] = $data['GRAND_FATHER_NAME'];
            $result['lname'] = $data['FAMILY_NAME'];
            return Response::json(array('success' => true,'results'=>$result));
        }
        $data = CitizenData::where('id',$request->id_no)->first();
        if(!$data){
            $data = $this->getPersonalInfo($request);
            if(isset($data['personal_info'][0])){
                $result['id'] = $data['personal_info'][0]['CID'];
                $result['fname'] = $data['personal_info'][0]['First_name'];
                $result['sname'] = $data['personal_info'][0]['Father_name'];
                $result['tname'] = $data['personal_info'][0]['Grandfather_name'];
                $result['lname'] = $data['personal_info'][0]['Family_name'];
            }else{
                return Response::json(array('success' => false,'errors'=>array('id' =>['رقم الهوية غير موجود'])));
            }
        }else{
            $result = $data;
        }

        if(isset($result)){
            return Response::json(array('success' => true,'results'=>$result));
        }else{
            return Response::json(array('success' => false,'errors'=>array('id' =>['رقم الهوية غير موجود'])));
        }
    }

    public function getPersonalInfoByName(Request $request)
    {
        $role = [
            'fname' => 'string|required',
            'sname' => 'string|nullable',
            'tname' => 'string|nullable',
            'lname' => 'string|required',

        ];

        $data = $request->validate($role);

        $query = CitizenData::where('fname',$data['fname'])->where('lname',$data['lname'])
        ;
        if($data['sname'] != null){
            $query->where('sname',$data['sname']);
        }
        if($data['tname'] != null){
            $query->where('tname',$data['tname']);
        }
        $data_res = $query->get();


        $result['data'] = [];


                            foreach ($data_res as $key =>$value) {
                                $result['data'][] = array(
                                    $key+1,
                                    $value->id,
                                    $value->fname.' '.$value->sname.' '.$value->tname.' '.$value->lname,
                                    // $value->sex,
                                    Carbon::parse($value->birth_date)->format('d/m/Y'),
                                    // $value->region,
                                    // $value->city,
                                    // $value->street,
                                    // $value->status,
                                    // $value->death_date,
                                    // $value->religion,

                            );
                            }

                        echo json_encode($result);
    }



}
