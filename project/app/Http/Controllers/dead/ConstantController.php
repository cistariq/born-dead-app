<?php

namespace App\Http\Controllers\dead;

use App\Http\Controllers\Controller;
use App\Http\Traits\CitizenDataTrait;
use App\Models\CitizenData;
use App\Models\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ConstantController extends Controller
{
    use CitizenDataTrait;
    public function index()
    {
        #
    }

    public function getConstantByParent(Request $request)
    {
        $data = [];
        if(isset($request->parent_id)){
            $data = Constant::where('parent_id', $request->parent_id)->get();
        }
        echo json_encode($data);
    }
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
        $CitizenData = CitizenData::where('CI_ID',$request->id_no)->first();
        if($CitizenData){
            $result = $CitizenData;
        }else{
//ggggggggggg
        }
        if(isset($result)){
            return Response::json(array('success' => true,'results'=>$result));
        }else{
            return Response::json(array('success' => false,'errors'=>array('id' =>['رقم الهوية غير موجود'])));
        }
    }

}
