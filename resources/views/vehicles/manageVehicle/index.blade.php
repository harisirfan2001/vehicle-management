@extends('layouts.master')
@section('title', 'Vehicles List')
@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Vehicles</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Vehicles Data</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn"><a href="{{ route('vehicle.create') }}"
                                class="btn btn-light">Add Vehicle</a></button>

                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->


        <h6 class="mb-0 text-uppercase">Manage Vehicles </h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Varient</th>
                                    <th>Color</th>
                                    <th>Type</th>
                                     <th>Model Year</th>
                                    <th>Registration City</th>
                                    <th>Province</th>
                                    {{--<th>VIN</th>
                                    <th>Year</th> --}}
                                    <th>License Plate</th>
                                    {{-- <th>Average KM per Gallon</th> --}}
                                    {{-- <th>License Expiry Date</th> --}}
                                    <th>Initial Mileage</th>
                                    {{-- <th>Vehicle Group</th> --}}
                                    {{-- <th>Registration Expiry Date</th> --}}
                                    {{-- <th>User Defined Field</th> --}}
                                    <th id="myImage">Image</th>
                                    <th>Action</th>
                                </tr>                          
                        </thead>
                        <tbody>
                            @foreach ($indexdata as $key => $item)
                               
                            <tr>
                                    <td>{{ ++$key }}</td> <!-- Serial number (increments automatically) -->
                                    <td>{{ $item->make->name}}</td> <!-- Show make name -->
                                    <td>{{ $item->model->name}}</td> <!-- Show model name -->
                                    <td>{{ $item->varient->name}}</td> <!-- Show varient name -->
                                    <td>{{ $item->color }}</td>
                                    <td>{{ $item->vehicleType->vehicle_type }}</td>
                                     <td>{{ $item->model_year }}</td>
                                    <td>{{ $item->registration_city}}</td>
                                    <td>{{ $item->province }}</td>
                                    {{-- <td>{{ $item->vin }}</td>
                                    <td>{{ $item->year }}</td> --}}
                                    <td>{{ $item->licence_plate }}</td>
                                    {{-- <td>{{ $item->average_km_per_gallon }}</td>
                                    <td>{{ $item->license_expiry_date }}</td> --}}
                                    <td>{{ $item->initial_mileage }}</td>
                                    {{-- <td>{{ $item->vehicle_group }}</td> --}}
                                    {{-- <td>{{ $item->registration_expiry_date }}</td>
                                    <td>{{ $item->user_defined_field }}</td> --}}
                                    <td>
                                        <img id="myImage" src="{{ asset( $item->image) }}" alt="Image" width="50"
                                           height="50" onclick="handleClick()"> 

                                   </td>
                                   <td class="d-flex justify-content-center align-items-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                <form action="{{ route('vehicle.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</button>
                </form>
                                                <li><a class="dropdown-item" href="{{ route('vehicle.edit', $item->id) }}">Edit</a></li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    
@endsection
