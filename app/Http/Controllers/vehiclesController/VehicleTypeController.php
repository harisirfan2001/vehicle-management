<?php

namespace App\Http\Controllers\vehiclesController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleType\VehicleType;
use Illuminate\Support\Facades\File;

class VehicleTypeController extends Controller
{
    public function create() {
        return view('vehicles.vehicleType.create');
        
    }

    public function store(Request $request) {
        
        $updatedata = new VehicleType;
        $updatedata->vehicle_type = $request->vehicle_type;
        $updatedata->display_name = $request->display_name;
        $updatedata->seats = $request->seats;
        $updatedata->save();

        return redirect()->route('vehicle-types.index');

        
    }
    
    public function index() {

        $indexdata = VehicleType::all();
        return view('vehicles.vehicleType.index', compact('indexdata'));

    }

    public function destroy($id) {
        $deletedata = VehicleType::find($id);
        $deletedata->delete();
        return redirect()->route('vehicle-types.index');

    }

    public function edit($id)
    {
        $editdata = VehicleType::find($id);

        return view('vehicles.vehicleType.update', compact('editdata'));
    }


    public function update(Request $request, string $id){
        
        $updatedata = VehicleType::find($id);
        $updatedata->vehicle_type = $request->vehicle_type;
        $updatedata->display_name = $request->display_name;
        $updatedata->seats = $request->seats;
        $updatedata->save();

        return redirect()->route('vehicle-types.index');


    }
    
    

}
