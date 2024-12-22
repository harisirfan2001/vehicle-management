@extends('layouts.master')
@section('title', 'New Gatepass')
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
                <div class="breadcrumb-title pe-3">Gate Pass</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Gate Pass</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn"><a href="{{ route('gate-passes.index') }}" class="btn btn-light">View
                                Gate Pass</a></button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <h6 class="text-uppercase">Add Gate Pass</h6>
            <hr>
            <div id="stepper1" class="bs-stepper">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-stepper-content">
                            <form action="{{ route('gate-passes.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane"
                                    aria-labelledby="stepper1trigger2">

                                    <h5 class="mb-1">Gate Pass Details</h5>

                                    <div class=" mb-4"></div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="gatePassNo" class="form-label">Gate Pass Number</label>
                                            <input type="text" class="form-control" required name="gate_pass_number"
                                                id="gatePassNo" readonly style="width: 150px;"
                                                value="{{ $nextGatePassNumber }}">
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                    <div class="col-12 col-lg-4">
                                            <label for="vehicleNo" class="form-label">Select Vehicle No</label>
                                            <select class="form-select" id="vehicleNo" required name="vehicle_no">
                                                <option selected disabled>Select Vehicle</option>
                                                @foreach ($vehicles as $vehicle)
                                                    @php
                                                        $disableVehicle =
                                                            $vehicle->gatePass &&
                                                            ($vehicle->gatePass->time_in === null ||
                                                                $vehicle->gatePass->time_out === null);
                                                    @endphp
                                                    <option value="{{ $vehicle->licence_plate }}"
                                                        {{ $disableVehicle ? 'disabled' : '' }}>
                                                        {{ $vehicle->licence_plate }}
                                                        @if ($disableVehicle)
                                                            (Currently Out)
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div> 


                                     





                                        <div class="col-12 col-lg-4">
                                            <label for="driverName" class="form-label">Select Driver Name</label>
                                            <select class="form-select" id="driverName" required name="driver_name">
                                                <option selected disabled>Select Driver</option>
                                                @foreach ($driver as $d)
                                                    <option value="{{ $d->full_name }}">{{ $d->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" class="form-control" required name="date"
                                                id="dateInput" max="">
                                        </div>

                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="meterOut" class="form-label">Meter Out</label>
                                            <input type="number" class="form-control" max="1000000" required name="meter_out"
                                                id="meterOut" oninput="validateMeterOut(this)">
                                        </div>

                                        {{-- <div class="col-12 col-lg-4">
                                            <label for="meterIn" class="form-label">Meter In</label>
                                            <input type="number" class="form-control" name="meter_in" id="meterIn"
                                                readonly oninput="calculateCoveredKm()">
                                        </div> --}}

                                        {{-- <div class="col-12 col-lg-4">
                                            <label for="coveredKm" class="form-label">Covered KM</label>
                                            <input type="text" class="form-control" name="covered_km" id="coveredKm"
                                                readonly>
                                        </div> --}}

                                        <div class="col-12 col-lg-4">
                                            <label for="timeOut" class="form-label">Time Out</label>
                                            <input type="time" class="form-control" required name="time_out"
                                                id="timeOut">
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="userOfficer" class="form-label">User Officer</label>
                                            <input type="text" class="form-control" required name="user_officer">
                                        </div>
                                    </div>

                                    {{-- <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-4">
                                            <label for="timeIn" class="form-label">Time In</label>
                                            <input type="time" class="form-control" name="time_in" id="timeIn"
                                                readonly oninput="calculateTotalTime()">
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="totalTime" class="form-label">Total Time (HH:MM)</label>
                                            <input type="text" class="form-control" name="total_time" id="totalTime"
                                                readonly>
                                        </div>
                                    </div> --}}

                                    <div class="row g-3 mb-3">


                                        <div class="col-12 col-lg-6">
                                            <label for="areaName" class="form-label">Area Name</label>
                                            <input type="text" class="form-control" required name="area_name">
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <label for="reasonToTravel" class="form-label">Reason to Travel</label>
                                            <input type="text" class="form-control" required name="reason_to_travel">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="passreceivername" class="form-label">Pass Receiver
                                                (Guard-Name)</label>
                                            <input type="text" class="form-control" name="pass_receiver">
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="passreceiverid" class="form-label"> Guard ID</label>
                                            <input type="text" class="form-control" name="pass_receiver_id">
                                        </div>
                                        <div class="col-12 col-lg-4">
                                        <label for="InputImage" class="form-label">Meter-out Image</label>
                                        <input class="form-control" type="file" name="meter_out_image">
                                    </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <button class="btn btn-light px-4">Submit</button>
                                        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('dateInput');
            const today = new Date().toISOString().split('T')[0]; 
            dateInput.value = today; 
            dateInput.max = today; 
        });

        window.onload = function() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('timeOut').value = hours + ':' + minutes;
        };

        function validateMeterOut(input) {
            const pattern = /^\d{6}$/;
    
            if (!pattern.test(input.value)) {
                input.setCustomValidity("Meter Out must be exactly 6 digits.");
            } else {
                input.setCustomValidity(''); 
            }
        }

        


    </script>

@push('footer-assets')
<script>
    $('#vehicleNo').change(function(){
            $.get('/vehicle/get-last-reading/'+this.value, function(response){
                console.log(response);
                var meterOutInput = $('#meterOut');
                meterOutInput.val('').attr("readonly", false);
                if(response.meter_in) {
                    meterOutInput.val(response.meter_in).attr("readonly", true);
                }
            });

        });
</script>
@endpush

@endsection
