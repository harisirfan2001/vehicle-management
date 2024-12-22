<?php

namespace App\Models\VehiclesFuel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManageVehicle\Vehicle;
use App\Models\Driver\Driver;

class Fuel extends Model
{
    use HasFactory;


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id' ,'vehicle_no');
    
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'id' , 'driver_name');
    }
}
