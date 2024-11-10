<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function martyr() {
        return $this->hasMany(Martyr::class, 'id_no', 'id_no');
    }
    public function citizen() {
        return $this->hasMany(citizen::class, 'id_no', 'id_no');
    }

    public function printLogs() {
        return $this->hasMany(PrintLog::class, 'id_no', 'id_no');
    }
    public function getPrintCountAttribute()
    {
        return $this->printLogs()->count();
    }
}
