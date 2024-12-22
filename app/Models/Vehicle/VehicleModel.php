<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    // Relationship with VehicleMake
    public function vehicleMake() 
    { 
        return $this->belongsTo(VehicleMake::class);
    }

    // Relationship with VehicleVarient
    public function vehicleVarients() 
    {
        return $this->hasMany(VehicleVarient::class);
    }
}
