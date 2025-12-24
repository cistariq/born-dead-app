<?php

namespace App\Http\Controllers;

use App\Rules\StartWith;

use App\Http\Controllers\Controller;
use App\Http\Traits\CitizenDataTrait;
use App\Http\Traits\BornDataTrait;
use App\Http\Traits\BirthApiTrait;
use App\Models\Constant;
use App\Models\Log;
use App\Models\C_DETAILS_REFERRAL_TB;
use App\Models\C_HOSPITAL_TB;

use App\Models\C_MARTIAL_STATUS_TB;
use App\Models\C_RELEGION_TB;
use App\Models\C_JOB_TB;
use App\Models\C_CITY_TB;
use App\Models\C_REGION_TB;
use App\Models\BORNS_INFO_TB;
use App\Exports\BornExport;
use App\Exports\QuotaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Quota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class QuoteBornController extends Controller
{
    use CitizenDataTrait, BirthApiTrait;


    public function new_order_quote(Request $request)
    {

        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

        // ==============================
        // 1) تجهيز القيم الافتراضية للمستخدم
        // ==============================
        $userId = Auth::id();
        $data['defaultHospital'] = User::where('id', $userId)->value('user_dref_cd');
        //   dd($defaultHospital);

        return view('born.new_order_quote', $data);
    }
    public function approve_quote_request()
    {

        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

        // ==============================
        // 1) تجهيز القيم الافتراضية للمستخدم
        // ==============================
        $userId = Auth::id();
        $data['defaultHospital'] = User::where('id', $userId)->value('user_dref_cd');

        return view('born.approve_quote_request', $data);
    }
    public function quote_search()
    {

        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

        // ==============================
        // 1) تجهيز القيم الافتراضية للمستخدم
        // ==============================
        $userId = Auth::id();
        $data['defaultHospital'] = User::where('id', $userId)->value('user_dref_cd');

        return view('born.quote_search', $data);
    }
    public function release_requests()
    {
        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

        // ==============================
        // 1) تجهيز القيم الافتراضية للمستخدم
        // ==============================
        $userId = Auth::id();
        $data['defaultHospital'] = User::where('id', $userId)->value('user_dref_cd');

        return view('born.release_requests', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'hos_no'            => 'required|numeric',
            'current_number'    => 'required|numeric',
            'last_number'       => 'required|numeric',
            'remaining_numbers' => 'required|numeric',
        ]);

        // تحقق من شرط المتبقي
        if ($request->remaining_numbers > 500) {
            return Response::json([
                'success' => false,
                'results' => 'لا يمكنك الطلب في الوقت الحالي، يرجى الانتظار حتى يتبقى لك أقل من 500 رقم'
            ]);
        }
        $userId = Auth::id();
        $user_code = User::where('id', $userId)->value('user_id_no');
        $quota = new Quota();
        $quota->CURRENT_NUMBER  = $request->current_number;
        $quota->LAST_NUMBER     = $request->last_number;
        $quota->REMAINING_DIGIT = $request->remaining_numbers;
        $quota->ORDER_STATUS    = 0; // حالة الطلب: جديد
        $quota->HOS_NO          = $request->hos_no;
        $quota->REQUEST_EMP     = $user_code ?? 1;
        $quota->REQUEST_DATE    = now();
        $quota->save();

        return Response::json([
            'success' => true,
            'results' => 'تم حفظ الطلب بنجاح'
        ]);
    }

    public function search(Request $request)
    {
        $query = Quota::query()
            ->join('C_DETAILS_REFERRAL_TB as H', 'H.DREF_CODE', '=', 'BIRTH_QUOTA_TB.HOS_NO')
            ->select(
                'BIRTH_QUOTA_TB.*',
                'H.DREF_NAME_AR as HOS_NAME'
            );

        // فلترة بالمستشفى
        if ($request->filled('P_HOS_NO')) {
            $query->where('BIRTH_QUOTA_TB.HOS_NO', $request->P_HOS_NO);
        }

        // فلترة بتاريخ الطلب من
        if ($request->filled('P_DATE_FROM')) {
            $query->whereDate('BIRTH_QUOTA_TB.REQUEST_DATE', '>=', $request->P_DATE_FROM);
        }

        // فلترة بتاريخ الطلب إلى
        if ($request->filled('P_DATE_TO')) {
            $query->whereDate('BIRTH_QUOTA_TB.REQUEST_DATE', '<=', $request->P_DATE_TO);
        }

        $results = $query->orderBy('BIRTH_QUOTA_TB.REQUEST_DATE', 'desc')->get();
        //dd($results);

        return response()->json($results);
    }

    public function search_quote(Request $request)
    {
        $query = Quota::query()
            ->join('C_DETAILS_REFERRAL_TB as H', 'H.DREF_CODE', '=', 'BIRTH_QUOTA_TB.HOS_NO')
            ->select(
                'BIRTH_QUOTA_TB.id',
                'H.DREF_NAME_AR as hos_name',
                'BIRTH_QUOTA_TB.CURRENT_NUMBER as current_number',
                'BIRTH_QUOTA_TB.LAST_NUMBER as last_number',
                'BIRTH_QUOTA_TB.REMAINING_DIGIT as remaining_digit',
                'BIRTH_QUOTA_TB.ORDER_STATUS as order_status',
                'BIRTH_QUOTA_TB.SPENT_NUMBER_FROM as release_from',
                'BIRTH_QUOTA_TB.SPENT_NUMBER_TO as release_to'
            );

        // فلترة بالمستشفى
        if ($request->filled('P_HOS_NO')) {
            $query->where('BIRTH_QUOTA_TB.HOS_NO', $request->P_HOS_NO);
        }
        // فلترة بحالة الطلب
        if ($request->filled('P_STATUS_NO')) {
            $query->where('BIRTH_QUOTA_TB.ORDER_STATUS', $request->P_STATUS_NO);
        }


        // فلترة بتاريخ الطلب من
        if ($request->filled('P_DATE_FROM')) {
            $query->whereRaw("TRUNC(BIRTH_QUOTA_TB.REQUEST_DATE) >= TO_DATE(?, 'DD/MM/YYYY')", [$request->P_DATE_FROM]);
        }

        // فلترة بتاريخ الطلب إلى
        if ($request->filled('P_DATE_TO')) {
            $query->whereRaw("TRUNC(BIRTH_QUOTA_TB.REQUEST_DATE) <= TO_DATE(?, 'DD/MM/YYYY')", [$request->P_DATE_TO]);
        }

        // 🔍 تصفية بالرقم بين release_from و release_to
        if ($request->filled('searchNumber')) {
            $query->whereRaw('? BETWEEN "BIRTH_QUOTA_TB"."SPENT_NUMBER_FROM" AND "BIRTH_QUOTA_TB"."SPENT_NUMBER_TO"', [$request->searchNumber]);
        }

        $results = $query->orderBy('BIRTH_QUOTA_TB.REQUEST_DATE', 'desc')->get();

        return response()->json($results);
    }
    public function approve(Request $request)
    {
        $userId = Auth::id();
        $user_code = User::where('id', $userId)->value('user_id_no');
        try {
            $id = $request->id;
            if (!$id) {
                return response()->json(['success' => false, 'message' => 'لم يتم إرسال معرف الطلب']);
            }

            // تحديث مباشر في Oracle بصيغة TO_DATE
            $updated = DB::table('BIRTH_QUOTA_TB')
                ->where('ID', $id)
                ->update([
                    'ORDER_STATUS' => 1,
                    'REQUEST_APPROVE_EMP' => $user_code ?? 1,
                    'APPROVE_DATE' => DB::raw("TO_DATE('" . now()->format('Y-m-d H:i:s') . "', 'YYYY-MM-DD HH24:MI:SS')")
                ]);

            if ($updated) {
                return response()->json(['success' => true, 'message' => 'تم اعتماد الطلب بنجاح']);
            } else {
                return response()->json(['success' => false, 'message' => 'لم يتم تعديل أي بيانات']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }



    public function cancel(Request $request)
    {
        try {
            $updated = DB::table('BIRTH_QUOTA_TB')
                ->where('ID', $request->id)
                ->update(['ORDER_STATUS' => 3]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'تم إلغاء الطلب']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'لم يتم تعديل أي بيانات']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    // دالة البحث - GET
    public function search_release(Request $request)
    {
        $query = Quota::query()
            ->join('C_DETAILS_REFERRAL_TB as H', 'H.DREF_CODE', '=', 'BIRTH_QUOTA_TB.HOS_NO')
            ->select(
                'BIRTH_QUOTA_TB.id',
                'H.DREF_NAME_AR as hos_name',
                'BIRTH_QUOTA_TB.CURRENT_NUMBER as current_number',
                'BIRTH_QUOTA_TB.LAST_NUMBER as last_number',
                'BIRTH_QUOTA_TB.REMAINING_DIGIT as remaining_digit'
            )
            ->where('BIRTH_QUOTA_TB.ORDER_STATUS', '01');

        // فلترة
        if ($request->filled('P_HOS_NO')) {
            $query->where('BIRTH_QUOTA_TB.HOS_NO', $request->P_HOS_NO);
        }
        if ($request->filled('P_DATE_FROM')) {
            $query->whereDate('BIRTH_QUOTA_TB.REQUEST_DATE', '>=', $request->P_DATE_FROM);
        }
        if ($request->filled('P_DATE_TO')) {
            $query->whereDate('BIRTH_QUOTA_TB.REQUEST_DATE', '<=', $request->P_DATE_TO);
        }

        $results = $query->orderBy('BIRTH_QUOTA_TB.REQUEST_DATE', 'desc')->get();

        // ✅ حساب release_from و release_to
        $quota_balance = DB::table('BIRTH_QUOTA_BALANCE_TB')->first();
        $spent_from = $quota_balance->current_number + 1;
        $spent_to   = $quota_balance->current_number + 5000;

        // نضيفهم لكل record
        $results->transform(function ($item) use ($spent_from, $spent_to) {
            $item->release_from = $spent_from;
            $item->release_to   = $spent_to;
            return $item;
        });

        return response()->json($results);
    }



    // دالة صرف الطلب - POST
    public function release(Request $request)
    {
        $userId = Auth::id();
        $user_code = User::where('id', $userId)->value('user_id_no');
        try {
            $id = $request->input('id');
            if (!$id) {
                return response()->json(['success' => false, 'message' => 'لم يتم إرسال معرف الطلب']);
            }

            $quota = DB::table('BIRTH_QUOTA_TB')->where('ID', $id)->first();
            if (!$quota) {
                return response()->json(['success' => false, 'message' => 'الطلب غير موجود']);
            }
            $quota_balance = DB::table('BIRTH_QUOTA_BALANCE_TB')->first();
            $spent_from = $quota_balance->current_number;
            $spent_to = $quota_balance->current_number + 5000;

            $updated = DB::table('BIRTH_QUOTA_TB')
                ->where('ID', $id)
                ->update([
                    'ORDER_STATUS' => 2,
                    'SPENT_NUMBER_FROM' => $spent_from,
                    'SPENT_NUMBER_TO' => $spent_to,
                    'CASHIER_EMP' => $user_code ?? 1,
                    'EXCHANGE_DATE' => DB::raw("TO_DATE('" . now()->format('Y-m-d H:i:s') . "', 'YYYY-MM-DD HH24:MI:SS')")
                ]);

            $updated_balance = DB::table('BIRTH_QUOTA_BALANCE_TB')
                ->update([
                    'CURRENT_NUMBER' => $spent_to + 1,
                    'PREV_NUMBER' => $spent_to,
                    'UPDATE_BY' => $user_code ?? 1,
                    'LAST_DATE_UPDATE' => DB::raw("TO_DATE('" . now()->format('Y-m-d H:i:s') . "', 'YYYY-MM-DD HH24:MI:SS')")
                ]);
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'تم صرف الطلب بنجاح']);
            } else {
                return response()->json(['success' => false, 'message' => 'لم يتم تعديل أي بيانات']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    // مثال دالة مساعدة لإرجاع اسم المستشفى
    private function getHospitalName($hosNo)
    {
        // هذه الدالة يجب أن تربط بجدول المستشفيات الحقيقي
        // هنا فقط مثال ثابت - غيّرها حسب بياناتك
        $hospitals = C_HOSPITAL_TB::where('h_code', $hosNo)->value('h_name_ar');

        return $hospitals ?? 'غير معروف';
    }
    //function to generate token
    public function generateToken(Request $request)
    {
        //print_r($request->all());exit;
        //return $request->headers->all();
        // return  $request->header('token');

        try {

            $validateUser = Validator::make(
                $request->all(),
                [
                    'userid' => 'required|numeric|digits:9'

                ]
            );

            if ($validateUser->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $TOKEN     =  $request->header('token');
            //print_r($TOKEN );exit;

            if ($TOKEN == 'N4#su#%P#SHO#CtZ*%%g$)QzM2E%CGVZ^*7p1&(hA*QQ$&G') {

                $id = $request->userid;
                //print_r($id );exit;

                $hash = Hash::make($request->userid);
                //print_r($hash );exit;

                $platform = 'WEB';

                $RESULT_OUT = null; // OUT parameter

                // Test the DB connection
                //$row =DB::connection('oracle')->select('select SYSDATE as cdate from dual');
                //print_r($row);exit;

                //$row =DB::connection('oracle')->select('select * from USERS_AUTHENTICATION');
                //print_r($row);exit;

                // Get the PDO connection for Oracle
                $pdo = DB::connection('oracle')->getPdo();
                $stmt = $pdo->prepare("begin AUTHENTICATION_USERS_PKG.INSERT_GENERSTE_ACCESS_TOKEN(:ID_IN,:TOKEN_IN,:PLATFORM_IN,:RESULT_OUT); end;");
                //$stmt->bindParam(':param_name', $variable, PDO::PARAM_TYPE);
                $stmt->bindParam(':ID_IN', $id, \PDO::PARAM_INT);
                $stmt->bindParam(':TOKEN_IN', $hash, \PDO::PARAM_STR);
                $stmt->bindParam(':PLATFORM_IN', $platform, \PDO::PARAM_STR);
                $stmt->bindParam(':RESULT_OUT', $RESULT_OUT, \PDO::PARAM_INT, 4000);

                $stmt->execute();

                //print_r($RESULT_OUT );exit;

                if ($RESULT_OUT == 1) {
                    $status = 200;
                    $message = 'Success';
                    $access_token = $hash;
                } else {
                    $status = 401;
                    $message = 'Fail,Something is wrong';
                    $access_token = '';
                }
            } else {
                $status = 401;
                $message = 'Fail,You must send a valid token';
                $access_token = '';
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
                'access_token' => $access_token
            ], $status);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    //check auth user
    public function auth_user()
    {
        //return request()->headers->all();
        //return request()->header('User-Agent');

        try {

            $User_ID   =  request()->header('userid');


            $TOKEN     =  request()->header('token');

            //print_r($TOKEN );exit;
            // print_r($User_ID );exit;

            $RESULT_OUT = null; // OUT parameter

            // Get the PDO connection for Oracle
            $pdo = DB::connection('oracle')->getPdo();
            $stmt = $pdo->prepare("begin AUTHENTICATION_USERS_PKG.CHECK_VALID_ACCESS_TOKEN(:ID_IN,:TOKEN_IN,:RESULT_OUT); end;");
            //$stmt->bindParam(':param_name', $variable, PDO::PARAM_TYPE);
            $stmt->bindParam(':ID_IN', $User_ID, \PDO::PARAM_INT);
            $stmt->bindParam(':TOKEN_IN', $TOKEN, \PDO::PARAM_STR);
            $stmt->bindParam(':RESULT_OUT', $RESULT_OUT, \PDO::PARAM_INT, 4000);

            $stmt->execute();

            //print_r($RESULT_OUT);exit;

            if ($RESULT_OUT == 1) {
                $status = 200;
                $message = 'Authorized';
            } else {
                $status = 401;
                $message = 'Unauthorized';
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $status);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function getQuota(Request $request)
    {

        try {

            $response = $this->auth_user(); // check user
            $dataArray = $response->getData(true); // Converts to an array
            // print_r($dataArray );exit;
            // print_r($dataArray['status'] );exit;

            if ($dataArray['status'] == 200) {

                //print_r($request->all());exit;
                $hos_no = $request->hos_no;

                $validateUser = Validator::make(
                    $request->all(),
                    [
                        'hos_no' => 'required|numeric'

                    ]
                );

                if ($validateUser->fails()) {

                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                }

                // Bind output cursor
                $QUOTA_OUT_CUR = null;

                // Get the PDO connection for Oracle
                $pdo = DB::connection('oracle')->getPdo();
                $stmt = $pdo->prepare("begin BORN_INFO_PKG.GET_BIRTH_QUOTA_DATA(:P_HOS_CODE,:QUOTA_OUT_CUR); end;");
                $stmt->bindParam(':P_HOS_CODE', $hos_no, \PDO::PARAM_INT);
                $stmt->bindParam(':QUOTA_OUT_CUR', $QUOTA_OUT_CUR, \PDO::PARAM_STMT);
                $stmt->execute();

                // Ambil data dari cursor
                oci_execute($QUOTA_OUT_CUR);

                $data = [];
                while ($row = oci_fetch_assoc($QUOTA_OUT_CUR)) {
                    $data[] = $row;
                }

                // Tutup cursor
                oci_free_statement($QUOTA_OUT_CUR);

                //print_r( $data); exit;

                $status = 200;
                $message = 'Success';
                $data =  $data;
            } else {
                $status = 401;
                $message = 'Unauthorized';
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function quota_export_excel(Request $request)
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $request->merge(["start" => null]);
        $request->merge(["limit" => null]);
        $data_res = Quota::query()
            ->join('C_DETAILS_REFERRAL_TB as H', 'H.DREF_CODE', '=', 'BIRTH_QUOTA_TB.HOS_NO')
            ->select(
                'BIRTH_QUOTA_TB.id',
                'H.DREF_NAME_AR as hos_name',
                'BIRTH_QUOTA_TB.CURRENT_NUMBER as current_number',
                'BIRTH_QUOTA_TB.LAST_NUMBER as last_number',
                'BIRTH_QUOTA_TB.REMAINING_DIGIT as remaining_digit',
                'BIRTH_QUOTA_TB.ORDER_STATUS as order_status',
                'BIRTH_QUOTA_TB.SPENT_NUMBER_FROM as release_from',
                'BIRTH_QUOTA_TB.SPENT_NUMBER_TO as release_to'
            );

        // فلترة بالمستشفى
        if ($request->filled('P_HOS_NO')) {
            $data_res->where('BIRTH_QUOTA_TB.HOS_NO', $request->P_HOS_NO);
        }
        // فلترة بحالة الطلب
        if ($request->filled('P_STATUS_NO')) {
            $data_res->where('BIRTH_QUOTA_TB.ORDER_STATUS', $request->P_STATUS_NO);
        }


        // فلترة بتاريخ الطلب من
        if ($request->filled('P_DATE_FROM')) {
            $data_res->whereRaw("TRUNC(BIRTH_QUOTA_TB.REQUEST_DATE) >= TO_DATE(?, 'DD/MM/YYYY')", [$request->P_DATE_FROM]);
        }

        // فلترة بتاريخ الطلب إلى
        if ($request->filled('P_DATE_TO')) {
            $data_res->whereRaw("TRUNC(BIRTH_QUOTA_TB.REQUEST_DATE) <= TO_DATE(?, 'DD/MM/YYYY')", [$request->P_DATE_TO]);
        }

        // 🔍 تصفية بالرقم بين release_from و release_to
        if ($request->filled('searchNumber')) {
            $data_res->whereRaw('? BETWEEN "BIRTH_QUOTA_TB"."SPENT_NUMBER_FROM" AND "BIRTH_QUOTA_TB"."SPENT_NUMBER_TO"', [$request->searchNumber]);
        }
        $results = $data_res->orderBy('BIRTH_QUOTA_TB.REQUEST_DATE', 'desc')->get();
       // dd($results);
        //  dd($data_res);
        $data1['user_id'] = Auth()->id();
        $data1['ip'] = request()->ip();
        $data1['id_no'] = Auth()->id();
        $data1['table_name'] = 'BORNS_INFO_TB';
        $data1['column_name'] = ' ';
        $data['old_record'] = $request->all();
        $data1['type_action'] = 'DL';
        Log::create($data1);
        $result = Excel::download(new QuotaExport($results), 'quota_excel.xlsx');
        ob_end_clean();
        return $result;
    }
}
