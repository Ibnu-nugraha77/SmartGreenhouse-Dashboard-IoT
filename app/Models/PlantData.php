<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantData extends Model
{
    protected $table = 'plant_data';

    protected $fillable = [
        'soil_moisture',
        'pump_status',
    ];
}

