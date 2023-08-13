<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function box()
    {
        return $this->belongsTo(Box::class);
    }
}
