<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Method extends Model
{
    use HasFactory;

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function methodCategory(): BelongsTo
    {
        return $this->belongsTo(MethodCategory::class);
    }
}
