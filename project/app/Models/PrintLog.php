<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function citizen()
    {
        return $this->hasOne(Citizen::class, 'id_no', 'id_no');
    }
    public function martyr()
    {
        return $this->hasOne(Martyr::class, 'id_no', 'id_no');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function recipient_user()
    {
        return $this->hasOne(User::class, 'id', 'recipient_user_id');
    }
}
