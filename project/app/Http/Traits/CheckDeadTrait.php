<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;


trait CheckDeadTrait
{
    public function check_dead_records(Request $request)
    {
  // التحقق من البيانات
        $data = $request->validate([
            'P_ID' => 'required|numeric',
        ]);

        // الحصول على التوكن
        $token = $this->getTokenCommitment_deads($request);
        if ($token === null) {
            return response()->json([
                'status' => 500,
                'message' => 'فشل الحصول على التوكن'
            ], 500);
        }

        // رقم هوية المستخدم
        $user = User::find(auth()->id());
        $user_id = $user->user_id_no ?? null;
        if (!$user_id) {
            return response()->json([
                'status' => 400,
                'message' => 'لم يتم العثور على رقم هوية المستخدم'
            ], 400);
        }

        try {
            $response = Http::timeout(30)
                ->asForm()
                ->withHeaders([
                    'Accept' => 'application/json',
                    'X-Authorization' => $token,
                    'X-UserID' => $user_id,
                ])
                ->post('https://center-hos-api.sehatty.ps/index.php/Newcs_patients_api/getPatientDataByNationalID', [
                    'patient_national_id' => $data['P_ID']
                ]);

            if ($response->successful()) {
                $quotaData = $response->json();
                return response()->json([
                    'status' => 200,
                    'data' => $quotaData
                ]);
            } else {
                Log::error('Check dead API getPatientDataByNationalID failed: '.$response->body());
                return response()->json([
                    'status' => 500,
                    'message' => 'فشل جلب الكوتة من API'
                ], 500);
            }

        } catch (\Exception $exception) {
            Log::error('Check dead API exception: '.$exception->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'خطأ في الاتصال بالـ API'
            ], 500);
        }
    }

    public function getTokenCommitment_deads(Request $request)
    {
        $user = User::find(auth()->id());
        $user_id = $user->user_id_no ?? null;
       // dd($user_id); // Debugging line to check user_id
        if (!$user_id) {
            return null;
        }

        try {
            $response = Http::timeout(30)
                ->asForm()
                ->withHeaders([
                    'X-Fixed-Token' => 'N4#su#%P#SHO#CtZ*%%g$)QzM2E%CGVZ^*7p1&(hA*QQ$&G'
                ])
                ->post('https://center-hos-api.sehatty.ps/index.php/Newcs_patients_api/generateToken', [
                    'ID' => $user_id
                ]);

            if ($response->successful() && isset($response->json()['access_token'])) {
                return $response->json()['access_token'];

            } else {
                Log::error('Check dead API generateToken failed: '.$response->body());
                return null;
            }

        } catch (\Exception $exception) {
            Log::error('Check dead API generateToken exception: '.$exception->getMessage());
            return null;
        }
    }
}
