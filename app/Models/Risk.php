<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Risk extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function methods(): BelongsToMany
    {
        return $this->belongsToMany(Method::class);
    }

    public function controls(): BelongsToMany
    {
        return $this->belongsToMany(Control::class);
    }

    public function pre_control_rating(): string
    {
        return $this->rating($this->pre_probability * $this->pre_severity);
    }

    public function post_control_rating(): string
    {
        return $this->rating($this->post_probability * $this->post_severity);
    }

    public function rating($rating): string
    {
        if ($rating > 5 && $rating < 15) {
            return "bg-yellow-500";
        } elseif ($rating > 14) {
            return "bg-red-500";
        } else {
            return "bg-green-500";
        }
    }
}
