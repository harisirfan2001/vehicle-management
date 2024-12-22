@extends('layouts.master')
@section('title', 'Update Vehicle')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        @if ($errors->any())
    <div class="alert alert-muted">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
            <div class="breadcrumb-title pe-3">Vehicle</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Vehicle</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn">
                        <a href="{{ route('vehicle.index') }}" class="btn btn-light">View Vehicles</a>
                    </button>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <h6 class="text-uppercase">Update Vehicle</h6>
        <hr>

        <div id="stepper1" class="bs-stepper">
            <div class="card">
                <div class="card-body">
                    <div class="bs-stepper-content">
                        <form action="{{ route('vehicle.update', $editdata->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                <h5 class="mb-4">Update Vehicle</h5>
                                <div class="row g-3">

                                    <!-- Vehicle Make -->
                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="InputMake" class="form-label">Select Vehicle Make</label>
                                        <select class="form-select" name="make_id">
                                            @foreach ($makes as $make)
                                                <option value="{{ $make->id }}" {{ $editdata->make_id == $make->id ? 'selected' : '' }}>
                                                    {{ $make->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Vehicle Model -->
                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="InputModel" class="form-label">Select Vehicle Model</label>
                                        <select class="form-select" name="model_id">
                                            @foreach ($models as $model)
                                                <option value="{{ $model->id }}" {{ $editdata->model_id == $model->id ? 'selected' : '' }}>
                                                    {{ $model->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Vehicle Varient -->
                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="InputVarient" class="form-label">Select Vehicle Varient</label>
                                        <select class="form-select" name="varient_id">
                                            @foreach ($varients as $varient)
                                                <option value="{{ $varient->id }}" {{ $editdata->varient_id == $varient->id ? 'selected' : '' }}>
                                                    {{ $varient->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Vehicle Color -->
                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="InputColor" class="form-label">Select Vehicle Color</label>
                                        <select class="form-select" name="color">
                                            <option value="Red" {{ $editdata->color == 'Red' ? 'selected' : '' }}>Red</option>
                                            <option value="Black" {{ $editdata->color == 'Black' ? 'selected' : '' }}>Black</option>
                                            <option value="White" {{ $editdata->color == 'White' ? 'selected' : '' }}>White</option>
                                            <option value="Silver" {{ $editdata->color == 'Silver' ? 'selected' : '' }}>Silver</option>
                                            <option value="Gray" {{ $editdata->color == 'Gray' ? 'selected' : '' }}>Gray</option>
                                            <option value="Navy Blue" {{ $editdata->color == 'Navy Blue' ? 'selected' : '' }}>Navy Blue</option>
                                            <option value="Beige" {{ $editdata->color == 'Beige' ? 'selected' : '' }}>Beige</option>
                                            <option value="Pearl" {{ $editdata->color == 'Pearl' ? 'selected' : '' }}>Pearl</option>
                                            <option value="Other" {{ $editdata->color == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row g-3 mb-4">
                                    <!-- Vehicle Type -->
                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                        <select class="form-select" name="vehicle_type" id="vehicle_type">
                                            <option selected disabled>Choose Vehicle Type</option>
                                            @foreach($vehicleTypes as $type)
                                                <option value="{{ $type->id }}" {{ $editdata->vehicle_type == $type->id ? 'selected' : '' }}>
                                                    {{ $type->vehicle_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- License Plate -->
                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="InputLicensePlate" class="form-label">License Plate</label>
                                        <input type="text" class="form-control" placeholder="License Plate" name="licence_plate" value="{{ $editdata->licence_plate }}">
                                    </div>

                                    <!-- Initial Mileage -->
                                    <div class="col-12 col-lg-4 mb-2">
                                        <label for="InputInitialMileage" class="form-label">Initial Mileage (km)</label>
                                        <input type="number" class="form-control" name="initial_mileage" value="{{ $editdata->initial_mileage }}">
                                    </div>
                                </div>
                                <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputModelYear" class="form-label">Model Year</label>
            <input type="number" class="form-control" placeholder="Model Year"  value="{{ $editdata->model_year }}"required name="model_year">
        </div>
        <div class="col-12 col-lg-4">
            <label for="InputCity" class="form-label">Registration City</label>
            <input type="text" class="form-control" value="{{ $editdata->registration_city }}" required placeholder="Registration City" name="registration_city">
        </div>
        <div class="col-12 col-lg-4">
            <label for="InputYear" class="form-label">Province</label>
            <input type="text" class="form-control" value="{{ $editdata->province }}" required placeholder="Province " name="province">
        </div>
        <div class="col-12 col-lg-4">
                                        <label for="InputImage" class="form-label">Vehicle Image</label>
                                        <input class="form-control" type="file" name="image" required>
                                    </div>
    </div>

                                <div class="col-12 mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-light px-4">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Stepper -->
    </div>
</div>

{{-- Hidden form fields for future use --}}
{{-- 
    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputHorsePower" class="form-label">Vehicle Horse Power</label>
            <input type="number" class="form-control" name="horse_power" value="{{ $editdata->horse_power }}">
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputTraccarId" class="form-label">Traccar Device Id</label>
            <input type="text" class="form-control" placeholder="Id" name="traccar_device_id" value="{{ $editdata->traccar_device_id }}">
        </div>
        <div class="col-12 col-lg-4">
            <label for="InputVin" class="form-label">VIN</label>
            <input type="text" class="form-control" placeholder="VIN" name="vin" value="{{ $editdata->vin }}">
        </div>
        <div class="col-12 col-lg-4">
            <label for="InputYear" class="form-label">Vehicle Year</label>
            <input type="text" class="form-control" name="year" value="{{ $editdata->year }}">
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputAvgKm" class="form-label">Average (Km Per Gallon)</label>
            <input type="number" class="form-control" name="average_km_per_gallon" value="{{ $editdata->average_km_per_gallon }}">
        </div>
        <div class="col-12 col-lg-4">
            <label for="InputLicenseExpiry" class="form-label">License Expiry Date</label>
            <input type="date" class="form-control" name="license_expiry_date" value="{{ $editdata->license_expiry_date }}">
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <label for="InputVehicleGroup" class="form-label">Select Vehicle Group</label>
            <select class="form-select" name="group_id">
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ $editdata->group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
--}}

@endsection
