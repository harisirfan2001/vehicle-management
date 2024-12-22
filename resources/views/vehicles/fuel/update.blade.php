@extends('layouts.master')
@section('title', 'Update Fueling')
@section('content')

@section('head')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
@endsection


<div class="page-wrapper">
    <div class="page-content">
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
            <div class="breadcrumb-title pe-3">Update Fuel</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Fuel</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn"><a href="{{ route('fuel.index') }}" class="btn btn-light">View History</a></button>
                </div>
            </div>
        </div>

        <h6 class="text-uppercase">Update Fuel </h6>
        <hr>

        <div id="stepper1" class="bs-stepper ">
            <div class="card">
                <div class="card-body">
                    <div class="bs-stepper-content">
                        <form action="{{ route('fuel.update', $fueling->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-3">Update Fuel Details</h5>

                            <div class="row g-3 mb-3">
                            <div class="col-lg-4">
    <label for="vehicleNo" class="form-label">Select Vehicle No</label>
    <select class="form-select select2" id="vehicleNo" required name="vehicle_no">
        <option value="">Select Vehicle</option>
        @foreach($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}" {{ $fueling->vehicle_no == $vehicle->id ? 'selected' : '' }}>
                {{ $vehicle->licence_plate }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-lg-4">
    <label for="driverName" class="form-label">Select Driver Name</label>
    <select class="form-select select2" id="driverName" required name="driver_name">
        <option value="">Select Driver</option>
        @foreach ($drivers as $d)
            <option value="{{ $d->id }}" {{ $fueling->driver_name == $d->id ? 'selected' : '' }}>
                {{ $d->full_name }}
            </option>
        @endforeach
    </select>
</div>

                                <div class="col-lg-4">
                                    <label class="form-label">Meter Reading On Refilling</label>
                                    <input type="text" class="form-control" oninput="meterLimit(this)" name="meter_reading_on_refilling" value="{{ old('meter_reading_on_refilling', $fueling->meter_reading_on_refilling) }}" placeholder="Start">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-lg-3">
                                    <label class="form-label">Fuel Type</label>
                                    <select class="form-select select2" name="fuel_type">
                                        <option selected disabled>Select Fuel Type</option>
                                        <option value="Petrol" {{ $fueling->fuel_type == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                        <option value="Diesel" {{ $fueling->fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="CNG" {{ $fueling->fuel_type == 'CNG' ? 'selected' : '' }}>CNG</option>
                                        <option value="Electric" {{ $fueling->fuel_type == 'Electric' ? 'selected' : '' }}>Electric</option>
                                        <option value="Hybrid" {{ $fueling->fuel_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        <option value="LPG" {{ $fueling->fuel_type == 'LPG' ? 'selected' : '' }}>LPG</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <label class="form-label">Current Fuel Mileage</label>
                                    <input type="number" step="0.01" oninput="meterLimit(this)" class="form-control" name="current_fuel_status" value="{{ old('current_fuel_status', $fueling->current_fuel_status) }}" placeholder="Current Fuel Status">
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label">Time</label>
                                    <input type="time" class="form-control" name="time" value="{{ old('time', $fueling->time) }}">
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" name="date" value="{{ old('date', $fueling->date) }}">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label">Fuel Cost/Ltr</label>
                                    <input type="number" step="0.01" class="form-control" name="fuel_cost" value="{{ old('fuel_cost', $fueling->fuel_cost) }}" placeholder="Fuel Cost/Ltr">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Total Fuel Qty</label>
                                    <input type="number" step="0.01" class="form-control" name="total_fuel_qty" value="{{ old('total_fuel_qty', $fueling->total_fuel_qty) }}" placeholder="Total Fuel Qty">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Total Price</label>
                                    <input type="number" step="0.01" class="form-control" name="total_price" value="{{ old('total_price', $fueling->total_price) }}" placeholder="Total Price">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label">Refilling Station</label>
                                    <input type="text" class="form-control" name="refilling_station" value="{{ old('refilling_station', $fueling->refilling_station) }}" placeholder="Refilling Station">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" value="{{ old('remarks', $fueling->remarks) }}" placeholder="Remarks">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Payment Mode</label>
                                    <select class="form-select select2" name="payment_mode">
                                        <option value="payment method">--Select Payment Method--</option>
                                        <option value="Cash" {{ $fueling->payment_mode == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Card" {{ $fueling->payment_mode == 'Card' ? 'selected' : '' }}>Card</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-lg-6">
                                    <label class="form-label">Fueling Slip Image</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                                <div class="col-lg-6 d-flex align-items-end">
                                    <button type="submit" class="btn btn-light px-4">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                minimumResultsForSearch: 5
            });
        });
        function meterLimit(input) {
            const pattern = /^\d{6}$/;
    
            if (!pattern.test(input.value)) {
                input.setCustomValidity("Input must be exactly 6 digits.");
            } else {
                input.setCustomValidity(''); 
            }
        }
    </script>

@endsection
