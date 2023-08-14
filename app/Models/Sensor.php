<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sensor extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'unit',
        'sensorType',
        'lastMeasurement'
    ];

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }
}
