<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelRecord extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_name',
        'start_time',
        'end_time',
        'start_location',
        'end_location',
        'distance',
        'notes',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
