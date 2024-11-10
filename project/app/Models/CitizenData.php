<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizenData extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $connection = 'oracle';
    protected $table = 'CITIZEN_DATA';

    public function dead()
    {
        return $this->hasOne(DEADS_TB::class, 'DEAD_ID', 'id');
    }
}

