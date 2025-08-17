<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    ];
       // تحويل التاريخ إلى كائن Carbon تلقائياً
    protected $casts = [
        'approve_date' => 'datetime',
    ];

    // جلب رقم جديد من Sequence
    public static function nextId()
    {
        $row = DB::select("SELECT BRTH_QUOTA_SEQ.NEXTVAL as id FROM dual");
        return $row[0]->id;
    }
}
