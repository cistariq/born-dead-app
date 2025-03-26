<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICDCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'title', 'parent_id'];

    public function children()
    {
        return $this->hasMany(ICDCode::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ICDCode::class, 'parent_id');
    }
}
?>
