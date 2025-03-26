<?php

namespace App\Http\Controllers\dead;

use App\Rules\StartWith;
use App\Http\Controllers\Controller;
use App\Models\C_CITY_TB;
use App\Models\Citizen;
use App\Models\Constant;
use App\Models\Log;
use App\Models\Martyr;
use App\Models\DEADS_TB;
use App\Models\C_REGION_TB;
use App\Models\C_MARTIAL_STATUS_TB;
use App\Models\ROLE_BTNS;
use App\Models\ROLE_BTN_USERS;

use App\Models\C_DETAILS_REFERRAL_TB;
use App\Models\C_DEATH_CAUSE_TB;
use App\Models\C_JOB_TB;
use App\Models\C_NATIONALITY_TB;
use App\Models\C_RELEGION_TB;
use App\Models\PrintLog;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Exports\DeadExport;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Traits\DeadDataTrait;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


use Session;

use File;




class DeadController extends Controller
{
    use DeadDataTrait;
    protected $proxies = "*";

    protected $casts = [
        'P_BIRTH_DATE' => 'datetime',
    ];
    // public function index()
    // {
    //     $data['marital_status'] = C_MARTIAL_STATUS_TB::get();
    //     $data['hospitals'] = DEADS_TB::ALL_HOS_DREF();
    //     $data['region'] = C_REGION_TB::get();
    //     $data['city'] = C_CITY_TB::get();
    //     $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2, 3])->orwhereIn('DREF_CODE', [134, 125, 146])->get();

    //     $data['entry_detail'] = C_DEATH_CAUSE_TB::get();
    //     return view('dead.dead_search', $data);
    // }
    public function dead_search()
    {
        $data['marital_status'] = C_MARTIAL_STATUS_TB::get();
        $data['hospitals'] = DEADS_TB::ALL_HOS_DREF();
        $data['region'] = C_REGION_TB::get();
        $data['city'] = C_CITY_TB::get();
        $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2, 3])->orwhereIn('DREF_CODE', [134, 125, 146])->get();

        $data['entry_detail'] = C_DEATH_CAUSE_TB::get();

        return view('dead.dead_search', $data);
    }


    public function insert_dead()
    {
        //  $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();
        $data['hospitals'] = DEADS_TB::ALL_HOS_DREF();
        // dd($data['hospitals']);
        $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::get();
        $data['marital_status'] = C_MARTIAL_STATUS_TB::get();
        $data['entry_detail'] = C_DEATH_CAUSE_TB::get();
        $data['jobs'] = C_JOB_TB::get();
        $data['nationality'] = C_NATIONALITY_TB::get();
        $data['religion'] = C_RELEGION_TB::get();
        $data['region'] = C_REGION_TB::get();
        $data['city'] = C_CITY_TB::get();
        // $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::get();
        $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2, 3])->orwhereIn('DREF_CODE', [134, 125, 146])->get();


        return view('dead.insert_dead', $data);
    }


    public function dashboard()
    {
        return view('dashboard');
    }


    //new code tariq

    public function getDeadResult(Request $request)
    {
        $role = [
            'P_DEAD_CODE' => 'nullable|numeric',
            'P_ID' => 'nullable|numeric|digits:9',
            'P_FIRST_NAME' => 'string|nullable',
            'P_SECOND_NAME' => 'string|nullable',
            'P_THIRD_NAME' => 'string|nullable',
            'P_LAST_NAME' => 'string|nullable',
            'P_DATE_FROM' => 'nullable|date_format:d/m/Y',
            'P_DATE_TO' => 'nullable|date_format:d/m/Y' ,
            'P_ENTER_FROM' => 'nullable|date_format:d/m/Y',
            'P_ENTER_TO' => 'nullable|date_format:d/m/Y' ,
            'P_SEX_NO' => 'numeric|nullable',
            'P_REGION_NO' => 'numeric|nullable',
            'P_CITY_NO' => 'numeric|nullable',
            'P_HOS_NO' => 'numeric|nullable',
            'DIAG1_NAME' => 'numeric|nullable',
            'DIAG4_NAME' => 'numeric|nullable',
            'P_DEATH_PLACE' => 'numeric|nullable',
            'P_ENTRY_POINT' => 'numeric|nullable',

        ];

        // dd($request->all());
        $data = $request->validate($role);


        $query = DEADS_TB::GET_DEAD_DATA_BY_ID($request->all());
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'DEADS_TB';
        $data1['column_name'] = ' ';
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
                if (IsPermissionBtn(23)) {

                    $action = '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-3" title="طباعة اشعار الوفاة"
                onclick="print_crt_dead(' . $value['DEAD_CODE'] . ')">
                <i class="fonticon-printer fs-3"></i>
            </button>';
                }
                if (IsPermissionBtn(24)) {

                    $action .= '<button type="button" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-3"
            onclick="update_crt_dead(' . $value['DEAD_CODE'] . ');"  title="تعديل بيانات اشعار الوفاة">
             <i class="fa-solid fa-pen-to-square fs-3"></i>
        </button>';
                }

                if (IsPermissionBtn(41) and $value['DEAD_SCANNED_ON'] != null) {


                    $action .= '<a type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-3"
                    onclick="open_files(' . $value['DEAD_ID'] . ');"  title="فتح إشعار الوفاة">
                    <i class="fas fa-file fs-3"></i>
                </button>';
                }



                $result['data'][] = array(
                    // $key + 1,
                    $value['DEAD_CODE'],
                    $value['DEAD_ID'],
                    // $value['DEATH_TYPE'],
                    $value['DEAD_DOB'],
                    $value['DEAD_DOD'],
                    $value['SEX_NAME_AR'],
                    $value['DEAD_FIRST_NAME_AR'] . ' ' . $value['DEAD_FATHER_NAME_AR'] . ' ' . $value['DEAD_GRANDFATHER_NAME_AR'] . ' ' . $value['DEAD_LAST_NAME_AR'],
                    $value['DREF_NAME_AR'],
                    // $value['DREF_NAME_AR'],
                    $value['ICD1_NAME'],
                    // $value['DEAD_ICD1'],
                    $value['ICD4_NAME'],
                    // $value['DEAD_ICD4'],

                    // $value['ICD1_NAME'] . ', ' . $value['ICD2_NAME'] . ' ,' . $value['ICD3_NAME'] . ', ' . $value['ICD4_NAME'] . ', ' . $value['ICD5_NAME'] . ', ' . $value['ICD6_NAME'] . ' ,' . $value['ICD7_NAME'] . ' ,' . $value['ICD8_NAME'],
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
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $request->merge(["start" => null]);
        $request->merge(["limit" => null]);
        $data_res = DEADS_TB::GET_DEAD_INFO($request->all());
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'DEADS_TB';
        $data1['column_name'] = ' ';
        $data['old_record'] = $request->all();
        $data1['type_action'] = 'DL';
        Log::create($data1);
        $result = Excel::download(new DeadExport($data_res), 'dead_excel.xlsx');
        ob_end_clean();
        return $result;
    }

    function save_dead_info(Request $request)

    {
        //$date=  Carbon::createFromFormat('d/m/Y', $request->P_BIRTH_DATE)->format('d/m/Y');
        $role = [

            'P_ID_NO' => 'required|numeric|digits:9',
            'P_ID_TYPE' => 'required',
            'P_FIRST_NAME' => 'required',
            'P_FATHER_NAME' => 'required',
            'P_GRAND_FATHER_NAME' => 'required',
            'P_FAMILY_NAME' => 'required',
            'P_BIRTH_DATE' => 'required|date_format:d/m/Y|before_or_equal:' . date('d/m/Y'),
            'P_BIRTH_DATE'.' '.'00:00' => 'before:P_DATE_DEATH|date_format:d/m/Y',
            'P_BIRTH_PLACE' => 'nullable',
            'P_JOB_CD' => 'nullable',
            'P_SEX_CD' => 'required|digits:1',
            Rule::in([1, 2]),
            'P_MARTIAL_STATUS_CD' => 'nullable',
            'P_NATIONALITY_CD' => 'nullable',
            'P_RELEGION_CD' => 'nullable',
            'P_HOS_CD' => 'required',
            'P_DEATH_PLACE_CD' => 'required',
            'P_DEATH_COUNTRY' => 'nullable',
            'P_DEATH_REGION_PLACE' => 'required',
            'P_DEATH_CITY_PLACE' => 'required',
            'P_DEAD_HOURS' => 'nullable',
            'P_REGION_CD' => 'nullable',
            'P_CITY_CD' => 'nullable',
            'P_DATE_DEATH' => 'required|date_format:d/m/Y H:i|before_or_equal:' . date('d/m/Y H:i'),
            'P_BURIAL_PLACE' => 'nullable',
            'P_BURIAL_CODE' => 'nullable',
            'P_PARTNER_ID' => 'nullable',
            'P_PARTNER_NAME' => 'nullable',
            'P_DEAD_DETAILS_CD' => 'nullable',
            'P_ICD_1' => 'required',
            'P_ICD_2' => 'nullable',
            'P_ICD_3' => 'nullable',
            'P_ICD_4' => 'required',
            'P_ICD_5' => 'nullable',
            'P_ICD_6' => 'nullable',
            'P_ICD_7' => 'nullable',
            'P_ICD_8' => 'nullable',
            'P_ICD_OTHER' => 'nullable',
            'P_PREGNANCY_CD' => 'nullable',
            'P_GESTATIONAL_WEEK' => 'nullable',
            'P_AFTER_DELIVERY_CD' => 'nullable',
            'P_REPORT_DOC_BY' => 'nullable',
            'P_DOC_SPECIALIST' => 'nullable',
            'P_DOC_ADDRESS' => 'nullable',
            'P_TREATMENT_DATE' => 'nullable',
            'P_PREVIEW_DATE' => 'nullable',
            'P_SEEING_CORPSE_DATE' => 'nullable',
            'P_CORPSE_DISSECTION_CD' => 'nullable',
            'P_CORPSE_DESSECTION_DATE' => 'nullable',
            'P_REPORT_SUBMITTED_ID' => 'required',
            'P_REPORT_SUBMITTED_BY' => 'nullable',
            'P_REPORTER_SEX_CD' => 'nullable',
            'P_REPORTER_NATIONALITY_CD' => 'nullable',
            'P_RELATIONSHIP' => 'nullable',
            'P_REPORTER_ADDRESS' => 'nullable',
            'P_REPORTER_MOBILE' => ['nullable', 'numeric', 'digits:10', new StartWith('059', '056')],
            'P_DATE_OF_REPORT' => 'required|date_format:d/m/Y H:i|after_or_equal:P_DATE_DEATH',            'P_RECEIVE_DATE' => 'nullable',
            'P_RECEIVER_NAME' => 'nullable',
            'P_REGISTER_DATE' => 'nullable',
            'P_REGISTER_NAME' => 'nullable',
            'P_REGISTER_PLACE_CD' => 'required',
            'P_SOURSE' => 'required',


        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-', $validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        $otp = rand(123456789, 999999999);
        $request->merge(["P_REPORT_CREATED_BY_CD" => Auth()->id()]);
        $request->merge(["P_QR_CD" => $otp]);
        // dd($request->all());

        try {
            $query = DEADS_TB::ADD_DEAD_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'DEADS_TB';
            $data1['column_name'] = ' ';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'S';
            Log::create($data1);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());

            return Response::json(array('success' => false, 'errors' => $exception->getMessage()));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => 'تمت عملية الإدخال بنجاح'));
    }
    public function getDeadIcd_name(Request $request)
    {
        $query = DEADS_TB::GET_ICD_DATA_AUTO($request->search);


        $result = array();
        foreach ($query as $key => $value) {
            $data['id'] = $value['ICD_CODE'];
            $data['text'] = $value['ICD_NAME_EN'];
            array_push($result, $data);
        }
        // Return results as json encoded array
        echo json_encode($result);
    }
    public function getDeadIcd_id(Request $request)
    {
        $query = DEADS_TB::GET_ICD_DATA_AUTO($request->search);


        $result = array();
        foreach ($query as $key => $value) {
            $data['id'] = $value['ICD_CODE'];
            $data['text'] = $value['ICD_CD'];
            array_push($result, $data);
        }
        // Return results as json encoded array
        echo json_encode($result);
    }

    public function getDeadIcd_bycode(Request $request)
    {
        $query = DEADS_TB::GET_ICD_BY_ID($request->P_ICD_CODE);

        return Response::json($query);
    }

    // update data
    function update_dead_info(Request $request)

    {

        $role = [
            'P_DEAD_NUMBER' => 'required',
            'P_ID_NO' => 'required|numeric|digits:9',
            'P_ID_TYPE' => 'required',
            'P_FIRST_NAME' => 'required',
            'P_FATHER_NAME' => 'required',
            'P_GRAND_FATHER_NAME' => 'required',
            'P_FAMILY_NAME' => 'required',
            'P_BIRTH_DATE' => 'required|date_format:d/m/Y|before_or_equal:' . date('d/m/Y'),
            'P_BIRTH_DATE'.' '.'00:00' => 'before:P_DATE_DEATH|date_format:d/m/Y',
            'P_BIRTH_PLACE' => 'nullable',
            'P_JOB_CD' => 'nullable',
            'P_SEX_CD' => 'required|digits:1',
            Rule::in([1, 2]),
            'P_MARTIAL_STATUS_CD' => 'nullable',
            'P_NATIONALITY_CD' => 'nullable',
            'P_RELEGION_CD' => 'nullable',
            'P_HOS_CD' => 'required',
            'P_DEATH_PLACE_CD' => 'required',
            'P_DEATH_COUNTRY' => 'nullable',
            'P_DEATH_REGION_PLACE' => 'required',
            'P_DEATH_CITY_PLACE' => 'required',
            'P_DEAD_HOURS' => 'nullable',
            'P_REGION_CD' => 'nullable',
            'P_CITY_CD' => 'nullable',
            'P_DATE_DEATH' => 'required|date_format:d/m/Y H:i|before_or_equal:' . date('d/m/Y H:i'),
            'P_BURIAL_PLACE' => 'nullable',
            'P_BURIAL_CODE' => 'nullable',
            'P_PARTNER_ID' => 'nullable',
            'P_PARTNER_NAME' => 'nullable',
            'P_DEAD_DETAILS_CD' => 'nullable',
            'P_ICD_1' => 'required',
            'P_ICD_2' => 'nullable',
            'P_ICD_3' => 'nullable',
            'P_ICD_4' => 'required',
            'P_ICD_5' => 'nullable',
            'P_ICD_6' => 'nullable',
            'P_ICD_7' => 'nullable',
            'P_ICD_8' => 'nullable',
            'P_ICD_OTHER' => 'nullable',
            'P_PREGNANCY_CD' => 'nullable',
            'P_GESTATIONAL_WEEK' => 'nullable',
            'P_AFTER_DELIVERY_CD' => 'nullable',
            'P_REPORT_DOC_BY' => 'nullable',
            'P_DOC_SPECIALIST' => 'nullable',
            'P_DOC_ADDRESS' => 'nullable',
            'P_TREATMENT_DATE' => 'nullable',
            'P_PREVIEW_DATE' => 'nullable',
            'P_SEEING_CORPSE_DATE' => 'nullable',
            'P_CORPSE_DISSECTION_CD' => 'nullable',
            'P_CORPSE_DESSECTION_DATE' => 'nullable',
            'P_REPORT_SUBMITTED_ID' => 'required',
            'P_REPORT_SUBMITTED_BY' => 'nullable',
            'P_REPORTER_SEX_CD' => 'nullable',
            'P_REPORTER_NATIONALITY_CD' => 'nullable',
            'P_RELATIONSHIP' => 'nullable',
            'P_REPORTER_ADDRESS' => 'nullable',
            'P_REPORTER_MOBILE' => ['nullable', 'numeric', 'digits:10', new StartWith('059', '056')],
            'P_DATE_OF_REPORT' => 'required|date_format:d/m/Y H:i|after_or_equal:P_DATE_DEATH',
            'P_RECEIVE_DATE' => 'nullable',
            'P_RECEIVER_NAME' => 'nullable',
            'P_REGISTER_DATE' => 'nullable',
            'P_REGISTER_NAME' => 'nullable',
            'P_REGISTER_PLACE_CD' => 'required',

        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-', $validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        $request->merge(["P_UPDATED_BY" => Auth()->id()]);
        try {
            $query = DEADS_TB::UPDATE_DEAD_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = Auth()->id();
            $data1['table_name'] = 'DEADS_TB';
            $data1['column_name'] = ' ';
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'U';
            Log::create($data1);
            // dd($query);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'errors'  => $exception->getMessage(), 400));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' =>  'تمت عملية التعديل بنجاح'));
    }
    public function getDeadInfoByIdNo(Request $request)
    {
        try {
            $query = DEADS_TB::GET_DEAD_INFO_BY_CODE($request->P_DEAD_NUMBER);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => ['message' => 'البيانات متوفرة']));
    }
    public function getDeadInfoById(Request $request)
    {
        try {
            $query = DEADS_TB::GET_DEAD_INFO_BY_ID($request->P_DEAD_ID);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'results' => ['message' => $exception->getMessage(), 400]));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' => $query));
    }
    public function getDeadInfoByCodeNo(Request $request)
    {

        $query = DEADS_TB::GET_DEAD_INFO_BY_CODE($request->P_DEAD_NUMBER);

        return Response::json(array('success' => true, 'results' => $query));
    }
    public function print_crt_dead(Request $request)
    {

        $role = [
            'P_DEAD_NUMBER' => 'numeric',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        $dead = DEADS_TB::where('DEAD_CODE', $request->P_DEAD_NUMBER)->first();

        if (isset($dead->dead_dod) && $dead->dead_dod == false) {
            return Response::json(array('success' => false, 'results' => ['message' => "يوجد خطأ في صيغة تاريخ الوفاة !!!"]));
        }
        if (($dead->dead_icd1_cd == null) || ($dead->dead_icd4_cd == null)) {
            return Response::json(array('success' => false, 'results' => ['message' => " يرجى استكمال بيانات المتوفي!!!"]));
        }

        return Response::json(array('success' => true, 'results' => ['message' => 'تمت العملية  بنجاح']));
    }
    public function print_dead_book($P_DEAD_NUMBER)
    {
        // dd($P_DEAD_NUMBER);

        $result['data'] = DEADS_TB::GET_DEAD_DATA_BY_CODE($P_DEAD_NUMBER);
        //if(($result['data'][0]['DEAD_ICD1_CD']!=null) || ($result['data'][0]['DEAD_ICD2_CD']!=null)){
        $result['image'] =  QrCode::size(30)->generate('https://sehatty.ps/public/printDead?dead_code=' . $result['data'][0]['QR_CODE']);

        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'DEADS_TB';
        $data1['column_name'] = 'DEAD_CODE';
        $data1['type_action'] = 'P';
        Log::create($data1);
        //return view('dead.dead_crt', $result);
        //dd( $result['data']);
        return view('dead.print_death', $result);
        /* }
       else

            return Response::json(array('success' => false, 'results' =>  "يرجى استكمال بيانات المتوفي وإدخال أسباب الوفاة!!!"));
*/
    }
    public function print_missing_form()
    {

        return view('dead.missing_form');
    }

    //     public function update_crt_dead(Request $request)
    //     {

    //         $role = [
    //             'P_DEAD_NUMBER' => 'numeric',
    //         ];

    //         $validator = Validator::make($request->all(), $role);
    //         if ($validator->fails()) {
    //             return Response::json(array(
    //                 'success' => false,
    //                 'errors' => $validator->getMessageBag()->toArray()

    //             )); // 400 being the HTTP code for an invalid request.
    //         }
    //         $dead = DEADS_TB::where('DEAD_CODE', $request->P_DEAD_NUMBER)->first();

    //         if (isset($dead->DEAD_DOD) && $dead->DEAD_DOD == false) {
    //             return Response::json(array('success' => false, 'results' => ['message' => "يوجد خطأ في صيغة تاريخ الوفاة !!!"]));
    //         }
    //     //     $print = PrintLog::where('DEAD_CODE', $request->P_DEAD_NUMBER)->count();
    //     return Response::json(array('success' => true, 'results' => ['message' => 'تمت العملية  بنجاح']));
    // }

    public function update_dead($dead_number = null)
    {
        if ($dead_number) {
            $data['dead_number'] = $dead_number;
            $data['jobs'] = C_JOB_TB::get();
            $data['hospitals'] = DEADS_TB::ALL_HOS_DREF();
            $data['marital_status'] = C_MARTIAL_STATUS_TB::get();
            $data['entry_detail'] = C_DEATH_CAUSE_TB::get();
            $data['nationality'] = C_NATIONALITY_TB::get();
            $data['religion'] = C_RELEGION_TB::get();
            $data['region'] = C_REGION_TB::get();
            $data['city'] = C_CITY_TB::get();
            $data['entry_detail'] = C_DEATH_CAUSE_TB::get();
            $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::get();

            return view('dead.insert_dead', $data);
        }
        return abort(404);
    }

    public function check_is_found(Request $request)
    {
        $role = [
            'ID_NO' => 'required|numeric|digits:9',
            'P_ID_TYPE' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $role);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'results' => implode('-', $validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        $data = DEADS_TB::DEAD_IS_FOUND($request->all());
        //  dd($data);
        $result['FLAG'] = $data['DEADS'];
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = $request->ID_NO;
        $data1['table_name'] = 'DEADS_TB';
        $data1['column_name'] = 'DEAD_ID';
        $data1['type_action'] = 'S';
        Log::create($data1);
        //dd($FLAG);
        if ($result['FLAG'] == 0) {

            return Response::json(array('success' => true, 'results' => $result));
        } else {
            return Response::json(array('success' => false, 'results' =>  "رقم الهوية مسجل مسبقاً في النظام!!!"));
        }
    }

    public function get_person_query(Request $request)
    {
        $role = [
            'P_ID_NO' => 'required|numeric|digits:9',
        ];
        $validator = Validator::make($request->all(), $role);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'results' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.

        }
        $data = DEADS_TB::GET_DEAD_CITZN_BY_ID($request->P_ID_NO);
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = $request->P_ID_NO;
        $data1['table_name'] = 'CITZN_API';
        $data1['column_name'] = 'ID_NO';
        $data1['type_action'] = 'S';
        Log::create($data1);
        //dd($data);
        if ($data) {
            $result['fname'] = $data['DEAD_FIRST_NAME_AR'];
            $result['sname'] = $data['DEAD_FATHER_NAME_AR'];
            $result['tname'] = $data['DEAD_GRANDFATHER_NAME_AR'];
            $result['lname'] = $data['DEAD_LAST_NAME_AR'];
            $result['birth_date'] =  Carbon::createFromFormat('d/m/Y', $data['DEAD_DOB'])->format('d/m/Y'); //$data['DEAD_DOB'];
            $result['sex'] = $data['DEAD_SEX_CD'];
            $result['DEAD_MARTIAL_STATUS'] = $data['DEAD_MARTIAL_STATUS'];
            $result['CITY_CD'] = $data['DEAD_CITY_CD'];
            $result['REGION_CD'] = $data['DEAD_REGION_CD'];
            $result['DEAD_PERSONALITY_CODE_CD'] = $data['DEAD_PERSONALITY_CODE_CD'];
            $result['DEAD_JOB'] = $data['DEAD_JOB'];
            $result['DEATH_DT'] = $data['DEATH_DT'];
            $result['BIRTH_PLACE'] = $data['DEAD_BIRTH_PLACE'];

            return Response::json(array('success' => true, 'results' => $result));
        } else {
            return Response::json(array('success' => false, 'results' =>  "بيانات رقم الهوية غير متوفرة !!!"));
        }
    }

    public function get_city(Request $request)
    {
        $query = DEADS_TB::GET_CITY($request->all());
        // dd($query);
        // return json_encode($query);

        return Response::json($query);
    }


    public function Get_dead_name(Request $request)
    {
        $role = [
            'ID_NUM' => 'required|numeric|digits:9',
        ];
        $validator = Validator::make($request->all(), $role);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'results' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.

        }
        $data = DEADS_TB::Get_dead_name($request->ID_NUM);
        //dd($data);
        if ($data) {
            $result['dname'] = $data['VAR_D_NAME'];

            return Response::json(array('success' => true, 'results' => $result));
        } else {
            return Response::json(array('success' => false, 'results' =>  "بيانات رقم الهوية غير متوفرة !!!"));
        }
    }

    public function open_crt_dead(Request $request)
    {

        return Response::json(array('success' => true, 'results' => $request->all()));
    }

    //----------------------------------------------------------------------------
    public function file_pdf(Request $request)
    {

        $result['data'] = $request->all();

        $path_file =  Storage::path('uploaded_files\\' . $result['data']['Dead_ID'] . '.pdf');
       // dd($path_file);
        if (Storage::exists('uploaded_files\\' . $result['data']['Dead_ID'] . '.pdf')) {

        $file = File::get($path_file);
        $response = Response::make($file, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
        }
        else{
            abort(404);

        }


    }
    public function get_helth_center(Request $request)
    {
      //  C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2, 3])->orwhereIn('DREF_CODE', [134, 125, 146])->get();
        //$query = DEADS_TB::GET_CITY($request->all());
        $query =C_DETAILS_REFERRAL_TB::where('DREF_CITY_CD',$request->city_cd)->get();
        // return json_encode($query);

        return Response::json($query);
    }


    //$data['HEALTH_CENTER'] =

}
