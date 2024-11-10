<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;

class Martyr extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['hospital_name','martyrdom_date','martyrdom_time','print_count','cause_death_display'
            ,'application_name','application_id_no','application_mobile'];

    protected static function booted()
    {
        static::updating(function($martyr) {
            $data['user_id'] = Auth()->id();
            $data['ip'] = request()->ip();
            $data['id_no'] = $martyr->id_no;
            $data['table_name'] = 'martyrs';
            $data['old_record'] = $martyr;
            $data['type_action'] = 'U';
            if ($martyr->hospital_id != $martyr->getOriginal('hospital_id')) {
                $data['column_name'] = 'hospital_id';
                $data['old_value'] =$martyr->getOriginal('hospital_id');
                $data['new_value'] = $martyr->hospital_id;
                Log::create($data);
            }
            if ($martyr->cause_death_id != $martyr->getOriginal('cause_death_id')) {
                $data['column_name'] = 'cause_death_id';
                $data['old_value'] =$martyr->getOriginal('cause_death_id');
                $data['new_value'] = $martyr->cause_death_id;
                Log::create($data);
            }
            if ($martyr->Date_martyrdom != $martyr->getOriginal('Date_martyrdom')) {
                $data['column_name'] = 'Date_martyrdom';
                $data['old_value'] =$martyr->getOriginal('Date_martyrdom');
                $data['new_value'] = $martyr->Date_martyrdom;
                Log::create($data);
            }

        });
    }

    public function citizen()
    {
        return $this->hasOne(Citizen::class, 'id_no', 'id_no');
    }
    public function hospital()
    {
        return $this->belongsTo(Constant::class,'hospital_id');
    }
    public function application()
    {
        return $this->belongsTo(Application::class,'id_no','id_no');
    }
    public function getApplicationNameAttribute()
    {
        return $this->application->application_name ?? '';
    }
    public function getApplicationIdNoAttribute()
    {
        return $this->application->application_id_no ?? '';
    }
    public function getApplicationMobileAttribute()
    {
        return $this->application ? '0'.$this->application->mobile : '...................';
    }
    public function cause_death_rela()
    {
        return $this->belongsTo(Constant::class,'cause_death_id');
    }
    public function getHospitalNameAttribute()
    {
        return $this->hospital->name ?? '';
    }
    public function getMartyrdomDateAttribute()
    {
        try {
            return Carbon::createFromFormat('d/m/Y H:i', $this->Date_martyrdom)->format('Y/m/d');
        } catch (\Throwable $th) {
            return false;
        }

        //return $this->Date_martyrdom->format('Y/m/d') ?? '';
    }
    public function getMartyrdomTimeAttribute()
    {
        try {
            return Carbon::createFromFormat('d/m/Y H:i', $this->Date_martyrdom)->format('H:i');
        } catch (\Throwable $th) {
            return false;
        }
        //return $this->Date_martyrdom->format('H:i') ?? '';
    }
    public function printLogs() {
        return $this->hasMany(PrintLog::class, 'id_no', 'id_no');
    }
    public function getPrintCountAttribute()
    {
        return $this->printLogs()->count();
    }
    public function getCauseDeathDisplayAttribute()
    {
        return $this->cause_death_rela->display_col ?? '';
    }
}
