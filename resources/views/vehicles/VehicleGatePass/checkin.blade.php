@extends('layouts.master')
@section('title', 'Confirm Checkin')
@section('content')

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
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Gate Pass</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gatepass Details</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn"><a href="{{ route('gate-passes.index') }}" class="btn btn-light">View
                                Gatepass</a></button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <h6 class="text-uppercase">Confirm Check-IN Gatepass</h6>
            <hr>
            <div id="stepper1" class="bs-stepper">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-stepper-content">
                            <form action="{{ route('gate-passes.update', $editdata->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane"
                                    aria-labelledby="stepper1trigger2">

                                    <h5 class="mb-1">Confirm Vehicle Check-IN</h5>

                                    <div class=" mb-4"></div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="gatePassNo" class="form-label">Gate Pass Number</label>
                                            <input type="text" class="form-control" name="gate_pass_number"
                                                id="gatePassNo" value="{{ $editdata->gate_pass_number }}" readonly
                                                style="width: 150px;">
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-12 col-lg-4">
                                            <label for="vehicleNo" class="form-label">Select Vehicle No</label>
                                            <select class="form-select" id="vehicleNo" name="vehicle_no" disabled>
                                                <option value="{{ $editdata->vehicle_no }}">{{ $editdata->vehicle_no }}
                                                </option>
                                            </select>
                                            <input type="hidden" id="vehicleNo" name="vehicle_no"
                                                value="{{ $editdata->vehicle_no }}">
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="driverName" class="form-label">Select Driver Name</label>
                                            <select class="form-select" id="driverName" name="driver_name" disabled>
                                                <option value="{{ $editdata->driver_name }}">{{ $editdata->driver_name }}
                                                </option>
                                            </select>
                                            <input type="hidden" id="driver_name" name="driver_name"
                                                value="{{ $editdata->driver_name }}">

                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" class="form-control" name="date" readonly
                                                value="{{ $editdata->date }}">
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="meterOut" class="form-label">Meter Out</label>
                                            <input type="number" class="form-control" readonly name="meter_out"
                                                id="meterOut" value="{{ $editdata->meter_out }}"
                                                oninput="calculateCoveredKm()">
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="meterIn" class="form-label">Meter In</label>
                                            <input type="number" class="form-control" name="meter_in" id="meterIn"
                                                oninput="calculateCoveredKm(),  validateMeterIn(this)" onblur="meterInLimit()" max="1000000">
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="coveredKm" class="form-label">Covered KM</label>
                                            <input type="number" class="form-control" name="covered_km" id="coveredKm"
                                                value="{{ $editdata->covered_km }}" readonly>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="timeOut" class="form-label">Time Out</label>
                                            <input type="time" class="form-control" readonly name="time_out"
                                                id="timeOut" value="{{ $editdata->time_out }}"
                                                oninput="calculateTotalTime()">
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="timeIn" class="form-label">Time In</label>
                                            <input type="time" class="form-control" required name="time_in"
                                                id="timeIn" oninput="calculateTotalTime()">
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="totalTime" class="form-label">Total Time (HH:MM)</label>
                                            <input type="text" class="form-control" name="total_time" id="totalTime"
                                                value="{{ $editdata->total_time }}" readonly>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="userOfficer" class="form-label">User Officer</label>
                                            <input type="text" class="form-control" readonly name="user_officer"
                                                value="{{ $editdata->user_officer }}">
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="areaName" class="form-label">Area Name</label>
                                            <input type="text" class="form-control" readonly name="area_name"
                                                value="{{ $editdata->area_name }}">
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label for="reasonToTravel" class="form-label">Reason to Travel</label>
                                            <input type="text" class="form-control" readonly name="reason_to_travel"
                                                value="{{ $editdata->reason_to_travel }}">
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="reasonToTravel" class="form-label">Remarks</label>
                                            <input type="text" class="form-control" name="remarks"
                                                value="{{ $editdata->remarks }}" required>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">

                                        <div class="col-12 col-lg-4">
                                            <label for="passreceivername" class="form-label">Pass Receiver Guard Name
                                                (Check-In)</label>
                                            <input type="text" class="form-control" required
                                                placeholder="Enter Guardname" name="pass_receiver_checkin">
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="passreceivername" class="form-label">Pass Receiver Guard ID
                                                (Check-In)</label>
                                            <input type="text" class="form-control" required
                                                placeholder="Enter Guard ID" name="pass_receiver_checkin_id">
                                  </div>
                                        
                                    <div class="col-12 col-lg-4">
                                        <label for="InputImage" class="form-label">Meter-in Image</label>
                                        <input class="form-control" type="file" name="meter_in_image">
                                    </div>
                                        <div class="col-12 col-lg-4">
                                            <input type="hidden" class="form-control" required
                                                placeholder="Enter Guardname" name="pass_receiver"
                                                value="{{ $editdata->pass_receiver }}">
                                        </div>
                                        <div class="col-12 col-lg-4">

                                            <input type="hidden" class="form-control" required
                                                placeholder="Enter Guard ID" name="pass_receiver_id"
                                                value="{{ $editdata->pass_receiver_id }}">
                                        </div>
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
            document.getElementById('timeIn').value = hours + ':' + minutes;
        };
        window.onload = function() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('timeIn').value = hours + ':' + minutes;

            // Manually trigger the time calculation
            calculateTotalTime();
        };
    </script>


    <script>
        function calculateCoveredKm() {
            const meterOut = parseFloat(document.getElementById('meterOut').value) || 0;
            const meterIn = parseFloat(document.getElementById('meterIn').value) || 0;
            document.getElementById('coveredKm').value = meterIn - meterOut;
        }

        function calculateTotalTime() {
            const timeOut = document.getElementById('timeOut').value;
            const timeIn = document.getElementById('timeIn').value;

            if (timeOut && timeIn) {
                const [hoursOut, minutesOut] = timeOut.split(':').map(Number);
                const [hoursIn, minutesIn] = timeIn.split(':').map(Number);

                let totalMinutes = (hoursIn * 60 + minutesIn) - (hoursOut * 60 + minutesOut);
                if (totalMinutes < 0) totalMinutes += 24 * 60;

                const totalHours = Math.floor(totalMinutes / 60);
                const remainingMinutes = totalMinutes % 60;

                document.getElementById('totalTime').value =
                    `${totalHours}:${remainingMinutes.toString().padStart(2, '0')}`;
            }
        }

        function meterInLimit() {
    const limitIn = Number(document.getElementById('meterIn').value);    
    const limitOut = Number(document.getElementById('meterOut').value);  

 
    if (limitIn < limitOut) { 
        alert('Meter In cannot be less than or equal to Meter Out');  
        document.getElementById('meterIn').value = 0; 
    }
    
}
function validateMeterIn(input) {
        const pattern = /^\d{6}$/;

        if (!pattern.test(input.value)) {
            input.setCustomValidity("Meter In must be exactly 6 digits");
        } else {
            input.setCustomValidity('');
        }
    }


    </script>

@endsection
