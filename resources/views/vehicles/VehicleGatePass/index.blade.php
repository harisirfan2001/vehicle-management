@extends('layouts.master')
@section('title', 'Gatepasses List')
@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 g-3">
                <div class="breadcrumb-title pe-3">GatePass Details</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ asset('javascript') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">GatePass History</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('gate-passes.create') }}" class="btn btn-light">Create New GatePass</a>

                    </div>
                    <div class="btn-group">
                        <a href="{{ route('exportdata') }}" class="btn btn-light">Export to Excel</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <h6 class="mb-0 text-uppercase">Vehicles in Motion</h6>
            <hr>
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" style="padding: 10px; width: 120px;">GatePass #</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Date</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Vehicle Number</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Driver Name</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Meter Out</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Meter In</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Covered KM</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Time Out</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Time In</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Total Time</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">User Officer</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Area Name</th>
                                    <th class="text-center" style="padding: 10px; width: 200px;">Reason to Travel</th>
                                    <th class="text-center" style="padding: 10px; width: 200px;">Pass Receiver (Check-Out)
                                    </th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Guard ID (Check-OUT)</th>
                                    <th class="text-center" style="padding: 10px; width: 200px;">Pass Receiver (Check-IN)
                                    </th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Guard ID (Check-IN)</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($indexdata as $item)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $item->gate_pass_number }}</td>
                                        <td class="text-center">{{ $item->date }}</td>
                                        <td class="text-center">{{ $item->vehicle_no }}</td>
                                        <td class="text-center">{{ $item->driver_name }}</td>
                                        <td class="text-center">{{ $item->meter_out }}</td>
                                        <td class="text-center" style="color: red">
                                            {{ $item->meter_in ?? 'Waiting for Check-in' }}</td>
                                        <td class="text-center" style="color: red">
                                            {{ $item->covered_km ?? 'Waiting for Check-in' }}</td>
                                        <td class="text-center">{{ $item->time_out }}</td>
                                        <td class="text-center" style="color: red">
                                            {{ $item->time_in ?? 'Waiting for Check-in' }}</td>
                                        <td class="text-center" style="color: red">
                                            {{ $item->total_time ?? 'Waiting for Check-in' }}</td>
                                        <td class="text-center">{{ $item->user_officer }}</td>
                                        <td class="text-center">{{ $item->area_name }}</td>
                                        <td class="text-center">{{ $item->reason_to_travel }}</td>
                                        <td class="text-center">{{ $item->pass_receiver }}</td>
                                        <td class="text-center">{{ $item->pass_receiver_id }}</td>
                                        <td class="text-center" style="color: red">
                                            {{ $item->pass_receiver_checkin ?? 'Waiting for Check-in' }}</td>
                                        <td class="text-center" style="color: red">
                                            {{ $item->pass_receiver_checkin_id ?? 'Waiting for Check-in' }}</td>
                                            <td class="d-flex align-items-center">
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle m-2" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown">
            @can('checkin gatepass')
            <li>
                <a class="dropdown-item" href="{{ route('checkingp', $item->id) }}">Check-In</a>
            </li>
            @endcan
            @can('edit gatepass')
            <li>
                <a class="dropdown-item" href="{{ route('gate-passes.edit', $item->id) }}">Edit</a>
            </li>
            @endcan
            @can('print gatepass')
            <li>
                <a class="dropdown-item" href="javascript:void(0);" onclick="printDataButton({{ $item->id }})">Print</a>
            </li>
            @endcan
            @can('delete gatepass')
            <li>
            <form action="{{ route('gate-passes.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to remove this item from the view?');">Delete</button>
                </form>
            </li>
            @endcan
            @can('remove gatepass')
            <li>
                <form action="{{ route('removegp', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to remove this item from the view?');">Remove</button>
                </form>
            </li>
            @endcan
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

            <!-- Checked IN Table -->
            <h6 class="mb-0 text-uppercase mt-5">Checked-in</h6>
            <hr>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" style="padding: 10px; width: 120px;">GatePass #</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Date</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Vehicle Number</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Driver Name</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Meter Out</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Meter In</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Covered KM</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Time Out</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Time In</th>
                                    <th class="text-center" style="padding: 10px; width: 100px;">Total Time</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">User Officer</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Area Name</th>
                                    <th class="text-center" style="padding: 10px; width: 200px;">Reason to Travel</th>
                                    <th class="text-center" style="padding: 10px; width: 200px;">Pass Receiver (Check-Out)
                                    </th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Guard ID (Check-OUT)</th>
                                    <th class="text-center" style="padding: 10px; width: 200px;">Pass Receiver (Check-IN)
                                    </th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Guard ID (Check-IN)</th>
                                    <th class="text-center" style="padding: 10px; width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkin as $items)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $items->gate_pass_number }}</td>
                                        <td class="text-center">{{ $items->date }}</td>
                                        <td class="text-center">{{ $items->vehicle_no }}</td>
                                        <td class="text-center">{{ $items->driver_name }}</td>
                                        <td class="text-center">{{ $items->meter_out }}</td>
                                        <td class="text-center">{{ $items->meter_in }}</td>
                                        <td class="text-center">{{ $items->covered_km }}</td>
                                        <td class="text-center">{{ $items->time_out }}</td>
                                        <td class="text-center">{{ $items->time_in }}</td>
                                        <td class="text-center">{{ $items->total_time }}</td>
                                        <td class="text-center">{{ $items->user_officer }}</td>
                                        <td class="text-center">{{ $items->area_name }}</td>
                                        <td class="text-center">{{ $items->reason_to_travel }}</td>
                                        <td class="text-center">{{ $items->pass_receiver }}</td>
                                        <td class="text-center">{{ $items->pass_receiver_id }}</td>
                                        <td class="text-center">{{ $items->pass_receiver_checkin }}</td>
                                        <td class="text-center">{{ $items->pass_receiver_checkin_id }}</td>
                                        <td class="d-flex align-items-center">
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle m-2" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown">
            @can('edit gatepass')
            <li>
                <a class="dropdown-item" href="{{ route('gate-passes.edit', $items->id) }}">Edit</a>
            </li>
            @endcan
            @can('print gatepass')
            <li>
                <a class="dropdown-item" href="javascript:void(0);" onclick="printCheckinButton({{ $items->id }})">Print</a>
            </li>
            @endcan
            @can('delete gatepass')
            <li>
            <form action="{{ route('gate-passes.destroy', $items->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to remove this item from the view?');">Delete</button>
                </form>
            </li>
            @endcan
            @can('remove gatepass')
            <li>
                <form action="{{ route('removegp', $items->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to remove this item from the view?');">Remove</button>
                </form>
            </li>
            @endcan
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

    <script>
        function printData(id, isCheckin = false) {
    var printWindow = window.open('', '', 'height=1169,width=827');
    var currentDate = new Date();
    var timestamp = currentDate.toLocaleString();

    printWindow.document.write(
        '<html><head><title>Print</title>' +
        '<style>' +
        'body { max-width: 827px; max-height: 1169px; } ' +
        '.watermark { position: absolute; top: 25%; left: 50%; width: 60%; height: auto; opacity: 0.04; transform: translate(-50%, -50%); z-index: -1; } ' +
        'p { margin: 0; } ' +
        '.logo { position: absolute; right: 25px; max-width: 70px; height: 70px; } ' +
        'table.main { width: 100%; border-collapse: collapse; } ' +
        'table.main td, table.main th, table.main tr { font-family: Calibri, sans-serif; }' +
        'td, th { padding: 7px; padding-left: 8px; vertical-align: top; border: 1px solid black; } ' +
        'td.left-align { text-align: left; font-weight: bold; } ' +
        'td.data { text-align: left; } ' +
        'td.border { text-align: left; border: none; width:auto;} ' +
        'tr { margin-left: 10px; } ' +
        '.underline { border-bottom: 1px solid #000; margin-bottom: 2px; } ' +
        'td, th { width: 50px; }' +
        '</style>' +
        '</head><body>'
    );

    printWindow.document.write(
        '<img src="/vehicles/PPS-Logo/pps_logo.png" alt="pps logo" class="logo">'
    );
    printWindow.document.write(
        '<img src="/vehicles/PPS-Logo/pps_logo.png" class="watermark">'
    );

    printWindow.document.write('<p><strong>Parwest Pacific Security (Pvt.) Ltd.</strong></p>');
    printWindow.document.write('<p>176, Street # 4, Cavalry Ground, Lahore Cantt. - Pakistan</p>');
    printWindow.document.write('<p>Tel: +92-42-36655166, 36654545, 36668549, Fax: +92-42-36654122</p>');
    printWindow.document.write('<p>Email: parwest@gmail.com</p>');
    printWindow.document.write(
        '<h2 style="text-align: center; font-weight: bold; text-decoration: underline;">Vehicle Gate Pass</h2>'
    );

    var item = isCheckin ? @json($checkin) : @json($indexdata);
    var data = item.find(i => i.id === id);
    console.log(data);
    var userName = 'N/A';
    var checkedInBy = 'N/A';
    if(data.created_by) {
        var userName = data.checkedout_by.name;
    }
    if(data.checkedin_by) {
        var checkedIn = data.checkedin_by.name;
    }


    printWindow.document.write('<table class="main">');
    printWindow.document.write('<tr>');
    printWindow.document.write(
        '<td colspan="0.5"><strong>Gatepass #</strong></td><td colspan="2.5" class="data underline">' + data.gate_pass_number + '</td>'
    );
    printWindow.document.write(
        '<td colspan="0.5"><strong>Date</strong></td><td colspan="5" class="data underline">' + data.date + '</td>'
    );
    printWindow.document.write('</tr>');

    printWindow.document.write('<tr>');
    printWindow.document.write(
        '<td colspan="0.5"><strong>Vehicle Number</strong></td><td colspan="2.5" class="data underline">' + data.vehicle_no + '</td>'
    );
    printWindow.document.write(
        '<td colspan="0.5"><strong>Driver Name</strong></td><td colspan="5" class="data underline">' + data.driver_name + '</td>'
    );
    printWindow.document.write('</tr>');

    printWindow.document.write('<tr>');
    printWindow.document.write('<td colspan="0.5"><strong>Meter Out</strong></td><td class="data underline">' + data.meter_out + '</td>');
    printWindow.document.write('<td colspan="0.5"><strong>Meter In</strong></td><td class="data underline">' + (isCheckin ? data.meter_in : '&nbsp;') + '</td>');
    printWindow.document.write('<td colspan="0.5"><strong>Covered KM</strong></td><td class="data underline">' + (isCheckin ? data.covered_km : '&nbsp;') + '</td>');
    printWindow.document.write('</tr>');

    printWindow.document.write('<tr>');
    printWindow.document.write('<td colspan="0.5"><strong>Time Out</strong></td><td class="data underline">' + data.time_out + '</td>');
    printWindow.document.write('<td colspan="0.5"><strong>Time In</strong></td><td class="data underline">' + (isCheckin ? data.time_in : '&nbsp;') + '</td>');
    printWindow.document.write('<td colspan="0.5"><strong>Total Hours</strong></td><td class="data underline">' + (isCheckin ? data.total_time : '&nbsp;') + '</td>');
    printWindow.document.write('</tr>');

    printWindow.document.write('<tr>');
    printWindow.document.write('<td colspan="0.5"><strong>User Officer</strong></td><td colspan="2.5" class="data underline">' + data.user_officer + '</td>');
    printWindow.document.write('<td colspan="0.5"><strong>Area Name</strong></td><td colspan="5" class="data underline">' + data.area_name + '</td>');
    printWindow.document.write('</tr>');

    printWindow.document.write('<tr>');
    printWindow.document.write('<td colspan="0.5"><strong>Reason to Travel</strong></td><td colspan="5" class="data underline">' + data.reason_to_travel + '</td>');
    printWindow.document.write('</tr>');

    printWindow.document.write('<tr>');
    printWindow.document.write(
        '<td colspan="0.5"><strong>Pass Receiver (Check-OUT)</strong></td><td colspan="2.5" class="data underline">' +
        data.pass_receiver_id + ' | ' + data.pass_receiver + '</td>'
    );
    printWindow.document.write(
        '<td colspan="0.5"><strong>Pass Receiver (Check-IN)</strong></td><td colspan="2.5" class="data underline">' +
        (isCheckin ? data.pass_receiver_checkin_id + ' | ' + data.pass_receiver_checkin : '&nbsp;') + '</td>'
    );
    printWindow.document.write('</tr>');

    printWindow.document.write('</table>');
    printWindow.document.write('<br>');

    printWindow.document.write('<table>');
    printWindow.document.write('<tr style="height: 50px;">');
    printWindow.document.write(
        '<td class="border" style="text-align: left; font-family: Calibri, sans-serif;"><strong>Signature Vehicle User</strong></td><td style="padding-right: 50px;" class="border">_________________</td>'
    );
    printWindow.document.write(
        '<td class="border" style="text-align: right; padding-left: 50px; font-family: Calibri, sans-serif;"><strong>Signature Authorized Officer</strong></td><td class="border">_________________</td>'
    );
    printWindow.document.write('</tr>');
    printWindow.document.write('</table>');

    printWindow.document.write('<br>');
    printWindow.document.write('<p style="text-align: left; font-size: 12px; font-family: Calibri, sans-serif;"><strong>Created by: </strong>' + userName + ' <strong>at:</strong> '+data.created_at+'</p>');
    printWindow.document.write('<p style="text-align: left; font-size: 12px; font-family: Calibri, sans-serif;"><strong>CheckedIn By: </strong>' + checkedIn + ' <strong>at:</strong> '+data.checkedin_at+'</p>');

    var images = printWindow.document.images;
    

    var loadedImages = 0;

    if (images.length === 0) {
        printWindow.document.close();
        printWindow.print();
    } else {
        for (var i = 0; i < images.length; i++) {
            images[i].onload = function () {
                loadedImages++;
                if (loadedImages === images.length) {
                    printWindow.document.close();
                    printWindow.print();
                }
            };

            images[i].onerror = function () {
                loadedImages++;
                if (loadedImages === images.length) {
                    printWindow.document.close();
                    printWindow.print();
                }
            };
        }
    }
}

function printDataButton(id) {
    printData(id, false);
}

function printCheckinButton(id) {
    printData(id, true);
}
    </script>
@endsection
