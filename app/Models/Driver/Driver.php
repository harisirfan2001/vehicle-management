<?php

namespace App\Models\Driver;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleFuel\Fuel;

class Driver extends Model
{
    use HasFactory;

    public function driver(){
        return $this->hasMany(Fuel::class, 'driver_name', 'id');
    }
    
}
