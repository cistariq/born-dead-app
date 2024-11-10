<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_RELEGION_TB extends Model
{
    use HasFactory;
    protected $table  = 'C_RELEGION_TB';

    public function Parent()
    {
        return $this->belongsTo(C_RELEGION_TB::class,'RE_CODE');
    }
}
