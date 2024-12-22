<?php

namespace App\Http\Controllers\vehiclesController;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleMake;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
    public function create()
    {
        return view('vehicles.VehicleModel.make');
    }
    public function index(Request $request)
    {
        $indexdata = VehicleMake::all();

        if ($request->ajax()) {
            return response()->json($indexdata); 
        }
        return view('vehicles.VehicleModel.make');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
        $storeMake = new VehicleMake;
        $storeMake->name = $request->name;
        $storeMake->save();

        return response()->json(['success' => 'Vehicle make stored successfully!', 'id' => $storeMake->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $vehicleMake = VehicleMake::findOrFail($id);
        $vehicleMake->delete();

        return response()->json(['success' => 'Vehicle Make deleted successfully']);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $updatingdata = VehicleMake::findOrFail($id);

        $updatingdata->name = $request->name;
        $updatingdata->save();

        return response()->json(['message' => 'Data Updated']);
    }

    public function edit($id)
    {
        $make = VehicleMake::find($id);

        if (!$make) {
            return response()->json(['error' => 'Vehicle make not found'], 404);
        }

        return response()->json($make);
    }

}
