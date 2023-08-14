<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    protected $fillable = [
        'type',
        'latitude',
        'longitude',
        'timestamp',
        'box_id'
    ];

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }
}
