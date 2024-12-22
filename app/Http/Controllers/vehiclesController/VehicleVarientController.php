<?php

namespace App\Http\Controllers\vehiclesController;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleVarient; 
use Illuminate\Http\Request;

class VehicleVarientController extends Controller
{

    public function create()
    {
        $makes = VehicleMake::all(); 
        return view('vehicles.VehicleModel.varient', compact('makes'));
    }


    public function index(Request $request)
    {
        $makeId = $request->input('vehicle_make_id');
        $modelId = $request->input('vehicle_model_id');

        $varients = VehicleVarient::with(['vehicleModel.vehicleMake']) 
            ->when($makeId, function ($query) use ($makeId) {
                $query->whereHas('vehicleModel', function ($query) use ($makeId) {
                    $query->where('vehicle_make_id', $makeId);
                });
            })
            ->when($modelId, function ($query) use ($modelId) {
                $query->where('vehicle_model_id', $modelId);
            })
            ->get();

        return response()->json($varients);
    }

    public function edit($id)
    {
        $editVarient = VehicleVarient::findOrFail($id);
        return response()->json($editVarient);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_make_id' => 'required|exists:vehicle_makes,id', 
            'vehicle_model_id' => 'required|exists:vehicle_models,id', 
            'name' => 'required|string|max:255',
        ]);

        $varient = new VehicleVarient(); 
        $varient->vehicle_make_id = $validated['vehicle_make_id'];
        $varient->vehicle_model_id = $validated['vehicle_model_id'];
        $varient->name = $validated['name'];
        $varient->save();

        return response()->json(['message' => 'Varient created successfully!', 'varient' => $varient], 201);
    }

    // Update an existing vehicle variant
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_make_id' => 'required|exists:vehicle_makes,id',
            'vehicle_model_id' => 'required|exists:vehicle_models,id',
        ]);

        $varient = VehicleVarient::findOrFail($id);
        $varient->vehicle_make_id = $validated['vehicle_make_id'];
        $varient->vehicle_model_id = $validated['vehicle_model_id'];
        $varient->name = $validated['name'];
        $varient->save();

        return response()->json(['message' => 'Vehicle variant updated successfully'], 200);
    }

    // Delete a vehicle variant
    public function destroy($id)
    {
        $varient = VehicleVarient::findOrFail($id);
        $varient->delete();

        return response()->json(['message' => 'Vehicle variant deleted successfully'], 200);
    }
}
