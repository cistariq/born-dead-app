<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleBtnUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function RolePages()
    {
        return $this->hasOne(RoleBtn::class,'id','role_btns_id');
    }
}
