<?php

namespace App\Http\Controllers;

use App\Rules\StartWith;

use App\Http\Controllers\Controller;
use App\Http\Traits\CitizenDataTrait;
use App\Models\Constant;
use App\Models\Log;
use App\Models\C_DETAILS_REFERRAL_TB;
use App\Models\C_MARTIAL_STATUS_TB;
use App\Models\C_RELEGION_TB;
use App\Models\C_JOB_TB;
use App\Models\C_CITY_TB;
use App\Models\C_REGION_TB;
use App\Models\BORNS_INFO_TB;
use App\Exports\BornExport;
use App\Exports\BornsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class BornController extends Controller
{
    use CitizenDataTrait;

    public function insert_new_born()
    {
        $data['religion'] = C_RELEGION_TB::get();

        return view('born.add_new_born', $data);
    }
    public function add_born()
    {
        $data['region'] = C_REGION_TB::get();
        $data['city'] = C_CITY_TB::get();
        $data['HEALTH_CENTER'] = C_DETAILS_REFERRAL_TB::get();
        $data['marital_status'] = C_MARTIAL_STATUS_TB::get();
        $data['jobs'] = C_JOB_TB::get();
        $data['religion'] = C_RELEGION_TB::get();


        return view('born.add_born', $data);
    }
    public function update_born($P_BI_CODE = null)
    {
        if ($P_BI_CODE) {
            $data['P_BI_CODE'] = $P_BI_CODE;
            $data['region'] = C_REGION_TB::get();
            $data['city'] = C_CITY_TB::get();
            $data['jobs'] = C_JOB_TB::get();
            $data['religion'] = C_RELEGION_TB::get();

            $data['marital_status'] = C_MARTIAL_STATUS_TB::get();

            $data['HEALTH_CENTER'] = C_DETAILS_REFERRAL_TB::get();

            return view('born.update_born', $data);
        }
        return abort(404);
    }
    public function new_born_search()
    {
        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();
        // dd($data['hospitals'][0]);
        $data['region'] = C_REGION_TB::get();
        $data['city'] = C_CITY_TB::get();
        $data['religion'] = C_RELEGION_TB::get();

        return view('born.new_born_search', $data);
    }
    public function born_search()
    {
        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();
        // dd($data['hospitals'][0]);
        $data['region'] = C_REGION_TB::get();
        $data['religion'] = C_RELEGION_TB::get();

        $data['city'] = C_CITY_TB::get();
        $data['marital_status'] = C_MARTIAL_STATUS_TB::get();
        $data['jobs'] = C_JOB_TB::get();

        return view('born.born_search', $data);
    }
    public function Daily_Form()
    {
        return view('born.Daily_Form');
    }


    public function getBornResult(Request $request)
    {
        $role = [
            'P_BORN_CODE' => 'nullable|numeric',
            'P_FATHER_ID' => 'nullable|numeric|digits:9',
            'P_MOTHER_ID' => 'nullable|numeric|digits:9',
            'P_FIRST_NAME' => 'string|nullable',
            'P_SECOND_NAME' => 'string|nullable',
            'P_THIRD_NAME' => 'string|nullable',
            'P_LAST_NAME' => 'string|nullable',
            'P_DATE_FROM' => 'nullable|date_format:d/m/Y|before:' . date('d/m/Y'),
            'P_DATE_TO' => 'nullable|date_format:d/m/Y|before:' . date('d/m/Y'),
            'P_SEX_NO' => 'numeric|nullable',
            'P_REGION_NO' => 'numeric|nullable',
            'P_CITY_NO' => 'numeric|nullable',
            'P_HOS_NO' => 'numeric|nullable',
        ];
        $data = $request->validate($role);

        $query = BORNS_INFO_TB::GET_BORN_DATA_BY_ID($request->all());

        $count = $query['RESULT_COUNT'];
        $totalData = $count;
        $totalFiltered = $totalData;
        $result['data'] = [];
        if ($query['data']) {
            $action = '';
            foreach ($query['data'] as $key => $value) {
                // $action = '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-3"
                //             onclick=""  title="طباعة صورة إشعار الولادة">
                //             <i class="fonticon-printer fs-3"></i>
                //         </button>';
                $action = '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-3"
                        onclick="update_born_notic(' . $value['BI_CODE'] . ');"  title="تعديل بيانات اشعار الولادة">
                         <i class="fa-solid fa-pen-to-square fs-3"></i>
                    </button>';
                // $action .= '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-3"
                //     onclick=""  title="حذف إشعار الولادة">
                //     <i class="fas fa-trash-alt fs-3"></i>
                // </button>';
                $result['data'][] = array(
                    $key + 1,
                    $value['BI_CODE'],
                    $value['FATHER_ID'],
                    $value['MOTHER_ID'],
                    $value['FULL_NAME'],
                    $value['BORN_DATE'],
                    $value['DREF_NAME_AR'],
                    $action,
                );
            }
        }
        $json_data = array(
            "draw"            => intval($request->draw),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $result['data']

        );
        echo json_encode($json_data);
    }
    public function export_excel(Request $request)
    {
        $request->merge(["start" => null]);
        $request->merge(["limit" => null]);
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $data_res = BORNS_INFO_TB::GET_BORN_DATA_BY_ID($request->P_BORN_CODE, $request->P_FATHER_ID, $request->P_MOTHER_ID, $request->P_FIRST_NAME, $request->P_SECOND_NAME, $request->P_THIRD_NAME, $request->P_LAST_NAME, $request->P_DATE_FROM, $request->P_DATE_TO, $request->P_SEX_NO, $request->P_REGION_NO, $request->P_CITY_NO, $request->P_HOS_NO, $request->start, $request->limit);
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'BORN_DETAILS_TB';
        $data1['column_name'] = 'e';
        $data['old_record'] = $request->all();
        $data1['type_action'] = 'DL';
        Log::create($data1);
        $result = Excel::download(new BornExport($data_res), 'born_excel.csv');
        return $result;
    }

    function save_born_info(Request $request)
    {
        $role = [

            'P_BI_ID' => 'required|numeric|digits:9',
            'P_BI_ADMISSION_CD' => 'required|numeric',
            'P_BI_ORDER' => 'required|numeric',
            'P_BI_WEIGHT_GM' => 'required|numeric|digits_between:3,4',
            'P_BI_FIRST_NAME' => 'required|string|max:15',
            'P_BI_SEX_CD' => 'required|numeric',
            'P_BI_RELEGION_CD' => 'required|numeric',
            'P_BI_PARTOGRAM_CD' => 'nullable|numeric',
            'P_BI_PRESENTATION_CD' => 'nullable|numeric',
            'P_BI_OUT_COME_CD' => 'nullable|numeric',
            'P_BI_APAGAR_5' => 'nullable|numeric',
            'P_BI_APAGAR_1' => 'nullable|numeric',
            'P_BI_CONGENITAL_ANOMALIES_CD' => 'nullable|numeric',
            'P_BI_EXAM_OUT_COME_CD' => 'nullable|numeric',
            'P_BI_EXAM_BEFORE_CD' => 'nullable|numeric',
            'P_BI_ADMITTED_NICU_CD' => 'nullable|numeric',

        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $request->merge(["P_BI_NOTIFICATION_CREATED_BY" => Auth()->id()]);
        $request->merge(["P_BI_NOTIFICATION_CREATED_ON" => date('d/m/Y h:i')]);
        //dd($request->all());
        try {
            $query = BORNS_INFO_TB::ADD_BORN_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORNS_INFO_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'I';
            Log::create($data1);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => ['message' => 'تمت عملية الإدخال بنجاح']));
    }
    public function getFatherInfoByIdNo(Request $request)
    {
        $role = [
            'P_FATHER_NO' => 'numeric|digits:9|required',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $data = BORNS_INFO_TB::IS_FATHER_FOUND($request->P_FATHER_NO);

        $FLAG = $data['FOUND'];
        //dd($FLAG);
        if ($FLAG == 0) {
            $data = BORNS_INFO_TB::GET_FATHER_CITZN_BY_ID($request->P_FATHER_NO);
            // $data1['user_id'] = Auth()->id();
            // $data1['ip'] = request()->ip();
            // $data1['id_no'] = Auth()->id();
            // $data1['table_name'] = 'CITZN_API';
            // $data1['column_name'] = null;
            // $data['old_record'] = $request->all();
            // $data1['type_action'] = 'S';
            // Log::create($data1);
            $result['fname'] = $data['FIRST_NAME_AR'];
            $result['sname'] = $data['FATHER_NAME_AR'];
            $result['tname'] = $data['GRANDFATHER_NAME_AR'];
            $result['lname'] = $data['LAST_NAME_AR'];
            $result['lname'] = $data['LAST_NAME_AR'];
            $result['birth_date'] = $data['DOB'];
            $result['birth_place'] = $data['BIRTH_PLACE'];
            $result['father_birth_place'] = $data['FATHER_BIRTH_PLACE'];
            $result['MS_NAME'] = $data['MS_NAME'];
            $result['MARTIAL_STATUS_CD'] = $data['MARTIAL_STATUS_CD'];
            $result['JOB_NAME'] = $data['FATHER_JOB_CD'];
            $result['CITY_CD'] = $data['FATHER_CITY_CD'];
            $result['REGION_CD'] = $data['FATHER_REGION_CD'];
            $result['sex'] = $data['FATHER_SEX_CD'];
        } else {
            $data = BORNS_INFO_TB::GET_FATHER_DATA_BY_ID($request->P_FATHER_NO);
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORN_FATHER_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'S';
            Log::create($data1);
            if (isset($data['P_FATHER_ID']) && $data['P_FATHER_ID'] != '') {

                $result['fname'] = $data['FIRST_NAME_AR'];
                $result['sname'] = $data['FATHER_NAME_AR'];
                $result['tname'] = $data['GRANDFATHER_NAME_AR'];
                $result['lname'] = $data['LAST_NAME_AR'];
                $result['lname'] = $data['LAST_NAME_AR'];
                $result['birth_date'] = $data['DOB'];
                $result['birth_place'] = $data['BIRTH_PLACE'];
                $result['father_birth_place'] = $data['FATHER_BIRTH_PLACE'];
                $result['MS_NAME'] = $data['MS_NAME'];
                $result['MARTIAL_STATUS_CD'] = $data['MARTIAL_STATUS_CD'];
                $result['JOB_CD'] = $data['JOB_CD'];
                $result['JOB_NAME'] = $data['JOB_NAME'];
                $result['YEAR_OF_EDUCATION'] = $data['YEAR_OF_EDUCATION'];
                $result['CITY_CD'] = $data['CITY_CD'];
                $result['REGION_CD'] = $data['REGION_CD'];
                $result['FATHER_NUMBER'] = $data['FATHER_NUMBER'];
                $result['sex'] = $data['FATHER_SEX_CD'];
            } else {
                return Response::json(array('success' => false, 'errors' => array('id' => ['رقم الهوية غير موجود'])));
            }
        }
        // dd($result);
        return Response::json(array('success' => true, 'results' => $result));
    }

    public function getMotherInfoByIdNo(Request $request)
    {
        $role = [
            'P_MOTHER_ID' => 'numeric|digits:9|required',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $data = BORNS_INFO_TB::IS_MOTHER_FOUND($request->P_MOTHER_ID);
        $FLAG = $data['FOUND'];
        //dd($FLAG);
        if ($FLAG == 0) {
            $data = BORNS_INFO_TB::GET_MOTHER_CITZN_BY_ID($request->P_MOTHER_ID);
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'CITZN_API';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'S';
            Log::create($data1);
            $result['fname'] = $data['FIRST_NAME_AR'];
            $result['sname'] = $data['FATHER_NAME_AR'];
            $result['tname'] = $data['GRANDFATHER_NAME_AR'];
            $result['lname'] = $data['LAST_NAME_AR'];
            $result['lname'] = $data['LAST_NAME_AR'];
            $result['birth_date'] = $data['DOB'];
            $result['birth_place'] = $data['BIRTH_PLACE'];
            $result['father_birth_place'] = $data['FATHER_BIRTH_PLACE'];
            $result['MS_NAME'] = $data['MS_NAME'];
            $result['MARTIAL_STATUS_CD'] = $data['MARTIAL_STATUS_CD'];
            $result['JOB_NAME'] = $data['MOTHER_JOB_CD'];
            $result['CITY_CD'] = $data['CITY_CD'];
            $result['REGION_CD'] = $data['REGION_CD'];
            $result['YEAR_OF_EDUCATION'] = 0;
            $result['MOTHER_NUMBER'] = 0;
            $result['FAMILY_NAME'] = '';
            $result['DATA_FRM_MOI'] = 0;
            $result['sex'] = $data['MOTHER_SEX_CD'];
        } else {
            $data = BORNS_INFO_TB::GET_MOTHER_DATA_BY_ID($request->P_MOTHER_ID);
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORN_MOTHER_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'S';
            Log::create($data1);
            if (isset($data['MOTHER_NUMBER']) && $data['MOTHER_NUMBER'] != '') {

                $result['fname'] = $data['FIRST_NAME_AR'];
                $result['sname'] = $data['FATHER_NAME_AR'];
                $result['tname'] = $data['GRANDFATHER_NAME_AR'];
                $result['lname'] = $data['LAST_NAME_AR'];
                $result['lname'] = $data['LAST_NAME_AR'];
                $result['birth_date'] = $data['DOB'];
                $result['birth_place'] = $data['BIRTH_PLACE'];
                $result['father_birth_place'] = $data['FATHER_BIRTH_PLACE1'];
                $result['MS_NAME'] = $data['MS_NAME'];
                $result['MARTIAL_STATUS_CD'] = $data['MARTIAL_STATUS_CD'];
                $result['JOB_CD'] = $data['JOB_CD'];
                $result['JOB_NAME'] = $data['JOB_NAME'];
                $result['YEAR_OF_EDUCATION'] = $data['YEAR_OF_EDUCATION'];
                $result['CITY_CD'] = $data['CITY_CD'];
                $result['REGION_CD'] = $data['REGION_CD'];
                $result['TEL'] = $data['TEL'];
                $result['FAMILY_NAME'] = $data['FAMILY_NAME'];
                $result['MOTHER_NUMBER'] = $data['MOTHER_NUMBER'];
                $result['DATA_FRM_MOI'] = $data['DATA_FRM_MOI'];
                $result['sex'] = $data['MOTHER_SEX_CD'];
            } else {
                return Response::json(array('success' => false, 'errors' => array('id' => ['رقم الهوية غير موجود'])));
            }
        }
        //  dd($result);
        return Response::json(array('success' => true, 'results' => $result));
    }

    function update_father_info(Request $request)
    {
        $role = [
            'F_NUMBER' => 'required|numeric',
            'F_ID' => 'numeric|digits:9|required',
            'F_FIRST_NAME_AR' => 'string|required',
            'F_FATHER_NAME_AR' => 'string|required',
            'F_GRANDFATHER_NAME_AR' => 'string|required',
            'F_LAST_NAME_AR' => 'string|required',
            'F_DOB' => 'required|date_format:d/m/Y',
            'F_BIRTH_PLACE' => 'string|required',
            'F_FATHER_BIRTH_PLACE' => 'string|nullable',
            'F_JOB_CD' => 'string|required',
            'F_MARTIAL_STATUS_CD' => 'numeric|nullable',
            'F_YEAR_OF_EDUCATION' => 'numeric|required',
            'F_REGION_CD' => 'numeric|nullable',
            'F_CITY_CD' => 'numeric|nullable',
            'F_DATA_FRM_MOI' => 'numeric|nullable',
            'F_ID_TYPE' => 'numeric|nullable',
            'B_CODE' => 'numeric|nullable',

        ];
        //dd($request->all());
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $request->merge(["P_FATHER_MODIFIED_BY" => Auth()->id()]);
        try {
            $query = BORNS_INFO_TB::UPDATE_FATHER_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORN_FATHER_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'U';
            Log::create($data1);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => ['message' => 'تمت عملية التعديل بنجاح']));
    }

    function update_mother_info(Request $request)
    {
        $role = [
            'MOTHER_NUMBER' => 'required|numeric',
            'MOTHER_ID' => 'numeric|digits:9|required',
            'MOTHER_FIRST_NAME_AR' => 'string|required',
            'MOTHER_FATHER_NAME_AR' => 'string|required',
            'MOTHER_GRANDFATHER_NAME_AR' => 'string|required',
            'MOTHER_LAST_NAME_AR' => 'string|required',
            'MOTHER_DOB' => 'required|date_format:d/m/Y',
            'MOTHER_BIRTH_PLACE' => 'string|required',
            'MOTHER_FATHER_BIRTH_PLACE' => 'string|required',
            'MOTHER_JOB' => 'string|required',
            'MOTHER_MARTIAL_STATUS_CD' => 'numeric|nullable',
            'MOTHER_YEAR_OF_EDUCATION' => 'numeric|required',
            'MOTHER_REGION_CD' => 'numeric|nullable',
            'MOTHER_CITY_CD' => 'numeric|nullable',
            'MOTHER_TEL' => ['nullable', 'numeric', 'digits:10', new StartWith('059', '056')],
            'MOTHER_FAMILY_NAME' => 'string|required',
            'MOTHER_DATA_FRM_MOI' => 'numeric|nullable',
            'MOTHER_ID_TYPE' => 'numeric|nullable',
            'B_CODE' => 'numeric|nullable',

        ];
        //dd($request->all());
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $request->merge(["P_MOTHER_MODIFIED_BY" => Auth()->id()]);
        try {
            $query = BORNS_INFO_TB::UPDATE_MOTHER_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORN_MOTHER_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'U';
            Log::create($data1);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => ['message' => 'تمت عملية التعديل بنجاح']));
    }

    function ADD_BORN_FATHER_DATA(Request $request)
    {
        $role = [

            'FATHER_ID' => 'numeric|digits:9|required',
            'FATHER_FIRST_NAME_AR' => 'string|required',
            'FATHER_FATHER_NAME_AR' => 'string|required',
            'FATHER_GRANDFATHER_NAME_AR' => 'string|required',
            'FATHER_LAST_NAME_AR' => 'string|required',
            'FATHER_DOB' => 'required|date_format:m/d/Y',
            'FATHER_BIRTH_PLACE' => 'string|required',
            'FATHER_FATHER_BIRTH_PLACE' => 'string|nullable',
            'FATHER_JOB' => 'string|required',
            'FATHER_MARTIAL_STATUS_CD' => 'numeric|nullable',
            'FATHER_YEAR_OF_EDUCATION' => 'numeric|required',
            'FATHER_REGION_CD' => 'numeric|nullable',
            'FATHER_CITY_CD' => 'numeric|nullable',
            'FATHER_DATA_FRM_MOI' => 'numeric|nullable',
            'FATHER_ID_TYPE' => 'numeric|nullable'


        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        //$request->merge(["P_FATHER_CREATED_BY" => Auth()->id()]);
        try {
            $query = BORNS_INFO_TB::ADD_BORN_FATHER_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORN_FATHER_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'I';
            Log::create($data1);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => $query));
    }
    //add mother data
    function ADD_BORN_MOTHER_DATA(Request $request)
    {
        $role = [

            'MOTHER_ID' => 'numeric|digits:9|required',
            'MOTHER_FIRST_NAME_AR' => 'string|required',
            'MOTHER_FATHER_NAME_AR' => 'string|required',
            'MOTHER_GRANDFATHER_NAME_AR' => 'string|required',
            'MOTHER_LAST_NAME_AR' => 'string|required',
            'MOTHER_DOB' => 'required|date_format:d/m/Y',
            'MOTHER_BIRTH_PLACE' => 'string|required',
            'MOTHER_FATHER_BIRTH_PLACE' => 'string|required',
            'MOTHER_JOB' => 'string|required',
            'MOTHER_MARTIAL_STATUS_CD' => 'numeric|nullable',
            'MOTHER_YEAR_OF_EDUCATION' => 'numeric|required',
            'MOTHER_REGION_CD' => 'numeric|nullable',
            'MOTHER_CITY_CD' => 'numeric|nullable',
            'MOTHER_TEL' => ['nullable', 'numeric', 'digits:10', new StartWith('059', '056')],
            'MOTHER_FAMILY_NAME' => 'string|required',
            'MOTHER_DATA_FRM_MOI' => 'numeric|nullable',
            'MOTHER_ID_TYPE' => 'numeric|nullable'


        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        //$request->merge(["P_MOTHER_CREATED_BY" => Auth()->id()]);
        try {
            $query = BORNS_INFO_TB::ADD_BORN_MOTHER_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORN_MOTHER_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'I';
            Log::create($data1);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => $query));
    }
    //add born details
    function save_born_details_info(Request $request)
    {
        $role = [

            'BORN_DETAILS_REASON_CD' => 'numeric|nullable',
            'BORN_DETAILS_GRAVID' => 'numeric|nullable',
            'BORN_DETAILS_PARITY' => 'numeric|nullable',
            'BORN_DETAILS_ABORTION' => 'numeric|nullable',
            'BORN_DETAILS_GESTATIONAL_WEEKS' => 'numeric|nullable',
            'BORN_DETAILS_DELIVERY_DATE' => 'string|required',
            'BORN_DETAILS_DELIVERY_CD' => 'numeric|nullable',
            'BORN_DETAILS_PLURALITY' => 'numeric|required',
            'BORN_DETAILS_DELIVERY_COMPLI_C' => 'numeric|nullable',
            'BORN_DETAILS_CATALYST_CD' => 'numeric|nullable',
            'BORN_DETAILS_MOTHER_EXAM_CD' => 'numeric|nullable',
            'BORN_DETAILS_MOTHER_RESULT_CD' => 'numeric|nullable',
            'BORN_DETAILS_PAIN_RELIEF_CD' => 'numeric|nullable',
            'BORN_DETAILS_BLOOD_TRANS_CD' => 'numeric|nullable',
            'BORN_DETAILS_PLACENTA_COND_CD' => 'numeric|nullable',
            'BORN_DETAILS_MARRIAGE_DATE' => 'string|nullable',
            'BORN_DETAILS_MARRIAGE_NUMBER' => 'numeric|required',
            'BORN_DETAILS_CUR_MARRIAGE_LIVE' => 'numeric|nullable',
            'BORN_DETAILS_CUR_MARRIAGE_DEAD' => 'numeric|nullable',
            'BORN_DETAILS_PRE_MARRIAGE_LIVE' => 'numeric|nullable',
            'BORN_DETAILS_PRE_MARRIAGE_DEAD' => 'numeric|nullable',
            'BORN_DETAILS_GENERATOR_CD' => 'numeric|nullable',
            'BORN_DETAILS_TWINS' => 'numeric|nullable',
            'BORN_DETAILS_FATH_CD' => 'numeric|nullable',
            'BORN_DETAILS_MOTHER_CD' => 'numeric|nullable',
            'BORN_DETAILS_CITY_CD' => 'numeric|required',
            'BORN_DETAILS_REGION_CD' => 'numeric|required',
            'BORN_DETAILS_HOME_NO' => 'string|nullable',
            'BORN_DETAILS_PARENTS_TEL_NO' => ['required', 'numeric', 'digits:10', new StartWith('059', '056')],
            'BORN_DETAILS_HEALTH_CENTER_CD' => 'numeric|nullable',
            'BORN_DETAILS_BIRTH_PLACE_CD' => 'numeric|required'


        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        //$request->merge(["P_MOTHER_CREATED_BY" => Auth()->id()]);
        try {
            $query = BORNS_INFO_TB::ADD_BORN_DETAILS_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORN_DETAILS_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'I';
            Log::create($data1);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => ['message' => 'تمت عملية الإدخال بنجاح']));
    }

    public function GET_BORNS_DATE(Request $request)
    {
        $role = [
            'F_ID' => 'nullable|numeric|digits:9',
            'M_ID' => 'nullable|numeric|digits:9',

        ];

        $data = $request->validate($role);
        $query = BORNS_INFO_TB::GET_BORN_DATE_BY_ID($request->all());
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'BORN_DETAILS_TB';
        $data1['column_name'] = 'e';
        $data['old_record'] = $request->all();
        $data1['type_action'] = 'S';
        Log::create($data1);
        $result['data'] = [];
        if ($query) {
            $action = '';
            foreach ($query as $key => $value) {
                if (IsPermissionBtn(33)) {

                    $action = '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-3"
            onclick="Upborn_data(' . $value['FATHER_ID'] . ',' . $value['MOTHER_ID'] . ');"  title="تعديل بيانات المولود">
             <i class="fa-solid fa-pen-to-square fs-3"></i>
        </button>';
                }
                //             $action .= '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-3"
                //     onclick=""  title="حذف إشعار الوفاة">
                //     <i class="fas fa-trash-alt fs-3"></i>
                // </button>';
                $result['data'][] = array(
                    $key + 1,
                    $value['FATHER_ID'],
                    $value['FATHER_FULL_NAME'],
                    $value['MOTHER_ID'],
                    $value['MOTHER_FULL_NAME'],
                    $value['DELIVER_DATE'],
                    $action,
                );
            }
        }

        echo json_encode($result);
    }
    public function getBorn_Code(Request $request)
    {
        $query = BORNS_INFO_TB::GET_BORNS_NUMBER($request->all());
        if (isset($query['BORN_NUMBER']) && $query['BORN_NUMBER'] != '') {

            $result['BORN_NUMBER'] = $query['BORN_NUMBER'];

            return Response::json(array('success' => true, 'results' => $result));
        } else {
            return Response::json(array('success' => false, 'results' => ['message' => 'خطأ في عملية الإدخال']));
        }
    }

    public function is_born_found(Request $request)
    {
        $role = [
            'P_BI_ADMISSION_CD' => 'numeric|required',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $data = BORNS_INFO_TB::IS_BORN_FOUND($request->P_BI_ADMISSION_CD);
        $result['FLAG']  = $data['FOUND'];
        return Response::json(array('success' => true, 'results' => $result));
    }

    public function getBornInfoByNo(Request $request)
    {
        $role = [
            'P_BI_ADMISSION_CD' => 'numeric|required',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $data = BORNS_INFO_TB::GET_BORN_DATA_BY_CODE($request->P_BI_ADMISSION_CD);

        if (isset($data['P_BI_ADMISSION_CD']) && $data['P_BI_ADMISSION_CD'] != '') {

            $result['BI_ID'] = $data['V_BI_ID'];
            $result['BI_FIRST_NAME'] = $data['V_BI_FIRST_NAME'];
            $result['BI_ORDER'] = $data['V_BI_ORDER'];
            $result['BI_CODE'] = $data['V_BI_CODE'];
            $result['BI_WEIGHT_GM'] = $data['V_BI_WEIGHT_GM'];
            $result['BI_RELEGION_CD'] = $data['V_BI_RELEGION_CD'];
            $result['BI_SEX_CD'] = $data['V_BI_SEX_CD'];
            $result['BI_OUT_COME_CD'] = $data['V_BI_OUT_COME_CD'];
            $result['BI_PRESENTATION_CD'] = $data['V_BI_PRESENTATION_CD'];
            $result['BI_PARTOGRAM_CD'] = $data['V_BI_PARTOGRAM_CD'];
            $result['BI_ADMITTED_NICU_CD'] = $data['V_BI_ADMITTED_NICU_CD'];
            $result['BI_EXAM_BEFORE_CD'] = $data['V_BI_EXAM_BEFORE_CD'];
            $result['BI_EXAM_OUT_COME_CD'] = $data['V_BI_EXAM_OUT_COME_CD'];
            $result['BI_CONGENITAL_ANOMALIES_CD'] = $data['V_BI_CONGENITAL_ANOMALIES_CD'];
            $result['BI_ADMISSION_CD'] = $data['V_BI_ADMISSION_CD'];
            $result['BI_APAGAR_1'] = $data['V_BI_APAGAR_1'];
            $result['BI_APAGAR_5'] = $data['V_BI_APAGAR_5'];
        }
        return Response::json(array('success' => true, 'results' => $result));
    }

    public function getBornInfo(Request $request)
    {
        $role = [
            'P_BORN_CODE' => 'nullable|numeric',
            'P_FATHER_ID' => 'nullable|numeric|digits:9',
            'P_MOTHER_ID' => 'nullable|numeric|digits:9',
            'P_FIRST_NAME' => 'string|nullable',
            'P_SECOND_NAME' => 'string|nullable',
            'P_THIRD_NAME' => 'string|nullable',
            'P_LAST_NAME' => 'string|nullable',
            'P_DATE_FROM' => 'nullable|date_format:d/m/Y|before:' . date('d/m/Y'),
            'P_DATE_TO' => 'nullable|date_format:d/m/Y|before:' . date('d/m/Y'),
            'P_SEX_NO' => 'numeric|nullable',
            'P_REGION_NO' => 'numeric|nullable',
            'P_CITY_NO' => 'numeric|nullable',
            'P_HOS_NO' => 'numeric|nullable',
        ];
        $data = $request->validate($role);

        $query = BORNS_INFO_TB::GET_BORN_DATA($request->all());
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'BORN_DETAILS_TB';
        $data1['column_name'] = 'e';
        $data['old_record'] = $request->all();
        $data1['type_action'] = 'S';
        Log::create($data1);
        $count = $query['RESULT_COUNT'];
        $totalData = $count;
        $totalFiltered = $totalData;
        $result['data'] = [];
        if ($query['data']) {
            $action = '';
            foreach ($query['data'] as $key => $value) {
                // $action = '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-3"
                //             onclick=""  title="طباعة صورة إشعار الولادة">
                //             <i class="fonticon-printer fs-3"></i>
                //         </button>';
                if (IsPermissionBtn(29)) {

                    $action = '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-3"
                        onclick="update_born_notic(' . $value['BI_CODE'] . ');"  title="تعديل بيانات اشعار الولادة">
                         <i class="fa-solid fa-pen-to-square fs-3"></i>
                    </button>';
                }
                // $action .= '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-3"
                //     onclick=""  title="حذف إشعار الولادة">
                //     <i class="fas fa-trash-alt fs-3"></i>
                // </button>';
                $result['data'][] = array(
                    $key + 1,
                    $value['BI_CODE'],
                    $value['BI_ID'],
                    $value['BI_FULL_NAME'],
                    $value['MOTHER_FULL_NAME'],
                    $value['BORN_DATE'],
                    $value['DREF_NAME_AR'],
                    $action,
                );
            }
        }
        $json_data = array(
            "draw"            => intval($request->draw),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $result['data']

        );
        echo json_encode($json_data);
    }
    public function born_export_excel(Request $request)
    {
        $request->merge(["start" => null]);
        $request->merge(["limit" => null]);
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $data_res = BORNS_INFO_TB::GET_BORN_DATA($request->P_BORN_CODE, $request->P_FATHER_ID, $request->P_MOTHER_ID, $request->P_FIRST_NAME, $request->P_SECOND_NAME, $request->P_THIRD_NAME, $request->P_LAST_NAME, $request->P_DATE_FROM, $request->P_DATE_TO, $request->P_SEX_NO, $request->P_REGION_NO, $request->P_CITY_NO, $request->P_HOS_NO, $request->start, $request->limit);
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'BORN_DETAILS_TB';
        $data1['column_name'] = 'e';
        $data['old_record'] = $request->all();
        $data1['type_action'] = 'DL';
        Log::create($data1);
        $result = Excel::download(new BornsExport($data_res), 'borns_excel.csv');
        return $result;
    }
    public function getBornInfoByCode(Request $request)
    {
        try {
            $query = BORNS_INFO_TB::GET_BORN_INFO_BY_CODE($request->P_BI_CODE);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => ['message' => 'البيانات متوفرة']));
    }
    public function getBornInfoByCodeNo(Request $request)
    {

        $query = BORNS_INFO_TB::GET_BORN_INFO_BY_CODE($request->P_BI_CODE);

        return Response::json(array('success' => true, 'results' => $query));
    }

    function update_born_info(Request $request)

    {

        $role = [
            'P_BI_CODE' => 'numeric|required',
            'BORN_DETAILS_REASON_CD' => 'numeric|nullable',
            'BORN_DETAILS_GRAVID' => 'numeric|nullable',
            'BORN_DETAILS_PARITY' => 'numeric|nullable',
            'BORN_DETAILS_ABORTION' => 'numeric|nullable',
            'BORN_DETAILS_GESTATIONAL_WEEKS' => 'numeric|nullable',
            'BORN_DETAILS_DELIVERY_DATE' => 'string|required',
            'BORN_DETAILS_DELIVERY_CD' => 'numeric|nullable',
            'BORN_DETAILS_PLURALITY' => 'numeric|required',
            'BORN_DETAILS_DELIVERY_COMPLI_C' => 'numeric|nullable',
            'BORN_DETAILS_CATALYST_CD' => 'numeric|nullable',
            'BORN_DETAILS_MOTHER_EXAM_CD' => 'numeric|nullable',
            'BORN_DETAILS_MOTHER_RESULT_CD' => 'numeric|nullable',
            'BORN_DETAILS_PAIN_RELIEF_CD' => 'numeric|nullable',
            'BORN_DETAILS_BLOOD_TRANS_CD' => 'numeric|nullable',
            'BORN_DETAILS_PLACENTA_COND_CD' => 'numeric|nullable',
            'BORN_DETAILS_MARRIAGE_DATE' => 'string|nullable',
            'BORN_DETAILS_MARRIAGE_NUMBER' => 'numeric|required',
            'BORN_DETAILS_CUR_MARRIAGE_LIVE' => 'numeric|nullable',
            'BORN_DETAILS_CUR_MARRIAGE_DEAD' => 'numeric|nullable',
            'BORN_DETAILS_PRE_MARRIAGE_LIVE' => 'numeric|nullable',
            'BORN_DETAILS_PRE_MARRIAGE_DEAD' => 'numeric|nullable',
            'BORN_DETAILS_GENERATOR_CD' => 'numeric|nullable',
            'BORN_DETAILS_TWINS' => 'numeric|nullable',
            'BORN_DETAILS_FATH_CD' => 'numeric|nullable',
            'BORN_DETAILS_MOTHER_CD' => 'numeric|nullable',
            'BORN_DETAILS_CITY_CD' => 'numeric|required',
            'BORN_DETAILS_REGION_CD' => 'numeric|required',
            'BORN_DETAILS_HOME_NO' => 'string|nullable',
            'BORN_DETAILS_PARENTS_TEL_NO' => ['required', 'numeric', 'digits:10', new StartWith('059', '056')],
            'BORN_DETAILS_HEALTH_CENTER_CD' => 'numeric|nullable',
            'BORN_DETAILS_BIRTH_PLACE_CD' => 'numeric|required',
            'P_BI_ID' => 'required|numeric|digits:9',
            'P_BI_ADMISSION_CD' => 'required|numeric',
            'P_BI_ORDER' => 'required|numeric',
            'P_BI_WEIGHT_GM' => 'required|numeric|digits_between:3,4',
            'P_BI_FIRST_NAME' => 'required|string|max:15',
            'P_BI_SEX_CD' => 'required|numeric',
            'P_BI_RELEGION_CD' => 'required|numeric',
            'P_BI_PARTOGRAM_CD' => 'nullable|numeric',
            'P_BI_PRESENTATION_CD' => 'nullable|numeric',
            'P_BI_OUT_COME_CD' => 'nullable|numeric',
            'P_BI_APAGAR_5' => 'nullable|numeric',
            'P_BI_APAGAR_1' => 'nullable|numeric',
            'P_BI_CONGENITAL_ANOMALIES_CD' => 'nullable|numeric',
            'P_BI_EXAM_OUT_COME_CD' => 'nullable|numeric',
            'P_BI_EXAM_BEFORE_CD' => 'nullable|numeric',
            'P_BI_ADMITTED_NICU_CD' => 'nullable|numeric',

        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $request->merge(["P_BI_NOTIFICATION_CREATED_BY" => Auth()->id()]);
        $request->merge(["P_BI_NOTIFICATION_CREATED_ON" => date('d/m/Y h:i')]);
        try {
            $query = BORNS_INFO_TB::UPDATE_BORN_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'BORN_DETAILS_TB';
            $data1['column_name'] = 'e';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'U';
            Log::create($data1);
            // dd($query);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results'  => ['message' =>  $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => ['message' => 'تمت عملية التعديل بنجاح']));
    }
}
