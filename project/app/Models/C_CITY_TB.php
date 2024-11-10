<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_CITY_TB extends Model
{
    use HasFactory;
    protected $table  = 'C_CITY_TB';

    public function Parent()
    {
        return $this->belongsTo(C_CITY_TB::class,'C_CODE');
    }
}
