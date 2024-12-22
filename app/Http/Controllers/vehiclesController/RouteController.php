<?php

namespace App\Http\Controllers\vehiclesController;

use Illuminate\Http\Request;
use App\Models\VehiclesRoute\RouteModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;




class RouteController extends Controller
{
    public function create() {
        return view('vehicles.VehicleRoutes.create');
        
    }

    public function index() {
        return view('vehicles.VehicleRoutes.index');
        
    }
}
