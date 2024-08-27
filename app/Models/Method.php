<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Method extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function methodCategory(): BelongsTo
    {
        return $this->belongsTo(MethodCategory::class);
    }

    public function risks()
    {
        return $this->belongsToMany(Risk::class);
    }

    public function category_asc()
    {
        return $this->belongsTo(MethodCategory::class, 'method_category_id')->orderBy('category');
    }

    public function category_desc()
    {
        return $this->belongsTo(MethodCategory::class, 'method_category_id')->orderBy('category', 'desc');
    }

    public function rams()
    {
        return $this->hasMany(Rams::class);

    }
}
