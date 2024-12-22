<?php

namespace App\Http\Controllers\vehiclesController;

use App\Http\Controllers\Controller;
use App\Models\Driver\Driver;
use App\Models\GatePass\gatePass;
use App\Models\ManageVehicle\Vehicle;
use Illuminate\Support\Facades\Auth;
use App\Events\GatePassRequested;
use Illuminate\Http\Request;

class GatePassController extends Controller
{

   
    public function create()
    {

        $vehicles = Vehicle::with(['gatePass' => function ($query) {
            $query->whereNull('time_in');
        }])->select('id', 'licence_plate')->get();

        $driver = Driver::select('id', 'full_name')->get();

        $lastGatePass = gatePass::latest()->first();
        $nextGatePassNumber = $lastGatePass ? ((int) $lastGatePass->gate_pass_number + 1) : 1;

        return view('vehicles.VehicleGatePass.create', [
            'nextGatePassNumber' => $nextGatePassNumber,
            'vehicles' => $vehicles,
            'driver' => $driver,
        ]);
    }
    public function store(Request $request)
{
    $request->validate([
        'vehicle_no' => 'required',
        'driver_name' => 'required',
        'date' => 'required|date|before_or_equal:today',
        'meter_out' => 'required|numeric',
        'time_out' => 'required',
        'user_officer' => 'required',
        'area_name' => 'required',
        'pass_receiver' => 'required',
        'pass_receiver_id' => 'required',
        'reason_to_travel' => 'required',
        'meter_out_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', 
        'meter_in_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048' 
    ]);

    $lastGatePass = gatePass::latest()->first();
    $nextGatePassNumber = $lastGatePass ? ((int) $lastGatePass->gate_pass_number + 1) : 1;

    $meterOutImagePath = null;
    if ($request->hasFile('meter_out_image')) {
        $meterOutFile = $request->file('meter_out_image');
        $meterOutFileName = $nextGatePassNumber . '.' . $meterOutFile->getClientOriginalExtension();
        $meterOutDir = public_path('meter_out_slip/' . $request->licence_plate);
        if (!file_exists($meterOutDir)) {
            mkdir($meterOutDir, 0755, true);
        }
        $meterOutFile->move($meterOutDir, $meterOutFileName);
        $meterOutImagePath = 'meter_out_slip/' . $request->licence_plate . '/' . $meterOutFileName;
    }

    $meterInImagePath = null;
    if ($request->hasFile('meter_in_image')) {
        $meterInFile = $request->file('meter_in_image');
        $meterInFileName = $nextGatePassNumber . '.' . $meterInFile->getClientOriginalExtension();
        $meterInDir = public_path('meter_in_slip/' . $request->licence_plate);
        if (!file_exists($meterInDir)) {
            mkdir($meterInDir, 0755, true);
        }
        $meterInFile->move($meterInDir, $meterInFileName);
        $meterInImagePath = 'meter_in_slip/' . $request->licence_plate . '/' . $meterInFileName;
    }
    
    $gatePass = gatePass::create([
        'gate_pass_number' => $nextGatePassNumber,
        'vehicle_no' => $request->vehicle_no,
        'driver_name' => $request->driver_name,
        'date' => $request->date,
        'meter_out' => $request->meter_out,
        'covered_km' => $request->covered_km ?? null,
        'time_out' => $request->time_out,
        'user_officer' => $request->user_officer,
        'area_name' => $request->area_name,
        'pass_receiver' => $request->pass_receiver,
        'pass_receiver_id' => $request->pass_receiver_id,
        'pass_receiver_checkin' => $request->pass_receiver_checkin ?? null,
        'pass_receiver_checkin_id' => $request->pass_receiver_checkin_id ?? null,
        'reason_to_travel' => $request->reason_to_travel,
        'meter_out_image' => $meterOutImagePath,
        'meter_in_image' => $meterInImagePath,
        'requested_by' => auth()->id(),
        'created_by' => Auth::id()
    ]);

    event(new GatePassRequested($gatePass, auth()->user()->name));

    return redirect()->route('gate-passes.index')->with('status', 'Gate pass submitted and pending approval.');
}


    public function index()
    {
        $indexdata = gatePass::with(['checkedout_by', 'checkedin_by'])->whereNull('time_in')->orderBy('id', 'desc')->get();
        $checkin = gatePass::with(['checkedout_by', 'checkedin_by'])->whereNotNull('time_in')->orderBy('id', 'desc')->get();
        $vehicles = Vehicle::with(['gatePass' => function ($query) {
            $query->latest()->first();
        }])->get();
        $gatePasses = gatePass::where('status', 'approved')->get();

    

        return view('vehicles.VehicleGatePass.index', compact('indexdata', 'checkin', 'vehicles', 'gatePasses'));
    }

    public function destroy($id)
    {
        $deletedata = gatePass::find($id);
        $deletedata->delete();
        return redirect()->route('gate-passes.index');
    }

    public function edit($id)
    {
        $editdata = gatePass::find($id);
        $vehicles = Vehicle::with(['gatePass' => function ($query) {
            $query->whereNull('time_in');
        }])->select('id', 'licence_plate')->get();
        $driver = Driver::select('id', 'full_name')->get();

        return view('vehicles.VehicleGatePass.edit', compact('editdata', 'vehicles', 'driver'));
    }

    public function check_in($id)
    {
        $editdata = gatePass::find($id);
        return view('vehicles.VehicleGatePass.checkin', compact('editdata'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_no' => 'required',
            'driver_name' => 'required',
            'date' => 'required|date|before_or_equal:today',
            'meter_out' => 'required|numeric',
            'meter_in' => 'required|numeric|gt:meter_out',
            'time_out' => 'required',
            'time_in' => 'required',
            'user_officer' => 'required',
            'area_name' => 'required',
            'pass_receiver' => 'required',
            'pass_receiver_id' => 'required',
            'reason_to_travel' => 'required',
            'remarks' => 'required',
         
        ]);
        $updatedata = gatePass::findOrFail($id);
        $nextGatePassNumber = $updatedata->gate_pass_number;
        $meterOutImagePath = null;
        if ($request->hasFile('meter_out_image')) {
            $meterOutFile = $request->file('meter_out_image');
            $meterOutFileName = $nextGatePassNumber . '.' . $meterOutFile->getClientOriginalExtension();
            $meterOutDir = public_path('meter_out_slip/' . $request->licence_plate);
            if (!file_exists($meterOutDir)) {
                mkdir($meterOutDir, 0755, true);
            }
            $meterOutFile->move($meterOutDir, $meterOutFileName);
            $meterOutImagePath = 'meter_out_slip/' . $request->licence_plate . '/' . $meterOutFileName;
        }
    
        $meterInImagePath = null;
        if ($request->hasFile('meter_in_image')) {
            $meterInFile = $request->file('meter_in_image');
            $meterInFileName = $nextGatePassNumber . '.' . $meterInFile->getClientOriginalExtension();
            $meterInDir = public_path('meter_in_slip/' . $request->licence_plate);
            if (!file_exists($meterInDir)) {
                mkdir($meterInDir, 0755, true);
            }
            $meterInFile->move($meterInDir, $meterInFileName);
            $meterInImagePath = 'meter_in_slip/' . $request->licence_plate . '/' . $meterInFileName;
        }
        
        
        $updatedata->time_in = $request->time_in;
        $updatedata->vehicle_no = $request->vehicle_no;
        $updatedata->driver_name = $request->driver_name;
        $updatedata->date = $request->date;
        $updatedata->meter_out = $request->meter_out;
        $updatedata->meter_in = $request->meter_in;
        $updatedata->covered_km = $request->covered_km;
        $updatedata->time_out = $request->time_out;
        $updatedata->total_time = $request->total_time;
        $updatedata->user_officer = $request->user_officer;
        $updatedata->area_name = $request->area_name;
        $updatedata->pass_receiver = $request->pass_receiver;
        $updatedata->pass_receiver_id = $request->pass_receiver_id;
        $updatedata->pass_receiver_checkin = $request->pass_receiver_checkin;
        $updatedata->pass_receiver_checkin_id = $request->pass_receiver_checkin_id;
        $updatedata->reason_to_travel = $request->reason_to_travel;
        $updatedata->remarks = $request->remarks;
        $updatedata->checkedin_by = auth()->user()->id;
        $updatedata->checkedin_at = now();

        $updatedata->save();
        return redirect()->route('gate-passes.index');
    }

    public function remove($id)
    {
        $model = gatePass::findOrFail($id);
        $model->is_visible = false;
        $model->save();

        return redirect()->back()->with('success', 'Item removed successfully.');
    }

    

}
