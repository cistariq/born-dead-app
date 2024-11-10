<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePageUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function RolePages()
    {
        return $this->hasOne(RolePage::class,'id','role_pages_id');
    }
}
