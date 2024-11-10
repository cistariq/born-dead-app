<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C_DEATH_CAUSE_TB extends Model
{
    use HasFactory;
    protected $table  = 'C_DEATH_CAUSE_TB';

    public function Parent()
    {
        return $this->belongsTo(C_DEATH_CAUSE_TB::class,'DEATH_CAUSE_CODE');
    }
}
