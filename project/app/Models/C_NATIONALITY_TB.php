<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_NATIONALITY_TB extends Model
{
    use HasFactory;
    protected $table  = 'C_NATIONALITY_TB';

    public function Parent()
    {
        return $this->belongsTo(C_NATIONALITY_TB::class,'NAT_CODE');
    }
}
