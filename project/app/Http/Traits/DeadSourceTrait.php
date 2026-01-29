<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Models\DEADS_TB;
use App\Models\Log;

trait DeadSourceTrait
{

    public function updateDeadSourceByIdNo(Request $request)
    {
        /* ================= Validation ================= */
        $rules = [
            'P_ID_NO'       => 'required|numeric|digits:9',
            'P_SOURCE'      => 'required|numeric',
            'UPDATE_REASON' => 'required|string|min:3',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->all()
            ], 422);
        }

        try {

            // 🔹 البحث برقم الهوية
            $dead = DEADS_TB::where('DEAD_ID', $request->P_ID_NO)->first();
            //print_r($dead);exit;

            if (!$dead) {
                return response()->json([
                    'success' => false,
                    'errors' => 'لا يوجد سجل مطابق لرقم الهوية'
                ], 404);
            }

            // 🔹 حفظ المصدر القديم للتتبع
            $oldSource = $dead->source;
            //print_r($dead->source);exit;
            if($request->P_SOURCE==4){
                $source =3;
            } elseif($request->P_SOURCE==3){
                $source =2;
            } elseif($request->P_SOURCE==2){
                $source =1;
            } else {
                $source = 0;
            }
            // 🔹 التحديث
            $updated = DEADS_TB::where('DEAD_ID', $request->P_ID_NO)->update([
                'SOURCE'         => $source,
                'UPDATE_REASON' => $request->UPDATE_REASON,
                'UPDATED_ON'    => now(),
            ]);

            if ($updated === 0) {
                return response()->json([
                    'success' => false,
                    'errors'  => 'لم يتم العثور على سجل لتحديثه أو لم يتغير شيء'
                ], 404);
            }

            // 🔹 Log
            Log::create([
                'user_id'     => null, // null لو API خارجي
                'ip'          => request()->ip(),
                'id_no'       => $request->P_ID_NO,
                'table_name'  => 'DEADS_TB',
                'column_name' => $request->UPDATE_REASON,
                'old_value'   => $oldSource,
                'new_value'   => $source,
                'type_action' => 'U',
            ]);

        } catch (\Exception $exception) {

            return response()->json([
                'success' => false,
                'errors'  => $exception->getMessage()
            ], 500);
        }

        return response()->json([
            'success' => true,
            'results' => 'تم تعديل نوع الوفاة لهذه الحالة  بنجاح'
        ]);
    }
}
