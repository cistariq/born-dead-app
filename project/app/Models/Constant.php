<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constant extends Model
{
    use HasFactory;
    public function Parent()
    {
        return $this->belongsTo(Constant::class,'parent_id');
    }
}
