<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleVarient extends Model
{
    use HasFactory;

    // Relationship with VehicleMake
    public function vehicleMake()
    {
        return $this->belongsTo(VehicleMake::class);
    }

    // Relationship with VehicleModel
    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }
}
