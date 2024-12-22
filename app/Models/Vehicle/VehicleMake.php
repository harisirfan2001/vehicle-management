<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMake extends Model
{
    use HasFactory;
    
    public function vehicleModels() {
        return $this->hasMany(VehicleModel::class); // Use 'vehicle_make_id' if that is the foreign key
    }
}
