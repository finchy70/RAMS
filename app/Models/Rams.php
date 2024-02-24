<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rams extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(Method::class);
    }

    public function setup(): BelongsTo
    {
        return $this->belongsTo(SetUp::class);
    }

    public function prelim(): BelongsTo
    {
        return $this->belongsTo(Prelim::class);
    }


}
