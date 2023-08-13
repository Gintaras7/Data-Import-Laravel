<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'model', 'exposure', 'description', 'createdAt', 'updatedAt', 'lastMeasurementAt'
    ];

    protected $dates = ['createdAt', 'updatedAt', 'lastMeasurementAt'];

    // Relationships
    public function sensors()
    {
        return $this->hasMany(Sensor::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
