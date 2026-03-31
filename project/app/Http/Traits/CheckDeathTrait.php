<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DEADS_TB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\C_MARTIAL_STATUS_TB;


trait DeathDataTrait
{
    public function check_record_death(Request $request)
    {
        $role = [
            'P_ID_NO' => 'required|numeric|digits:9',
        ];
        // dd($request->P_ID_NO);
        $data = $request->validate($role);
        $token = $this->getTokenCommitment_D($request);
        try {
            $response = Http::timeout(10)->withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,

            ])->post('https://gapi.ctznps.com/api/Moh/GetCtznDead', [
                'IdNumber' => $data['P_ID_NO'],
            ]);
            $data = $response->json();

            if ($data['Data'][0]['GenderCD'] != null) {

                $gender_data = DB::table('C_SEX_TB')->where('SEX_MOI_CODE', $data['Data'][0]['GenderCD'])->first();
                if ($gender_data != null) {

                    $data['Data'][0]['sex_cd'] = $gender_data->sex_code;
                }
            }
            if ($data['Data'][0]['PersonalCD'] != null) {

                $personal_data = DB::table('C_MARTIAL_STATUS_TB')->where('MS_MOI_CODE', $data['Data'][0]['PersonalCD'])->first();
                if ($personal_data != null) {

                    $data['Data'][0]['personal_cd'] = $personal_data->ms_code;
                }
            }
            if ($data['Data'][0]['RegionCD'] != null) {

                $region_data = DB::table('C_REGION_TB')->where('R_MOI_CODE', $data['Data'][0]['RegionCD'])->first();
                if ($region_data != null) {

                    $data['Data'][0]['REGION_CD'] = $region_data->r_code;
                }
            }

            if ($data['Data'][0]['BIRTH_CITY_CD'] != null) {

                $city_data = DB::table('C_CITY_TB')->where('C_CITY_MOI_CD', $data['Data'][0]['BIRTH_CITY_CD'])->first();

                if ($city_data != null) {

                    $data['Data'][0]['CITY_CD'] = $city_data->c_code;
                }
            }



            return $data;
        } catch (\Exception $exception) {
            return [];
        }
    }

    public function getTokenCommitment_D(Request $request)
    {
        $response = Http::asForm()->post('https://gapi.ctznps.com/api/Security/Login', [
            'UserName' => '882222277',
            'Password' => 'Fd56*MVZ#403'
        ]);
        if (isset($response->json()['Data']['Token'])) {
            return $response->json()['Data']['Token'];
        } else {
            return '1';
        }
    }

    public function check_citizen_by_id(Request $request)
    {
        print_r('here');exit;
        // dd($request->all());
        $rules = [
            'P_CITIZEN_ID' => 'required|numeric|digits:9',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(' - ', $validator->errors()->all()),
            ], 422);
        }

       // $idNo = $request->P_CITIZEN_ID;
        $idNo = $request->input('P_CITIZEN_ID');

        /************ فحص صحة رقم الهوية ************/
        $check_id = DEADS_TB::CHECK_ID($idNo);

        if ($check_id != 1) {
            return response()->json([
                'success' => false,
                'message' => 'رقم الهوية غير صحيح',
            ], 404);
        }

        /************ البحث في جدول الوفيات ************/
        $deathData = DEADS_TB::GET_DEAD_INFO_BY_ID($idNo);
        if (!empty($deathData)) {
            $deathData[0]['BIRTH_PLACE'] = $deathData[0]['DEAD_D_BIRTH_PLACE'] ?? '';
            $code = $deathData[0]['DEAD_MARTIAL_STATUS_CD'] ?? null; // مثال على رقم الحالة الزوجية
            $status = C_MARTIAL_STATUS_TB::where('MS_CODE', $code)->first();
            $deathData[0]['MARITAL_STATUS'] = $status ? $status->ms_name_ar : '';

            $deadDate = Carbon::parse($deathData[0]['DEAD_DOD'])->format('Y-m-d');
            $deathData[0]['DEAD_DOB'] = Carbon::parse($deathData[0]['DEAD_DOB'])->format('Y-m-d');
        }

        if (!empty($deathData)) {
            return response()->json([
                'success' => true,
                'status'  => 'dead',
                'message' => 'متوفي بتاريخ ' . $deadDate,
                'data'    => $deathData,
            ], 200);
        }

        /************ البحث في جدول المواطنين ************/
        $citizenData = DEADS_TB::GET_DEAD_CITZN_BY_ID($idNo);

        if (!empty($citizenData)) {
            $fakeRequest = new Request([
                'P_ID_NO' => $idNo
            ]);
            /************ فحص سجلات الوفاة من المستشفيات ************/
            $check = $this->check_record_death($fakeRequest);
            $resultOut = $check['data']['data']['RESULT_OUT'] ?? null;
            $hos_name  = $check['data']['data']['RESULT_DEATH_HOS'] ?? null;
            switch ($resultOut) {
                case 0:
                    // ✔ على قيد الحياة
                    $status  = 'alive';
                    $message = 'على قيد الحياة';
                    break;

                case 1:
                    // ✔ متوفي داخل المستشفى ولم يُستكمل الإشعار
                    $status  = 'pending_death';
                    $message = "المريض متوفي داخل المستشفى ($hos_name) ولم يتم استكمال اجراءات تسجيل اشعار الوفاة";
                    break;

                default:
                    $status  = 'unknown';
                    $message = 'حالة غير محددة للبيانات';
            }

            return response()->json([
                'success' => true,
                'status'  => $status,
                'message' => $message,
                'data'    => $citizenData,
            ], 200);
        }

        /************ في حال لم يوجد في أي جدول ************/
        return response()->json([
            'success' => false,
            'message' => 'لا توجد بيانات لهذا الرقم',
        ], 404);
    }
}
