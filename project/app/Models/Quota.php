<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use PDO;

class Quota extends Model
{
    protected $table = 'BIRTH_QUOTA_TB';
    protected $primaryKey = 'ID';
    public $incrementing = false; // سنستخدم Sequence
    public $timestamps = false;

    // الحقول المسموح تعبئتها الآن
    protected $fillable = [
        'ID',
        'CURRENT_NUMBER',
        'LAST_NUMBER',
        'REMAINING_DIGIT',
        'ORDER_STATUS',
        'HOS_NO',
        'REQUEST_EMP',
        'REQUEST_DATE',
        'APPROVE_DATE',          // أضف هذا
        'REQUEST_APPROVE_EMP',   // وأيضاً هذا
        'SPENT_NUMBER_FROM',
        'SPENT_NUMBER_TO',
        'CASHIER_EMP',
        'EXCHANGE_DATE',

    ];
    // تحويل التاريخ إلى كائن Carbon تلقائياً
    protected $casts = [
        'approve_date' => 'datetime',
        'exchange_date' => 'datetime',
        'request_date' => 'datetime',
    ];

    // جلب رقم جديد من Sequence
    public static function nextId()
    {
        $row = DB::select("SELECT BRTH_QUOTA_SEQ.NEXTVAL as id FROM dual");
        return $row[0]->id;
    }

    public static function birthStatistics($data)
    {
        $sql = 'BEGIN
        BIRTH_DASHBOARD_PKG.BIRTH_COUNT_PRC(
            :P_DATE_FROM,
            :P_DATE_TO,
            :P_BIRTH_PLACE,
            :P_HOS_NO,
            :P_TOTAL_COUNT,
            :P_GENDER_COUNT,
            :P_OUTCOME_COUNT,
            :P_LIVE_DETAILS_COUNT,
            :P_DEAD_DETAILS_COUNT,
            :P_DELIVERY_TYPE_COUNT,
            :P_DELIVERY_STATUS_COUNT,
            :P_PLACE_CENTER_COUNT,
            :P_HOSPITAL_COUNT
        );
    END;';

        return DB::transaction(function ($conn) use ($sql, $data) {
            $P_GENDER_COUNT = [];
            $P_OUTCOME_COUNT = [];
            $P_LIVE_DETAILS_COUNT = [];
            $P_DEAD_DETAILS_COUNT = [];
            $P_DELIVERY_TYPE_COUNT = [];
            $P_DELIVERY_STATUS_COUNT = [];
            $P_PLACE_CENTER_COUNT = [];
            $P_HOSPITAL_COUNT = [];

            $pdo  = $conn->getPdo();
            $stmt = $pdo->prepare($sql);

            // IN parameters
            $stmt->bindParam(':P_DATE_FROM', $data['dateFrom']);
            $stmt->bindParam(':P_DATE_TO', $data['dateTo']);
            $stmt->bindParam(':P_BIRTH_PLACE', $data['birthPlaceNo']);
            $stmt->bindParam(':P_HOS_NO', $data['hosNo']);
            // OUT NUMBER
            $totalCount = 0;
            $stmt->bindParam(
                ':P_TOTAL_COUNT',
                $totalCount,
                PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT,
                32
            );
            $stmt->bindParam(':P_GENDER_COUNT', $P_GENDER_COUNT, PDO::PARAM_STMT);
            $stmt->bindParam(':P_OUTCOME_COUNT', $P_OUTCOME_COUNT, PDO::PARAM_STMT);
            $stmt->bindParam(':P_LIVE_DETAILS_COUNT', $P_LIVE_DETAILS_COUNT, PDO::PARAM_STMT);
            $stmt->bindParam(':P_DEAD_DETAILS_COUNT', $P_DEAD_DETAILS_COUNT, PDO::PARAM_STMT);
            $stmt->bindParam(':P_DELIVERY_TYPE_COUNT', $P_DELIVERY_TYPE_COUNT, PDO::PARAM_STMT);
            $stmt->bindParam(':P_DELIVERY_STATUS_COUNT', $P_DELIVERY_STATUS_COUNT, PDO::PARAM_STMT);
            $stmt->bindParam(':P_PLACE_CENTER_COUNT', $P_PLACE_CENTER_COUNT, PDO::PARAM_STMT);
            $stmt->bindParam(':P_HOSPITAL_COUNT', $P_HOSPITAL_COUNT, PDO::PARAM_STMT);


            $stmt->execute();
            oci_execute($P_GENDER_COUNT);
            oci_execute($P_OUTCOME_COUNT);
            oci_execute($P_LIVE_DETAILS_COUNT);
            oci_execute($P_DEAD_DETAILS_COUNT);
            oci_execute($P_DELIVERY_TYPE_COUNT);
            oci_execute($P_DELIVERY_STATUS_COUNT);
            oci_execute($P_PLACE_CENTER_COUNT);
            oci_execute($P_HOSPITAL_COUNT);
            $genderData = [];
            while ($row = oci_fetch_assoc($P_GENDER_COUNT)) {
                $genderData[] = $row;
            }

            $outcomeData = [];
            while ($row = oci_fetch_assoc($P_OUTCOME_COUNT)) {
                $outcomeData[] = $row;
            }

            $liveData = [];
            while ($row = oci_fetch_assoc($P_LIVE_DETAILS_COUNT)) {
                $liveData[] = $row;
            }

            $deadData = [];
            while ($row = oci_fetch_assoc($P_DEAD_DETAILS_COUNT)) {
                $deadData[] = $row;
            }

            $deliveryTypeData = [];
            while ($row = oci_fetch_assoc($P_DELIVERY_TYPE_COUNT)) {
                $deliveryTypeData[] = $row;
            }

            $deliveryStatusData = [];
            while ($row = oci_fetch_assoc($P_DELIVERY_STATUS_COUNT)) {
                $deliveryStatusData[] = $row;
            }

            $placeCenterData = [];
            while ($row = oci_fetch_assoc($P_PLACE_CENTER_COUNT)) {
                $placeCenterData[] = $row;
            }

            $hospitalData = [];
            while ($row = oci_fetch_assoc($P_HOSPITAL_COUNT)) {
                $hospitalData[] = $row;
            }

            return [
                'TOTAL_COUNT' => $totalCount,
                'gender' => $genderData,
                'outcome' => $outcomeData,
                'live_details' => $liveData,
                'dead_details' => $deadData,
                'delivery_type' => $deliveryTypeData,
                'delivery_status' => $deliveryStatusData,
                'place_center' => $placeCenterData,
                'hospital' => $hospitalData,
            ];
        });
    }
}
