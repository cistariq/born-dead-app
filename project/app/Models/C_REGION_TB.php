<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_REGION_TB extends Model
{
    use HasFactory;
    protected $table  = 'C_REGION_TB';

    public function Parent()
    {
        return $this->belongsTo(C_REGION_TB::class,'R_CODE');
    }
}
