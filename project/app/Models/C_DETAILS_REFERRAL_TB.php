<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_DETAILS_REFERRAL_TB extends Model
{
    use HasFactory;
    protected $table  = 'C_DETAILS_REFERRAL_TB';

    public function Parent()
    {
        return $this->belongsTo(C_DETAILS_REFERRAL_TB::class,'DREF_CODE');
    }
}
