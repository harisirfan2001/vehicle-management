<?php

namespace App\Http\Controllers\vehiclesController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VehiclesFuel\Fuel;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleVarient;
use App\Models\ManageVehicle\Vehicle;
use App\Models\Driver\Driver;
use Illuminate\Support\Facades\File;


class FuelController extends Controller
{

    public function index()
    {
        $getmodule = Fuel::all();
        $vehicles = Vehicle::select('id', 'licence_plate')->get();
        $drivers = Driver::select('id', 'full_name')->get();
    
        return view('vehicles.fuel.index', compact(
            'getmodule',
            'vehicles',
            'drivers'
        ));
    }
    
   public function create()
{

    $vehicles = Vehicle::select('id', 'licence_plate')->get();
    $drivers = Driver::select('id', 'full_name')->get();

    return view('vehicles.fuel.create', compact(
        'vehicles',
        'drivers'
    ));
}

    public function store(Request $request)

{
    $request->validate([
        'vehicle_no' => 'required|string|exists:vehicles,id', 
        'driver_name' => 'required|string|exists:drivers,id', 
        'meter_reading_on_refilling' => 'required|numeric',
        'fuel_type' => 'required|string',
        'current_fuel_status' => 'required|string',
        'time' => 'required',
        'date' => 'required|date',
        'fuel_cost' => 'required|numeric',
        'total_fuel_qty' => 'required|numeric',
        'total_price' => 'required|numeric',
        'refilling_station' => 'required|string',
        'remarks' => 'nullable|string',
        'payment_mode' => 'required|string',
        'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048'
    ]);
    

    $folderName = date('mY');
    $basePath = public_path('images/fuelimage/' . $folderName);

    $vehicleFolder = $basePath . '/' . $request->number;

    if (!File::exists($basePath)) {
        File::makeDirectory($basePath, 0755, true);
    }

    if (!File::exists($vehicleFolder)) {
        File::makeDirectory($vehicleFolder, 0755, true);
    }
    $getModel = new Fuel;

  
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move($vehicleFolder, $fileName);
        $getModel->file = 'images/fuelimage/' . $folderName . '/' . $request->number . '/' . $fileName; // Save the relative path
    }

    $getModel->vehicle_no = $request->vehicle_no;
    $getModel->driver_name = $request->driver_name;
    $getModel->meter_reading_on_refilling = $request->meter_reading_on_refilling;
    $getModel->fuel_type = $request->fuel_type;
    $getModel->current_fuel_status = $request->current_fuel_status;
    $getModel->time = $request->time;
    $getModel->date = $request->date;
    $getModel->fuel_cost = $request->fuel_cost;
    $getModel->total_fuel_qty = $request->total_fuel_qty;
    $getModel->total_price = $request->total_price;
    $getModel->refilling_station = $request->refilling_station;
    $getModel->remarks = $request->remarks;
    $getModel->payment_mode = $request->payment_mode;
    $getModel->save(); 

    return redirect()->route('fuel.index');
}

    public function destroy($id)
{
  
    $getModel = Fuel::findOrFail($id);

    if ($getModel->file && File::exists(public_path($getModel->file))) {
        File::delete(public_path($getModel->file));
    }


    $getModel->delete();

   
    return back()->with('success', 'Data deleted successfully!');
}

    public function edit($id)
    {
        $fueling = Fuel::find($id);
        $vehicles = Vehicle::select('id', 'licence_plate')->get();
        $drivers = Driver::select('id', 'full_name')->get();
    
        return view('vehicles.fuel.update', compact('fueling', 'vehicles','drivers'));
    }
    public function update(Request $request, string $id)
{
    $request->validate([
        'vehicle_no' => 'required|string|exists:vehicles,id', 
        'driver_name' => 'required|string|exists:drivers,id', 
        'meter_reading_on_refilling' => 'required|numeric',
        'fuel_type' => 'required|string',
        'current_fuel_status' => 'required|string',
        'time' => 'required',
        'date' => 'required|date',
        'fuel_cost' => 'required|numeric',
        'total_fuel_qty' => 'required|numeric',
        'total_price' => 'required|numeric',
        'refilling_station' => 'required|string',
        'remarks' => 'nullable|string',
        'payment_mode' => 'required|string',
        'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048'
    ]);

    $getmodule = Fuel::find($id);

    if ($request->hasFile('file')) {
        $folderName = date('mY');
        $basePath = public_path('images/fuelimage/' . $folderName);
        $vehicleFolder = $basePath . '/' . $request->vehicle_no;

        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true);
        }

        if (!File::exists($vehicleFolder)) {
            File::makeDirectory($vehicleFolder, 0755, true);
        }

        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move($vehicleFolder, $fileName);
        $getmodule->file = 'images/fuelimage/' . $folderName . '/' . $request->vehicle_no . '/' . $fileName;
    }

    $getmodule->vehicle_no = $request->vehicle_no;
    $getmodule->driver_name = $request->driver_name;
    $getmodule->meter_reading_on_refilling = $request->meter_reading_on_refilling;
    $getmodule->fuel_type = $request->fuel_type;
    $getmodule->current_fuel_status = $request->current_fuel_status;
    $getmodule->time = $request->time;
    $getmodule->date = $request->date;
    $getmodule->fuel_cost = $request->fuel_cost;
    $getmodule->total_fuel_qty = $request->total_fuel_qty;
    $getmodule->total_price = $request->total_price;
    $getmodule->refilling_station = $request->refilling_station;
    $getmodule->remarks = $request->remarks;
    $getmodule->payment_mode = $request->payment_mode;

    $getmodule->save();

    return redirect()->route('fuel.index')->with('success', 'Fuel record updated successfully.');
}

}
