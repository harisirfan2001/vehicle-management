@extends('layouts.master')
@section('title', 'New Vehicle')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        @if ($errors->any())
    <div class="alert alert-muted">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vehicle</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Vehicle</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn">
                        <a href="{{ route('vehicle.index') }}" class="btn btn-light">View Vehicle</a>
                    </button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <h6 class="text-uppercase mb-3">Add Vehicle</h6>
        <hr>

        <div id="stepper1" class="bs-stepper">
            <div class="card">
                <div class="card-body">
                    <div class="bs-stepper-content">
                        <form action="{{ route('vehicle.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

                                <h5 class="mb-1">Add Vehicle</h5>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-lg-3">
                                        <label for="InputMake" class="form-label">Vehicle Make</label>
                                        <select class="form-select" id="InputMake" name="make_id">
                                            <option selected>Select Vehicle Make</option>
                                            @foreach($makes as $make)
                                             <option value="{{ $make->id }}">{{ $make->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label for="InputModel" class="form-label">Vehicle Model</label>
                                        <select class="form-select" id="InputModel" name="model_id">
                                            <option selected>Select Vehicle Model</option>
                                            @foreach($models as $model)
                                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label for="Inputvarient" class="form-label">Vehicle Varient</label>
                                        <select class="form-select" id="Inputvarient" name="varient_id">
                                            <option selected>Select Vehicle Varient</option>
                                            @foreach($varients as $varient)
                                                <option value="{{ $varient->id }}">{{ $varient->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label for="InputColor" class="form-label">Vehicle Color</label>
                                        <select class="form-select" id="InputColor" name="color" >
                                            <option selected>Select Vehicle Colors</option>
                                            <option value="Red">Red</option>
                                            <option value="Black">Black</option>
                                            <option value="White">White</option>
                                            <option value="Silver">Silver</option>
                                            <option value="Gray">Gray</option>
                                            <option value="Navy Blue">Navy Blue</option>
                                            <option value="Beige">Beige</option>
                                            <option value="Pearl">Pearl</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-lg-4">
                                                    <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                                    <select class="form-select" name="vehicle_type" id="vehicle_type">
                                                        <option selected disabled>Choose Vehicle Type</option>
                                                        @foreach($vehicleTypes as $type)
                                                            <option value="{{ $type->id }}" >
                                                                {{ $type->vehicle_type }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <label for="InputLicensePlate" class="form-label">License Plate</label>
                                        <input type="text" class="form-control" placeholder="License Plate" name="licence_plate" required>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="InputInitialMileage" class="form-label">Initial Mileage (km)</label>
                                        <input type="number" onblur="validateInitialKM(this)" class="form-control" name="initial_mileage">
                                    </div>

                                </div>
                                <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputModelYear" class="form-label">Model Year</label>
            <input type="number" class="form-control" placeholder="Model Year" required name="model_year">
        </div>
        <div class="col-12 col-lg-4">
            <label for="InputCity" class="form-label">Registration City</label>
            <input type="text" class="form-control" required placeholder="Registration City" name="registration_city">
        </div>
        <div class="col-12 col-lg-4">
            <label for="InputYear" class="form-label">Province</label>
            <input type="text" class="form-control" required placeholder="Province " name="province">
        </div>
        <div class="col-12 col-lg-4">
                                        <label for="InputImage" class="form-label">Vehicle Image</label>
                                        <input class="form-control" type="file" name="image" required>
                                    </div>
    </div>

</div>
<div class="col-12 mt-4">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light px-4">Submit</button>
    </div>
</div>
</form>
                    </div>
                </div>
            </div>
        </div>
        <!--end stepper one-->
    </div>
</div>

{{-- Hidden form fields for future use --}}
{{--
    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputHorsePower" class="form-label">Vehicle Horse Power</label>
            <input type="number" class="form-control" name="horse_power">
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputAvgKm" class="form-label">Average (Km Per Gallon)</label>
            <input type="number" class="form-control" name="average_km_per_gallon">
        </div>
        <div class="col-12 col-lg-4">
            <label for="InputLicenseExpiry" class="form-label">Licence Expiry Date</label>
            <input type="date" class="form-control" name="license_expiry_date">
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputVehicleGroup" class="form-label">Select Vehicle Group</label>
            <select class="form-select" id="InputVehicleGroup" name="vehicle_group">
                <option selected>Select Vehicle Group</option>
                <option value="Group1">Group 1</option>
                <option value="Group2">Group 2</option>
                <option value="Group3">Group 3</option>
            </select>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <label for="InputRegistrationExpiry" class="form-label">Registration Expiry Date</label>
            <input type="date" class="form-control" name="registration_expiry_date">
        </div>
        <div class="col-12 col-lg-6">
            <label for="InputUserDefined" class="form-label">Add User Defined Field</label>
            <input type="text" class="form-control" placeholder="Add User Defined" name="user_defined_field">
        </div>
    </div>
--}}

<script>

function validateInitialKM(input) {
        const pattern = /^\d{6}$/;
        if (!pattern.test(input.value)) {
            input.setCustomValidity("Initial KM must be exactly 6 digits");
        } else {
            input.setCustomValidity('');
        }
    }
</script>

@endsection
