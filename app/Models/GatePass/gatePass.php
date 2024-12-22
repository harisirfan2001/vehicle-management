<?php

namespace App\Models\GatePass;

use App\Models\ManageVehicle\Vehicle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gatePass extends Model
{
    use HasFactory;
    protected $fillable = [
        'gate_pass_number',
        'vehicle_no',
        'driver_name',
        'date',
        'meter_out',
        'covered_km',
        'time_out',
        'user_officer',
        'area_name',
        'pass_receiver',
        'pass_receiver_id',
        'pass_receiver_checkin',
        'pass_receiver_checkin_id',
        'reason_to_travel',
        'meter_out_image',
        'meter_in_image',
        'remarks',
        'created_by',
        'checkedin_by'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y h:i A');
    }

    public function getCheckedinAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y h:i A');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_no', 'licence_plate'); 
    }

    public function checkedout_by()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function checkedin_by()
    {
        return $this->belongsTo(User::class, 'checkedin_by', 'id');
    }
    
}
