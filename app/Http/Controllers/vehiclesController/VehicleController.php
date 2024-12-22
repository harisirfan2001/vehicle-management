<?php

namespace App\Http\Controllers\vehiclesController;
//manageRouteController
use App\Http\Controllers\Controller;
use App\Models\ManageVehicle\Vehicle;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleVarient;
use App\Models\VehicleType\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VehicleController extends Controller
{
    public function index()
    {
        $indexdata = Vehicle::with(['make', 'model', 'varient'])->get();
        
        return view('vehicles.manageVehicle.index', compact('indexdata'));
    }
    
    public function create()
    {
        $makes = VehicleMake::all();
        $models = VehicleModel::all();
        $varients = VehicleVarient::all();
        $vehicleTypes = VehicleType::all();
        return view('vehicles.manageVehicle.create', compact('makes', 'models', 'varients', 'vehicleTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'make_id' => 'required|exists:vehicle_makes,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'varient_id' => 'required|exists:vehicle_varients,id',
            'color' => 'required|string|max:255',
            'vehicle_type' => 'required',
            // 'engine_type' => 'nullable|string|max:255', // Changed to nullable
            // 'horse_power' => 'nullable|integer', // Changed to nullable
            'province' => 'required|string|max:255', // Changed to max instead of numeric
            'registration_city' => 'required|string|max:255', // Changed to max instead of numeric
            'model_year' => 'required|integer',
            'licence_plate' => 'required|string|max:255', // Changed to max instead of numeric
            // 'average_km_per_gallon' => 'required|numeric',
            // 'license_expiry_date' => 'required|date',
            'initial_mileage' => 'required|integer',
            // 'vehicle_group' => 'required|string|max:255',
            // 'registration_expiry_date' => 'required|date',
            // 'user_defined_field' => 'nullable|string|max:255', // Changed to max instead of numeric
            'image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            // 'file' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

        $basePath = public_path('images/vehicleImages');
        $vehicleFolder = $basePath . '/' . $request->licence_plate; // Change from vehicle_number to licence_plate

        if (!File::exists($vehicleFolder)) {
            File::makeDirectory($vehicleFolder, 0755, true);
        }

        $vehicle = new Vehicle;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($vehicleFolder, $fileName);
            $vehicle->image = 'images/vehicleImages/' . $request->licence_plate . '/' . $fileName; // Change from vehicle_number to licence_plate
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($vehicleFolder, $fileName);
            $vehicle->file = 'images/vehicleImages/' . $request->licence_plate . '/' . $fileName; // Change from vehicle_number to licence_plate
        }

        $vehicle->make_id = $request->make_id;
        $vehicle->color = $request->color;
        $vehicle->varient_id = $request->varient_id;
        $vehicle->model_id = $request->model_id;
        $vehicle->vehicle_type = $request->vehicle_type;
        $vehicle->province = $request->province;
        $vehicle->model_year = $request->model_year;
        $vehicle->registration_city = $request->registration_city;

        // $vehicle->engine_type = $request->engine_type;
        // $vehicle->horse_power = $request->horse_power;
        $vehicle->licence_plate = $request->licence_plate;
        // $vehicle->average_km_per_gallon = $request->average_km_per_gallon;
        // $vehicle->license_expiry_date = $request->license_expiry_date;
        $vehicle->initial_mileage = $request->initial_mileage;
        // $vehicle->vehicle_group = $request->vehicle_group;
        // $vehicle->registration_expiry_date = $request->registration_expiry_date;
        // $vehicle->user_defined_field = $request->user_defined_field;

        $vehicle->save();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle information added successfully.');
    }

    public function edit($id)
    {
        $editdata = Vehicle::findOrFail($id);
        $vehicleTypes = VehicleType::all();
        $makes = VehicleMake::all();
        $models = VehicleModel::all();
        $varients = VehicleVarient::all();
    
        return view('vehicles.manageVehicle.update', compact('vehicleTypes', 'editdata', 'makes', 'models', 'varients'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'make_id' => 'required|exists:vehicle_makes,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'varient_id' => 'required|exists:vehicle_varients,id',
            'color' => 'required|string|max:255',
            'vehicle_type' => 'required',
            'province' => 'required|string|max:255', // Changed to max instead of numeric
            'registration_city' => 'required|string|max:255', // Changed to max instead of numeric
            'model_year' => 'required|integer',
            // 'engine_type' => 'nullable|string|max:255', // Changed to nullable
            // 'horse_power' => 'nullable|integer', // Changed to nullable
            'licence_plate' => 'required|string|max:255', // Changed to max instead of numeric
            // 'average_km_per_gallon' => 'required|numeric',
            // 'license_expiry_date' => 'required|date',
            'initial_mileage' => 'required|integer',
            // 'vehicle_group' => 'required|string|max:255',
            // 'registration_expiry_date' => 'required|date',
            // 'user_defined_field' => 'nullable|string|max:255', // Changed to max instead of numeric
            'image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            // 'file' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $basePath = public_path('images/vehicleImages');
        $vehicleFolder = $basePath . '/' . $request->licence_plate; // Change from vehicle_number to licence_plate

        if (!File::exists($vehicleFolder)) {
            File::makeDirectory($vehicleFolder, 0755, true);
        }

        if ($request->hasFile('image')) {
            if ($vehicle->image && File::exists(public_path($vehicle->image))) {
                File::delete(public_path($vehicle->image));
            }

            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($vehicleFolder, $fileName);
            $vehicle->image = 'images/vehicleImages/' . $request->licence_plate . '/' . $fileName; // Change from vehicle_number to licence_plate
        }

        if ($request->hasFile('file')) {
            if ($vehicle->file && File::exists(public_path($vehicle->file))) {
                File::delete(public_path($vehicle->file));
            }

            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($vehicleFolder, $fileName);
            $vehicle->file = 'images/vehicleImages/' . $request->licence_plate . '/' . $fileName; // Change from vehicle_number to licence_plate
        }

        $vehicle->make_id = $request->make_id;
        $vehicle->color = $request->color;
        $vehicle->varient_id = $request->varient_id;
        $vehicle->model_id = $request->model_id;
        $vehicle->vehicle_type = $request->vehicle_type;
        $vehicle->province = $request->province;
        $vehicle->model_year = $request->model_year;
        $vehicle->registration_city = $request->registration_city;

        // $vehicle->engine_type = $request->engine_type;
        // $vehicle->horse_power = $request->horse_power;
        $vehicle->licence_plate = $request->licence_plate;
        // $vehicle->average_km_per_gallon = $request->average_km_per_gallon;
        // $vehicle->license_expiry_date = $request->license_expiry_date;
        $vehicle->initial_mileage = $request->initial_mileage;
        // $vehicle->vehicle_group = $request->vehicle_group;
        // $vehicle->registration_expiry_date = $request->registration_expiry_date;
        // $vehicle->user_defined_field = $request->user_defined_field;


        $vehicle->save();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle information updated successfully.');
    }

    public function getLastReading($vehicleId) {
        $vehicle = Vehicle::where('licence_plate', $vehicleId)->first();
        return $vehicle->gatePass()->latest()->first();
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        if ($vehicle->image && File::exists(public_path($vehicle->image))) {
            File::delete(public_path($vehicle->image));
        }

        if ($vehicle->file && File::exists(public_path($vehicle->file))) {
            File::delete(public_path($vehicle->file));
        }

        $vehicle->delete();
        return redirect()->route('vehicle.index')->with('success', 'Vehicle information deleted successfully.');
    }
}
