<?php

namespace App\Models\ManageVehicle;

use App\Models\GatePass\gatePass;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleVarient;
use App\Models\VehicleType\VehicleType;
use App\Models\VehicleFuel\Fuel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    public function make()
    {
        return $this->belongsTo(VehicleMake::class, 'make_id');
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }
    public function varient()
    {
        return $this->belongsTo(VehicleVarient::class, 'varient_id');
    }
    public function gatePass()
    {
        return $this->hasOne(gatePass::class, 'vehicle_no', 'licence_plate'); // 'vehicle_no' is the foreign key in gate_passes, 'licence_plate' is the key in manage_vehicles
    }

    public function vehicleGatePasses()
    {
        return $this->hasMany(gatePass::class, 'vehicle_no', 'licence_plate'); // 'vehicle_no' is the foreign key in gate_passes, 'licence_plate' is the key in manage_vehicles

    }
    public function totalCoverdKms()
    {
        return $this->gatePass()->whereNotNull('time_in')->sum('covered_km');
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type', 'id');
    }
public function fuel()
{
    return $this->belongsTo(Fuel::class, 'vehicle_no', 'id');
}

}
