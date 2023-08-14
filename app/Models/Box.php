<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Box extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'model',
        'exposure',
        'description',
        'createdAt',
        'updatedAt',
        'lastMeasurementAt'
    ];

    protected $dates = ['createdAt', 'updatedAt', 'lastMeasurementAt'];

    // Relationships
    public function sensors(): HasMany
    {
        return $this->hasMany(Sensor::class);
    }

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }
}
