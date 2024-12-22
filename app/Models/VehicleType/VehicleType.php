<?php

namespace App\Models\VehicleType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManageVehicle\Vehicle;

class VehicleType extends Model
{
    use HasFactory;

    public function vehicles()
{
    return $this->hasMany(Vehicle::class);
}

}
