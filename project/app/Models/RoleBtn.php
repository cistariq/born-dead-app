<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleBtn extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function FollowToPage()
    {
        return $this->hasOne(RolePage::class,'id', 'follow_to_page');
    }
    public function RoleBtnUserLogin()
    {
        return $this->hasMany(RoleBtnUser::class,'role_btns_id')->where('user_id',Auth()->id());
    }
}
