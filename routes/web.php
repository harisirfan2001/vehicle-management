<?php

use App\Exports\TableExport;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RolesController;
use App\Http\Controllers\VmsController;
use App\Http\Controllers\vehiclesController\DriverController;
use App\Http\Controllers\vehiclesController\FuelController;
use App\Http\Controllers\vehiclesController\GatePassController;
use App\Http\Controllers\vehiclesController\VehicleController;
use App\Http\Controllers\vehiclesController\RouteController;
use App\Http\Controllers\vehiclesController\VehicleMakeController;
use App\Http\Controllers\vehiclesController\VehicleModelController;
use App\Http\Controllers\vehiclesController\VehicleTypeController;
use App\Http\Controllers\vehiclesController\VehicleVarientController;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);
Route::middleware(['auth', 'checkUserActive'])->group(function () {
    Route::get('/', [VmsController::class, 'index'])->name('dashboard');    
    Route::resource('manage-user', UserController::class);
    Route::resource('manage-roles', RolesController::class);
    Route::resource('vehicle-makes', VehicleMakeController::class);
    Route::resource('vehicle-models', VehicleModelController::class);
    Route::resource('vehicle-varients', VehicleVarientController::class);
    Route::resource('gate-passes', GatePassController::class)->except(['show']);
    Route::resource('drivers', DriverController::class);
    Route::resource('fuel', FuelController::class);
    Route::resource('vehicle', VehicleController::class);
    Route::get('/vehicle/get-last-reading/{vehicleId}', [VehicleController::class, 'getLastReading']);
    Route::resource('vehicle-types', VehicleTypeController::class);
    Route::get('/gatepass/checkin/{id}', [GatePassController::class, 'check_in'])->name('checkingp');
    Route::put('/gatepass/remove/{id}', [GatePassController::class, 'remove'])->name('removegp');
    Route::post('/user/{id}/toggle', [UserController::class, 'toggle'])->name('statusupdate');
    Route::get('/gatepass/export-table', function () {
        return Excel::download(new TableExport, 'gatepass_record.xlsx');
    })->name('exportdata'); 
});
