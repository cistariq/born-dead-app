<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function follow_to()
    {
        return $this->hasOne(RolePage::class,'id', 'follow_to_id');
    }
    public function RolePageUserLogin()
    {
        return $this->hasMany(RolePageUser::class,'role_pages_id')->where('user_id',Auth()->id());
    }
    public function getFollowNameAttribute()
    {
        return $this->follow_to->name ?? '';
    }
}
