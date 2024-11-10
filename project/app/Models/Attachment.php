<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function citizen()
{
    return $this->hasOne(Citizen::class, 'id_no', 'id_no');
}

public function martyrs()
{
    return $this->hasOne(Martyr::class, 'id_no', 'id_no');
}

}
