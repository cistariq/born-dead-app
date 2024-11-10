<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_JOB_TB extends Model
{
    use HasFactory;
    protected $table  = 'C_JOB_TB';

    public function Parent()
    {
        return $this->belongsTo(C_JOB_TB::class,'JOB_CODE');
    }
}
