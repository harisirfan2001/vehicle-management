<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver\Driver;
use App\Models\GatePass\gatePass;
use App\Models\ManageVehicle\Vehicle;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class VmsController extends Controller
{
  public function index() {    
    $data['counts']['total_vehicles'] = Vehicle::all()->count();
    $data['counts']['total_checked_out_vehicles'] = Vehicle::whereHas('gatePass', function($q){$q->whereNull('time_in');})->count();
    $data['counts']['total_gate_passes'] = gatePass::all()->count();
    $data['counts']['total_drivers'] = Driver::all()->count();

    $data['table']['total_vehicle_driven'] = Vehicle::with(['make', 'model', 'varient', 'vehicleType' ])->get();
    $data['table']['total_checkedout_passes'] = gatePass::with(['checkedout_by'])->whereNull('time_in')->get();

    return view('index', ['data' => $data]); 
}
  public function logout(Request $request)
  {
     
      $request->session()->flush();
      Auth::logout();

      return redirect()->route('authindex'); 
  }
}
