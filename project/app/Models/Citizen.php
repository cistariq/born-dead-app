<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['nationality_name','social_status_name','religion_name','region_name','city_name'
            ,'social_status_display','birth_of_date'];
    protected $casts = [
        'DOB' => 'date',
    ];
    public function setDateAttribute( $value ) {
        $this->attributes['date'] = (new Carbon($value))->format('d/m/y');
      }
    public function nationality()
    {
        return $this->belongsTo(Constant::class,'nationality_id');
    }
    public function social_status()
    {
        return $this->belongsTo(Constant::class,'social_status_id');
    }
    public function religion()
    {
        return $this->belongsTo(Constant::class,'religion_id');
    }
    public function region()
    {
        return $this->belongsTo(Constant::class,'region_id');
    }
    public function city()
    {
        return $this->belongsTo(Constant::class,'city_id');
    }
    public function getNationalityNameAttribute()
    {
        return $this->nationality->name ?? '';
    }
    public function getRegionNameAttribute()
    {
        return $this->region->name ?? '';
    }
    public function getReligionNameAttribute()
    {
        return $this->religion->name ?? '';
    }
    public function getCityNameAttribute()
    {
        return $this->city->name ?? '';
    }
    public function getSocialStatusDisplayAttribute()
    {
        return $this->social_status->display_col ?? '';
    }
    public function getBirthOfDateAttribute()
    {
        return $this->DOB->format('Y/m/d') ?? '';
    }
    public function Attachment()
    {
        return $this->hasOne(Attachment::class, 'id_no', 'id_no');
    }
}
