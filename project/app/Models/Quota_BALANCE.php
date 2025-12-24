<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quota_BALANCE extends Model
{
    protected $table = 'BIRTH_QUOTA_BALANCE_TB';
    protected $primaryKey = 'ID';
    public $incrementing = false; // سنستخدم Sequence
    public $timestamps = false;

    // الحقول المسموح تعبئتها الآن
    protected $fillable = [
        'ID',
        'CURRENT_NUMBER',
        'PREV_NUMBER',
        'LAST_DATE_UPDATE',
        'UPDATE_BY',
        'STATUS',

    ];
       // تحويل التاريخ إلى كائن Carbon تلقائياً
    protected $casts = [
        'last_date_update' => 'datetime',
    ];

}
