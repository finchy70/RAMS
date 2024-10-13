<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;

    protected $fillable = ['control_type_id', 'control'];

    public function risks()
    {
        return $this->belongsToMany(Risk::class);
    }

    public function type_asc()
    {
        return $this->belongsTo(ControlType::class, 'control_type_id')->orderBy('type');
    }

    public function type_desc()
    {
        return $this->belongsTo(ControlType::class, 'control_type_id')->orderBy('type', 'desc');
    }
}
