<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_ICD_CODE_TB extends Model
{
    use HasFactory;
    protected $table  = 'C_ICD_CODE_TB';

    public function Parent()
    {
        return $this->belongsTo(C_ICD_CODE_TB::class,'ICD_CODE');
    }
}
