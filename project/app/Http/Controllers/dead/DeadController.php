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
use App\Models\User;
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
use App\Http\Traits\DeathDataTrait;
use App\Http\Traits\SendSmsTrait;
use App\Http\Traits\CheckDeadTrait;



use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


use Session;

use File;

use function Laravel\Prompts\alert;

class DeadController extends Controller
{
    use DeadDataTrait;
    use DeathDataTrait;

    use SendSmsTrait;
    use CheckDeadTrait;
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
        $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::get();

        // $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2, 3])->orwhereIn('DREF_CODE', [134, 125, 146])->get();
        $data['entry_employee'] = User::get();


        $data['entry_detail'] = C_DEATH_CAUSE_TB::get();

        return view('dead.dead_search', $data);
    }


    public function insert_dead()
    {
        $user_id = Auth()->id();
        $data['hos_no'] = User::where('id', $user_id)->value('user_dref_cd');
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
        //$data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2, 3])->orwhereIn('DREF_CODE', [134, 125, 146])->get();
        $data['entry_reg_place'] = C_DETAILS_REFERRAL_TB::get();


        return view('dead.insert_dead', $data);
    }


    public function dashboard()
    {

        return view('dashboard');
    }


    public function getDeadResult(Request $request)
    {
        ini_set('memory_limit', '1536M');

        // $role = [
        //     'P_DEAD_CODE' => 'numeric',
        //     'P_ID' => 'numeric|digits:9',
        //     'P_FIRST_NAME' => 'string|nullable',
        //     'P_SECOND_NAME' => 'string|nullable',
        //     'P_THIRD_NAME' => 'string|nullable',
        //     'P_LAST_NAME' => 'string|nullable',
        //     'P_DATE_FROM' => 'nullable|date_format:d/m/Y',
        //     'P_DATE_TO' => 'nullable|date_format:d/m/Y',
        //     'P_ENTER_FROM' => 'nullable|date_format:d/m/Y',
        //     'P_ENTER_TO' => 'nullable|date_format:d/m/Y',
        //     'P_SEX_NO' => 'numeric|nullable',
        //     'P_REGION_NO' => 'numeric|nullable',
        //     'P_CITY_NO' => 'numeric|nullable',
        //     'P_HOS_NO' => 'numeric|nullable',
        //     'DIAG1_NAME' => 'numeric|nullable',
        //     'DIAG4_NAME' => 'numeric|nullable',
        //     'P_DEATH_PLACE' => 'numeric|nullable',
        //     'P_ENTRY_POINT' => 'numeric|nullable',
        //     'P_ENTRY_EMPLOYEE' => 'numeric|nullable',
        // ];

        //  $data = $request->validate($role);

        $query = DEADS_TB::GET_DEAD_DATA_BY_ID($request->all());
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'DEADS_TB';
        $data1['column_name'] = ' ';
        //  $data['old_record'] = $request->all();
        $data1['type_action'] = 'S';
        Log::create($data1);
        // تسجيل الدخول
        // $data1['user_id'] = Auth()->id();
        // $data1['ip'] = request()->ip();
        // $data1['id_no'] = $request->P_ID? $request->P_ID : ' ';
        // $data1['table_name'] = 'DEADS_TB';
        // $data1['column_name'] = "";
        // //$data1['old_record'] = $request->all();
        // $data1['type_action'] = 'S';
        // Log::create($data1);

        $count = $query['RESULT_COUNT'] ?? 0;
        $totalData = $count;
        $totalFiltered = $totalData;
        $result['data'] = [];

        if (!empty($query['data']) && is_array($query['data'])) {
            foreach ($query['data'] as $value) {
                $action = '<div class="d-flex justify-content-center gap-1">';
                if (IsPermissionBtn(23)) {
                    $action .= '<button type="button" class="btn btn-icon btn-active-color-primary" title="طباعة اشعار الوفاة"
                    onclick="print_crt_dead(' . $value['DEAD_CODE'] . ')">
                    <i class="fonticon-printer fs-3"></i>
                </button>';
                }
                if (IsPermissionBtn(24)) {
                    $action .= '<button type="button" class="btn btn-icon btn-active-color-warning"
                    onclick="update_crt_dead(' . $value['DEAD_CODE'] . ');" title="تعديل بيانات اشعار الوفاة">
                    <i class="fa-solid fa-pen-to-square fs-3"></i>
                </button>';
                }
                if (IsPermissionBtn(41) && $value['DEAD_SCANNED_ON'] != null) {
                    $action .= '<button type="button" class="btn btn-icon btn-active-color-primary"
                    onclick="open_files(' . $value['DEAD_ID'] . ');" title="فتح إشعار الوفاة">
                    <i class="fas fa-file fs-3"></i>
                </button>';
                }
                if (IsPermissionBtn(44)) {
                    $action .= '<button type="button" class="btn btn-icon btn-active-color-warning"
                    onclick="delete_crt_dead(' . $value['DEAD_CODE'] . ');" title="حذف إشعار الوفاة">
                    <i class="fa fa-trash fs-3" style="color:red"></i>
                </button>';
                }
                $action .= '</div>';

                $result['data'][] = [
                    $value['DEAD_CODE'],
                    $value['DEAD_ID'],
                    $value['DEAD_DOB'],
                    $value['DEAD_DOD'],
                    $value['SEX_NAME_AR'],
                    $value['DEAD_FIRST_NAME_AR'] . ' ' . $value['DEAD_FATHER_NAME_AR'] . ' ' . $value['DEAD_GRANDFATHER_NAME_AR'] . ' ' . $value['DEAD_LAST_NAME_AR'],
                    $value['DREF_NAME_AR'],
                    $value['DEAD_ICD1'],
                    $value['ICD1_NAME'],
                    $value['USER_FULL_NAME'],
                    $action,
                ];
            }
        } else {
            // حالة عدم وجود بيانات، استخدام الـ API لتحديد السبب
            $check = $this->check_dead_records($request)->getData(true);
            $resultOut = $check['data']['data']['RESULT_OUT'] ?? null;
            $hos_name = $check['data']['data']['RESULT_DEATH_HOS'] ?? null;

            switch ($resultOut) {
                case 0:
                    $message = "لا يوجد بيانات في سجلات الوفيات أو سجلات المستشفيات";
                    break;

                case 1:
                    $message = "المريض متوفي داخل المستشفى ($hos_name) ولم يتم استكمال اجراءات تسجيل اشعار الوفاة";
                    break;
                default:
                    $message = "حالة غير محددة للبيانات";
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
                "results" => $message
            ]);
        }

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $result['data']
        ]);
    }

    public function export_excel(Request $request)
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $request->merge(["start" => null]);
        $request->merge(["limit" => null]);
        $data_res = DEADS_TB::GET_DEAD_INFO($request->all());
        // $data1['user_id'] = Auth()->id();
        // $data1['ip'] = request()->ip();
        // $data1['id_no'] = Auth()->id();
        // $data1['table_name'] = 'DEADS_TB';
        // $data1['column_name'] = ' ';
        // $data['old_record'] = $request->all();
        // $data1['type_action'] = 'DL';
        // Log::create($data1);
        $result = Excel::download(new DeadExport($data_res), 'dead_excel.xlsx');
        ob_end_clean();
        return $result;
    }

    function save_dead_info(Request $request)
    {
        // validate in js
        //$date=  Carbon::createFromFormat('d/m/Y', $request->P_BIRTH_DATE)->format('d/m/Y');
        $role = [

            'P_ID_NO' => 'required|numeric|digits:9',
            'P_ID_TYPE' => 'required',
            'P_FIRST_NAME' => 'required',
            'P_FATHER_NAME' => 'required',
            'P_GRAND_FATHER_NAME' => 'required',
            'P_FAMILY_NAME' => 'required',
            'P_BIRTH_DATE' => 'required|date_format:d/m/Y|before_or_equal:' . date('d/m/Y'),
            'P_BIRTH_DATE' . ' ' . '00:00' => 'before:P_DATE_DEATH|date_format:d/m/Y',
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
            // 'P_DATE_DEATH' => 'required|date_format:d/m/Y H:i|before_or_equal:' . date('d/m/Y H:i'),
            //'P_DATE_DEATH' => 'required|date_format:d/m/Y H:i|after_or_equal:P_BIRTH_DATE' . date('d/m/Y H:i'),
            // 'P_DATE_DEATH' => 'required|date_format:d/m/Y H:i|after_or_equal:P_BIRTH_DATE',
            'P_DATE_DEATH' => 'required|date_format:d/m/Y H:i|after_or_equal:' . 'P_BIRTH_DATE' . ' ' . '00:00',
            'P_BURIAL_PLACE' => 'nullable',
            'P_BURIAL_CODE' => 'nullable',
            'P_PARTNER_ID' => 'nullable',
            'P_PARTNER_NAME' => 'nullable',
            'P_DEAD_DETAILS_CD' => 'nullable',
            //  'DEAD_ICD1_CD' => 'required',
            // 'DEAD_ICD4_CD' => 'required',
            'P_ICD_1' => 'required|numeric',
            'P_ICD_2' => 'nullable',
            'P_ICD_3' => 'nullable',
            'P_ICD_4' => 'required|numeric',
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
            'P_RELATIONSHIP' => 'required|nullable',
            'P_REPORTER_ADDRESS' => 'nullable',
            'P_REPORTER_MOBILE' => ['nullable', 'numeric', 'digits:10', new StartWith('059', '056')],
            'P_DATE_OF_REPORT' => 'required|date_format:d/m/Y H:i|after_or_equal:P_DATE_DEATH',
            'P_RECEIVE_DATE' => 'nullable',
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
            //dd($query);
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
        return Response::json(array('success' => true, 'results' => 'تمت عملية الإدخال بنجاح', $query));
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
            'P_SEX_CD' => ['required', 'digits:1', Rule::in([1, 2])],
            'P_HOS_CD' => 'required',
            'P_DEATH_PLACE_CD' => 'required',
            'P_DEATH_REGION_PLACE' => 'required',
            'P_DEATH_CITY_PLACE' => 'required',
            'P_ICD_1' => 'required',
            'P_ICD_4' => 'required',
            'P_REPORT_SUBMITTED_ID' => 'required',
            'P_DATE_DEATH' => 'required|date_format:d/m/Y H:i',
            'P_DATE_OF_REPORT' => 'required|date_format:d/m/Y H:i|after_or_equal:P_DATE_DEATH',
            'P_REGISTER_PLACE_CD' => 'required',
            'P_SOURCE' => 'required',
            // باقي الحقول nullable
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'errors' => implode('-', $validator->errors()->all())
            ]);
        }

        $request->merge(["P_UPDATED_BY" => auth()->id()]);

        try {
            // 🔹 جلب السجل الحالي من قاعدة البيانات
            $dead = DEADS_TB::where('DEAD_CODE', $request->P_DEAD_NUMBER)->first();

            if ($dead) {
                //dd($dead->qr_code);
                // 🔹 إذا كان الـ QR_CODE فارغ أو NULL، نولّد رقم جديد غير مكرر
                if (empty($dead->qr_code)) {
                    do {
                        $newQR = rand(123456789, 999999999);
                        $exists = DEADS_TB::where('qr_code', $newQR)->exists();
                    } while ($exists);

                    $request->merge(["P_QR_CD" => $newQR]);
                } else {
                    $request->merge(["P_QR_CD" => $dead->qr_code]);
                }

                // 🔹 تحديث باقي الحقول من الطلب
                $query = DEADS_TB::UPDATE_DEAD_DATA($request->all());

                // 🔹 تسجيل العملية في سجل الأحداث
                Log::create([
                    'user_id'     => auth()->id(),
                    'ip'          => request()->ip(),
                    'id_no'       => auth()->id(),
                    'table_name'  => 'DEADS_TB',
                    'column_name' => $request->P_DEAD_NUMBER,
                    'type_action' => 'U',
                ]);
            } else {
                return Response::json(['success' => false, 'errors' => 'السجل غير موجود']);
            }
        } catch (\Exception $exception) {
            return Response::json([
                'success' => false,
                'errors'  => $exception->getMessage(),
            ], 400);
        }

        return Response::json(['success' => true, 'results' => 'تمت عملية التعديل بنجاح']);
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
        //  dd($request->all());
        $dead = DEADS_TB::where('DEAD_CODE', $request->P_DEAD_NUMBER)->first();
        //  dd($dead);

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
        $data1['column_name'] = $P_DEAD_NUMBER;
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
            $user_id = Auth()->id();
            $data['hos_no'] = User::where('id', $user_id)->value('user_dref_cd');
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
        $data1['column_name'] = $request->ID_NO;
        $data1['type_action'] = 'S';
        Log::create($data1);
        //dd($FLAG);
        if ($result['FLAG'] == 0) {

            return Response::json(array('success' => true, 'results' => $result));
        } else {
            return Response::json(array('success' => false, 'results' =>  "رقم الهوية مسجل مسبقاً في النظام!!!"));
        }
    }
    private function isMaskedName($name)
    {
        return preg_match('/^[\p{Arabic}]{1}\*+$/u', $name);
    }

    private function saveCitizenFromApi(array $row)
    {
        $birthDate = !empty($row['BirthDate'])
            ? Carbon::createFromFormat('d/m/Y', $row['BirthDate'])->format('Y-m-d')
            : null;

        $rec = DEADS_TB::GET_DEAD_CITZN_BY_ID($row['IdNumber']);

        if (!$rec) {
            DEADS_TB::INSERT_NEW_CITIZEN_BY_ID(
                $row['IdNumber'],
                $row['FirstName'],
                $row['FatherName'],
                $row['FatherGrandName'],
                $row['FamilyName'],
                $birthDate,
                $row['PersonalCD'],
                $row['Personal'],
                $row['Gender'],
                $row['GenderCD'],
                $row['Region'],
                $row['RegionCD'],
                $row['FATHER_ID'],
                $row['MOTHER_ID'],
                $row['BIRTH_COUNTRY_CD'],
                $row['BIRTH_COUNTRY_DESC'],
                $row['BIRTH_CITY_CD'],
                $row['BIRTH_CITY_DESC']
            );
        } else {
            DEADS_TB::UPDATE_NEW_CITIZEN_BY_ID(
                $row['IdNumber'],
                $row['FirstName'],
                $row['FatherName'],
                $row['FatherGrandName'],
                $row['FamilyName'],
                $birthDate,
                $row['PersonalCD'],
                $row['Personal'],
                $row['Gender'],
                $row['GenderCD'],
                $row['Region'],
                $row['RegionCD'],
                $row['FATHER_ID'],
                $row['MOTHER_ID'],
                $row['BIRTH_COUNTRY_CD'],
                $row['BIRTH_COUNTRY_DESC'],
                $row['BIRTH_CITY_CD'],
                $row['BIRTH_CITY_DESC']
            );
        }
    }

    private function mapApiResult(array $row)
    {
        return [
            'fname' => $row['FirstName'] ?? null,
            'sname' => $row['FatherName'] ?? null,
            'tname' => $row['FatherGrandName'] ?? null,
            'lname' => $row['FamilyName'] ?? null,
            'birth_date' => !empty($row['BirthDate'])
                ? Carbon::createFromFormat('d/m/Y', $row['BirthDate'])->format('d/m/Y')
                : null,
            'sex' => $row['GenderCD'] ?? null,
            'DEAD_PERSONALITY_CODE_CD' => $row['PersonalCD'] ?? null,
            'REGION_CD' => $row['RegionCD'] ?? null,
            'CITY_CD' => $row['BIRTH_CITY_CD'] ?? null,
        ];
    }

    private function logSearch($table, $idNo)
    {
        Log::create([
            'user_id' => Auth()->id(),
            'ip' => request()->ip(),
            'id_no' => $idNo,
            'table_name' => $table,
            'column_name' => $idNo,
            'type_action' => 'S',
        ]);
    }

public function get_person_query(Request $request)
{
    /* ================= Validation ================= */
    $validator = Validator::make($request->all(), [
        'P_ID_NO' => 'required|numeric|digits:9',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'results' => $validator->errors()
        ], 422);
    }

    $idNo = $request->P_ID_NO;

    /************************* ID Check *************************/
    $check_id = DEADS_TB::CHECK_ID($idNo);
    if ($check_id != 1) {
        return response()->json([
            'success' => false,
            'message' => 'رقم الهوية غير صحيح'
        ], 404);
    }

    /* ================= Oracle Search ================= */
    $data = null;

    try {
        $data = DEADS_TB::GET_DEAD_CITZN_BY_ID($idNo);
    }
    catch (\Yajra\Pdo\Oci8\Exceptions\Oci8Exception $e) {
        // أي خطأ Oracle (lock / timeout / unique)
        $data = null;
    }
    catch (\Throwable $e) {
        $data = null;
    }

    /* ================= Oracle Returned Data ================= */
    if (!empty($data) && !empty($data['DEAD_FATHER_NAME_AR'])) {

        $this->logSearch('CITZN_API', $idNo);

        // الاسم مخفي؟
        if ($this->isMaskedName($data['DEAD_FATHER_NAME_AR'])) {

            $apiResult = $this->check_record_death($request);

            if (!empty($apiResult['Data'][0])) {

                $row = $apiResult['Data'][0];

                $this->logSearch('GetCtznDead_API', $idNo);
                $this->saveCitizenFromApi($row);

                return response()->json([
                    'success' => true,
                    'results' => $this->mapApiResult($row)
                ]);
            }

        } else {

            // بيانات DB مباشرة
            return response()->json([
                'success' => true,
                'results' => [
                    'fname' => $data['DEAD_FIRST_NAME_AR'],
                    'sname' => $data['DEAD_FATHER_NAME_AR'],
                    'tname' => $data['DEAD_GRANDFATHER_NAME_AR'],
                    'lname' => $data['DEAD_LAST_NAME_AR'],
                    'birth_date' => !empty($data['DEAD_DOB'])
                        ? Carbon::createFromFormat('d/m/Y', $data['DEAD_DOB'])->format('d/m/Y')
                        : null,
                    'sex' => $data['DEAD_SEX_CD'],
                    'DEAD_MARTIAL_STATUS' => $data['DEAD_MARTIAL_STATUS'],
                    'CITY_CD' => $data['DEAD_CITY_CD'],
                    'REGION_CD' => $data['DEAD_REGION_CD'],
                    'DEAD_PERSONALITY_CODE_CD' => $data['DEAD_PERSONALITY_CODE_CD'],
                    'DEAD_JOB' => $data['DEAD_JOB'],
                    'DEATH_DT' => $data['DEATH_DT'],
                    'BIRTH_PLACE' => $data['DEAD_BIRTH_PLACE'],
                ]
            ]);
        }
    }

    /* ================= Oracle Failed → API ================= */
    $apiResult = $this->check_record_death($request);

    if (!empty($apiResult['Data'][0])) {

        $row = $apiResult['Data'][0];

        $this->saveCitizenFromApi($row);
        $this->logSearch('GetCtznDead_API', $idNo);

        return response()->json([
            'success' => true,
            'results' => $this->mapApiResult($row)
        ]);
    }

    /* ================= No Data ================= */
    return response()->json([
        'success' => false,
        'message' => 'بيانات رقم الهوية غير متوفرة'
    ], 404);
}


    // public function get_person_query(Request $request)
    // {
    //     /* ================= Validation ================= */
    //     $validator = Validator::make($request->all(), [
    //         'P_ID_NO' => 'required|numeric|digits:9',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'results' => $validator->errors()
    //         ], 422);
    //     }

    //     $idNo = $request->P_ID_NO;
    //     /*************************ID Check********************** */

    //     $check_id = DEADS_TB::CHECK_ID($idNo);
    //     if ($check_id != 1) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'رقم الهوية غير صحيح'
    //         ], 404);
    //     } else {
    //         /* ================= Oracle Search ================= */
    //         $data = DEADS_TB::GET_DEAD_CITZN_BY_ID($idNo);
    //         if (!empty($data)) {

    //             if ($data['DEAD_FATHER_NAME_AR']) {
    //                 $this->logSearch('CITZN_API', $idNo);

    //                 // الاسم مخفي؟
    //                 if ($this->isMaskedName($data['DEAD_FATHER_NAME_AR'])) {

    //                     $apiResult = $this->check_record_death($request);

    //                     if (!empty($apiResult['Data'][0])) {

    //                         $row = $apiResult['Data'][0];

    //                         $this->logSearch('GetCtznDead_API', $idNo);
    //                         $this->saveCitizenFromApi($row);

    //                         $result = $this->mapApiResult($row);

    //                         return response()->json([
    //                             'success' => true,
    //                             'results' => $result
    //                         ]);
    //                     }
    //                 } else {

    //                     // بيانات DB مباشرة
    //                     $result = [
    //                         'fname' => $data['DEAD_FIRST_NAME_AR'],
    //                         'sname' => $data['DEAD_FATHER_NAME_AR'],
    //                         'tname' => $data['DEAD_GRANDFATHER_NAME_AR'],
    //                         'lname' => $data['DEAD_LAST_NAME_AR'],
    //                         'birth_date' => !empty($data['DEAD_DOB'])
    //                             ? Carbon::createFromFormat('d/m/Y', $data['DEAD_DOB'])->format('d/m/Y')
    //                             : null,
    //                         'sex' => $data['DEAD_SEX_CD'],
    //                         'DEAD_MARTIAL_STATUS' => $data['DEAD_MARTIAL_STATUS'],
    //                         'CITY_CD' => $data['DEAD_CITY_CD'],
    //                         'REGION_CD' => $data['DEAD_REGION_CD'],
    //                         'DEAD_PERSONALITY_CODE_CD' => $data['DEAD_PERSONALITY_CODE_CD'],
    //                         'DEAD_JOB' => $data['DEAD_JOB'],
    //                         'DEATH_DT' => $data['DEATH_DT'],
    //                         'BIRTH_PLACE' => $data['DEAD_BIRTH_PLACE'],
    //                     ];

    //                     return response()->json([
    //                         'success' => true,
    //                         'results' => $result
    //                     ]);
    //                 }
    //             }
    //         }


    //         /* ================= No Oracle → API ================= */
    //         $apiResult = $this->check_record_death($request);

    //         if (!empty($apiResult['Data'][0])) {

    //             $row = $apiResult['Data'][0];

    //             $this->saveCitizenFromApi($row);
    //             $this->logSearch('GetCtznDead_API', $idNo);

    //             return response()->json([
    //                 'success' => true,
    //                 'results' => $this->mapApiResult($row)
    //             ]);
    //         }
    //     }

    //     /* ================= No Data ================= */
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'بيانات رقم الهوية غير متوفرة'
    //     ], 404);
    // }
    public function get_person_query2(Request $request)
    {
        $role = [
            'P_ID_NO' => 'required|numeric|digits:9',
            //    'P_DEAD_NUMBER' => 'numeric',
        ];
        $validator = Validator::make($request->all(), $role);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'results' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.

        }
        $data = DEADS_TB::GET_DEAD_CITZN_BY_ID($request->P_ID_NO);

        if (!empty($data)) {

            $data1['user_id'] = Auth()->id();
            $data1['ip'] = request()->ip();
            $data1['id_no'] = $request->P_ID_NO;
            $data1['table_name'] = 'CITZN_API';
            $data1['column_name'] = $request->P_ID_NO;
            $data1['type_action'] = 'S';
            Log::create($data1);
            //dd($data);

            // إذا كان الاسم الأول مخفي → نستخدم بيانات API
            if ($this->isMaskedName($data['DEAD_FATHER_NAME_AR'])) {
                $apiResult = $this->check_record_death($request);

                if (!empty($apiResult) && isset($apiResult['Data'][0])) {
                    $data1['user_id'] = Auth()->id();
                    $data1['ip'] = request()->ip();
                    $data1['id_no'] = $request->P_ID_NO;
                    $data1['table_name'] = 'GetCtznDead_API';
                    $data1['column_name'] = $request->P_ID_NO;
                    $data1['type_action'] = 'S';
                    Log::create($data1);

                    $result['fname'] = $apiResult['Data'][0]['FirstName'];
                    $result['sname'] = $apiResult['Data'][0]['FatherName'];
                    $result['tname'] = $apiResult['Data'][0]['FatherGrandName'];
                    $result['lname'] = $apiResult['Data'][0]['FamilyName'];
                    $birthDate = Carbon::createFromFormat('d/m/Y', $apiResult['Data'][0]['BirthDate'])->format('Y-m-d');
                    $rec = DEADS_TB::GET_DEAD_CITZN_BY_ID($apiResult['Data'][0]['IdNumber']);
                    if (!$rec) {
                        $INSERT_CITIZEN = DEADS_TB::INSERT_NEW_CITIZEN_BY_ID($apiResult['Data'][0]['IdNumber'], $apiResult['Data'][0]['FatherName'], $apiResult['Data'][0]['FatherName'], $apiResult['Data'][0]['FatherGrandName'], $apiResult['Data'][0]['FamilyName'], $birthDate, $apiResult['Data'][0]['PersonalCD'], $apiResult['Data'][0]['Personal'], $apiResult['Data'][0]['Gender'], $apiResult['Data'][0]['GenderCD'], $apiResult['Data'][0]['Region'], $apiResult['Data'][0]['RegionCD'], $apiResult['Data'][0]['FATHER_ID'], $apiResult['Data'][0]['MOTHER_ID'], $apiResult['Data'][0]['BIRTH_COUNTRY_CD'], $apiResult['Data'][0]['BIRTH_COUNTRY_DESC'], $apiResult['Data'][0]['BIRTH_CITY_CD'], $apiResult['Data'][0]['BIRTH_CITY_DESC']);
                    } else {
                        $UPDATE_CITIZEN = DEADS_TB::UPDATE_NEW_CITIZEN_BY_ID($apiResult['Data'][0]['IdNumber'], $apiResult['Data'][0]['FatherName'], $apiResult['Data'][0]['FatherName'], $apiResult['Data'][0]['FatherGrandName'], $apiResult['Data'][0]['FamilyName'], $birthDate, $apiResult['Data'][0]['PersonalCD'], $apiResult['Data'][0]['Personal'], $apiResult['Data'][0]['Gender'], $apiResult['Data'][0]['GenderCD'], $apiResult['Data'][0]['Region'], $apiResult['Data'][0]['RegionCD'], $apiResult['Data'][0]['FATHER_ID'], $apiResult['Data'][0]['MOTHER_ID'], $apiResult['Data'][0]['BIRTH_COUNTRY_CD'], $apiResult['Data'][0]['BIRTH_COUNTRY_DESC'], $apiResult['Data'][0]['BIRTH_CITY_CD'], $apiResult['Data'][0]['BIRTH_CITY_DESC']);
                    }
                }
            } else {
                // غير مخفي → استخدم بيانات DB العادية
                $result['fname'] = $data['DEAD_FIRST_NAME_AR'];
                $result['sname'] = $data['DEAD_FATHER_NAME_AR'];
                $result['tname'] = $data['DEAD_GRANDFATHER_NAME_AR'];
                $result['lname'] = $data['DEAD_LAST_NAME_AR'];
            }

            if (!empty($data['DEAD_DOB'])) {
                $result['birth_date'] =  Carbon::createFromFormat('d/m/Y', $data['DEAD_DOB'])->format('d/m/Y'); //$data['DEAD_DOB'];
            } else {
                $result['birth_date'] = null; // أو "غير متوفر"
            }
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

            // -------------------------------
            // لا توجد بيانات في Oracle → نستدعي API الخارجي
            // -------------------------------

            $apiResult = $this->check_record_death($request);

            if (!empty($apiResult) && isset($apiResult['Data'])) {

                $birthDate = Carbon::createFromFormat('d/m/Y', $apiResult['Data'][0]['BirthDate'])->format('Y-m-d');
                $rec = DEADS_TB::GET_DEAD_CITZN_BY_ID($apiResult['Data'][0]['IdNumber']);
                if (!$rec) {

                    $INSERT_CITIZEN = DEADS_TB::INSERT_NEW_CITIZEN_BY_ID($apiResult['Data'][0]['IdNumber'], $apiResult['Data'][0]['FatherName'], $apiResult['Data'][0]['FatherName'], $apiResult['Data'][0]['FatherGrandName'], $apiResult['Data'][0]['FamilyName'], $birthDate, $apiResult['Data'][0]['PersonalCD'], $apiResult['Data'][0]['Personal'], $apiResult['Data'][0]['Gender'], $apiResult['Data'][0]['GenderCD'], $apiResult['Data'][0]['Region'], $apiResult['Data'][0]['RegionCD'], $apiResult['Data'][0]['FATHER_ID'], $apiResult['Data'][0]['MOTHER_ID'], $apiResult['Data'][0]['BIRTH_COUNTRY_CD'], $apiResult['Data'][0]['BIRTH_COUNTRY_DESC'], $apiResult['Data'][0]['BIRTH_CITY_CD'], $apiResult['Data'][0]['BIRTH_CITY_DESC']);
                } else {
                    $UPDATE_CITIZEN = DEADS_TB::UPDATE_NEW_CITIZEN_BY_ID($apiResult['Data'][0]['IdNumber'], $apiResult['Data'][0]['FatherName'], $apiResult['Data'][0]['FatherName'], $apiResult['Data'][0]['FatherGrandName'], $apiResult['Data'][0]['FamilyName'], $birthDate, $apiResult['Data'][0]['PersonalCD'], $apiResult['Data'][0]['Personal'], $apiResult['Data'][0]['Gender'], $apiResult['Data'][0]['GenderCD'], $apiResult['Data'][0]['Region'], $apiResult['Data'][0]['RegionCD'], $apiResult['Data'][0]['FATHER_ID'], $apiResult['Data'][0]['MOTHER_ID'], $apiResult['Data'][0]['BIRTH_COUNTRY_CD'], $apiResult['Data'][0]['BIRTH_COUNTRY_DESC'], $apiResult['Data'][0]['BIRTH_CITY_CD'], $apiResult['Data'][0]['BIRTH_CITY_DESC']);
                }
                $data1['user_id'] = Auth()->id();
                $data1['ip'] = request()->ip();
                $data1['id_no'] = $request->P_ID_NO;
                $data1['table_name'] = 'GetCtznDead_API';
                $data1['column_name'] = $request->P_ID_NO;
                $data1['type_action'] = 'S';
                Log::create($data1);
                $result['fname'] = $apiResult['Data'][0]['FirstName'];
                $result['sname'] = $apiResult['Data'][0]['FatherName'];
                $result['tname'] = $apiResult['Data'][0]['FatherGrandName'];
                $result['lname'] = $apiResult['Data'][0]['FamilyName'];
                if (!empty($apiResult['Data'][0]['BirthDate'])) {
                    $result['birth_date'] =  Carbon::createFromFormat('d/m/Y', $apiResult['Data'][0]['BirthDate'])->format('d/m/Y'); //$data['DEAD_DOB'];
                } else {
                    $result['birth_date'] = null;
                }

                $result['sex'] = $apiResult['Data'][0]['sex_cd'];
                $result['DEAD_PERSONALITY_CODE_CD'] = $apiResult['Data'][0]['personal_cd'];
                $result['REGION_CD'] = $apiResult['Data'][0]['REGION_CD'] ?? '';
                $result['CITY_CD'] = $apiResult['Data'][0]['CITY_CD'] ?? '';

                return Response::json([
                    'success' => true,
                    'results' => $result
                ]);
            }
        }

        // لا بيانات في Oracle ولا API
        return Response::json([
            'success' => false,
            'results' => "بيانات رقم الهوية غير متوفرة !!!"
        ]);
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
        $path_file =  Storage::path('uploaded_files/' . $result['data']['Dead_ID'] . '.pdf');
        if (Storage::exists('uploaded_files/' . $result['data']['Dead_ID'] . '.pdf')) {
            $file = File::get($path_file);
            $response =   response()->download($path_file, $result['data']['Dead_ID'] . '.pdf', ['Content-Type' => 'application/pdf']);
            return $response;
        } else {
            abort(404);
        }
    }
    public function get_helth_center(Request $request)
    {
        //  C_DETAILS_REFERRAL_TB::whereIn('DREF_M_CD', [2, 3])->orwhereIn('DREF_CODE', [134, 125, 146])->get();
        //$query = DEADS_TB::GET_CITY($request->all());
        $query = C_DETAILS_REFERRAL_TB::where('DREF_CITY_CD', $request->city_cd)->get();
        // return json_encode($query);

        return Response::json($query);
    }

    public function get_hos_by_place(Request $request)
    {
        if ($request->death_place_cd == 2) {
            $query = C_DETAILS_REFERRAL_TB::where('DREF_CODE', 125)->get();
        } elseif ($request->death_place_cd == 3) {
            $query = C_DETAILS_REFERRAL_TB::whereIn('DREF_CODE', [138, 166, 167, 173, 174, 175, 176])->get();
        } else {
            $query = C_DETAILS_REFERRAL_TB::whereNotIn('DREF_CODE', [125, 138, 166, 167, 173, 174, 175, 176])->get();
        }


        return Response::json($query);
    }
    //$data['HEALTH_CENTER'] =
    function delete_dead(Request $request)
    {

        $role = [
            'P_DEAD_NUMBER' => 'required',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-', $validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        // $request->merge(["P_DELETE_BY" => Auth()->id()]);
        $ip = request()->ip() === '::1' ? '127.0.0.1' : request()->ip();
        // dd($ip);
        try {
            $query = DEADS_TB::DELETE_DEAD_DATA($request->all());
            $data1['user_id'] = Auth()->id();
            $data1['ip'] = $ip;
            $data1['id_no'] = $request->P_DEAD_NUMBER;
            $data1['table_name'] = 'DEADS_TB';
            $data1['column_name'] = $request->P_DEAD_NUMBER;
            $data['old_record'] = $request->all();
            $data1['type_action'] = 'D';
            Log::create($data1);

            $deadId = basename($request->P_DEAD_NUMBER); // تعقيم المدخل
            $filePath = 'uploaded_files/' . $deadId . '.pdf';
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }


            // dd($query);
        } catch (\Exception $exception) {
            //DB::rollBack();

            //dd($exception->getMessage().$message->toString());
            return Response::json(array('success' => false, 'errors'  => $exception->getMessage(), 400));
            //$exception->getTraceAsString()
        }
        return Response::json(array('success' => true, 'results' =>  'تمت عملية الحذف بنجاح'));
    }
}
