<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;

trait BirthApiTrait
{
    /**
     * جلب كوتة أرقام المواليد من API
     */
    public function check_record_quata(Request $request)
    {
        // التحقق من البيانات
        $data = $request->validate([
            'hos_no' => 'required|numeric',
        ]);

        // الحصول على التوكن
        $token = $this->getTokenCommitment($request);
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
                ->post('https://center-hos-api.sehatty.ps/index.php/birth_api/getBirthNumberQuota', [
                    'hos_no' => 1//$data['hos_no']
                ]);

            if ($response->successful()) {
                $quotaData = $response->json();
                return response()->json([
                    'status' => 200,
                    'data' => $quotaData
                ]);
            } else {
                Log::error('Birth API getBirthNumberQuota failed: '.$response->body());
                return response()->json([
                    'status' => 500,
                    'message' => 'فشل جلب الكوتة من API'
                ], 500);
            }

        } catch (\Exception $exception) {
            Log::error('Birth API exception: '.$exception->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'خطأ في الاتصال بالـ API'
            ], 500);
        }
    }

    /**
     * جلب التوكن من API
     */
    public function getTokenCommitment(Request $request)
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
                ->post('https://center-hos-api.sehatty.ps/index.php/birth_api/generateToken', [
                    'ID' => $user_id
                ]);

            if ($response->successful() && isset($response->json()['access_token'])) {
                return $response->json()['access_token'];

            } else {
                Log::error('Birth API generateToken failed: '.$response->body());
                return null;
            }

        } catch (\Exception $exception) {
            Log::error('Birth API generateToken exception: '.$exception->getMessage());
            return null;
        }
    }
}
