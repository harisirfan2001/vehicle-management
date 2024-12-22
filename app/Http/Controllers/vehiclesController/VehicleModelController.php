<?php

namespace App\Http\Controllers\vehiclesController;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
   
    public function create()
    {
        return view('vehicles.VehicleModel.model');
    }

    public function index(Request $request)
    {
        $makeId = $request->input('vehicle_make_id');
        $models = $makeId ? VehicleModel::where('vehicle_make_id', $makeId)->get() : VehicleModel::all();

        return response()->json($models);
    }

    public function edit($id)
    {
        $editmodel = VehicleModel::findOrFail($id); 
        return response()->json($editmodel);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_make_id' => 'required|exists:vehicle_makes,id',
        ]);

        $model = new VehicleModel;
        $model->vehicle_make_id = $request->vehicle_make_id;
        $model->name = $request->name;
        $model->save();

        return response()->json(['message' => 'Vehicle model created successfully'], 201);
    }

    public function destroy(string $id)
    {
        $vehicleModel = VehicleModel::findOrFail($id);
        $vehicleModel->delete();

        return response()->json(['message' => 'Vehicle model deleted successfully'], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_make_id' => 'required|exists:vehicle_makes,id',
            'name' => 'required|string|max:255',
        ]);

        $update = VehicleModel::findOrFail($id);
        $update->vehicle_make_id = $request->vehicle_make_id;
        $update->name = $request->name;
        $update->save();

        return response()->json(['message' => 'Vehicle model updated successfully'], 200);
    }
}
