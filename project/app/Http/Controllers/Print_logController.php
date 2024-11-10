<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Models\PrintLog;

class Print_logController extends Controller
{
    public function index()
    {
        return view('print_logs.index');
    }

    public function getprintResult(Request $request)
    {
        $role = [
            'P_FROM_DATE' => 'nullable:date',
            'P_TO_DATE' => 'nullable:date',

        ];
        $data = $request->validate($role);
        $query = PrintLog::has('citizen');
        $check = false;

        if($data['P_FROM_DATE'] != null){
            $query->wheredate('created_at','>=',$data['P_FROM_DATE']);
            $check = true;
        }
        if($data['P_TO_DATE'] != null){
            $query->wheredate('created_at','<=',$data['P_TO_DATE']);
            $check = true;
        }
        if($check){
            $data_res = $query->get();

        }else{
            $data_res = [];
        }
        $result['data'] = [];
        if($data_res){
            foreach ($data_res as $key =>$value) {

                //$action='';

                $result['data'][] = array(
                    $key+1,
                    $value->id_no,
                    $value->citizen->FIRST_NAME.' '.$value->citizen->FASTHER_NAME.' '.$value->citizen->GRAND_FATHER_NAME.' '.$value->citizen->FAMILY_NAME,
                    $value->user->name,
                    $value->ip,
                    $value->created_at->format('Y-m-d'),
                    $value->recipient_id_no,
                    $value->recipient_name,
                    $value->updated_at->format('Y-m-d'),
                    $value->recipient_user ? $value->recipient_user->name : '',

            );
            }
        }
        echo json_encode($result);
    }
}


