<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\CitizenDataTrait;
use App\Models\CitizenData;
use Illuminate\Validation\Rule;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class PersonalInfoController extends Controller
{
    use CitizenDataTrait;
    public function index()
    {
        return view('personal_info.index');
    }
    public function getPersonalInfo(Request $request)
    {
        $role = [
            'id_no' => 'numeric|digits:9|nullable',
        ];
        if(!$request->has('id_no')){
            $role['fname'] = 'string|required|min:3';
            $role['sname'] = 'string|nullable';
            $role['tname'] = 'string|nullable';
            $role['lname'] = 'string|required|min:3';
        }
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-',$validator->errors()->all())
            )); // 400 being the HTTP code for an invalid request.
        }
        if($request->has('id_no') && $request->id_no != ''){
            $data = CitizenData::where('id',$request->id_no)->first();
            return Response::json(array('success' => true,'type'=>'id_no','results'=>$data));
        }else{
            $data = CitizenData::where('fname','LIKE',"%$request->fname%")
                ->where('lname','LIKE',"%$request->lname%");
            if($request->sname != null){
                $data->where('sname','LIKE',"%$request->sname%");
            }
            if($request->tname != null){
                $data->where('tname','LIKE',"%$request->tname%");
            }
            $data = $data->get();
            return Response::json(array('success' => true,'type'=>'name','results'=>$data));
        }

    }
}
