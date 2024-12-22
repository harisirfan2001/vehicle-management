@extends('layouts.master')
@section('title', 'Fueling List')
@section('content')

<style>
    table tr {
        text-align: center;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Fuel History</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fuel History</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn"><a href="{{ route('fuel.create') }}" class="btn btn-light">Add Fuel</a></button>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <h6 class="mb-0 text-uppercase">Fuel History</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vehicle Number </th>
                                <th>Driver Name</th>
                                <th>Meter Reading On Refilling</th>
                                <th>Fuel Type</th>
                                <th>Current Fuel Status</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Fuel Cost/ltr</th>
                                <th>Total Fuel Quantity</th>
                                <th>Total Price</th>
                                <th>Refilling Station</th>
                                <th>Remarks</th>
                                <th>Payment Method</th>
                                <th>Slip Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getmodule as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $vehicles->firstWhere('id', $item->vehicle_no)->licence_plate ?? 'N/A' }}</td>
                                    <td>{{ $drivers->firstWhere('id', $item->driver_name)->full_name ?? 'N/A' }}</td>
                                    <td>{{ $item->meter_reading_on_refilling }}</td>
                                    <td>{{ $item->fuel_type }}</td>
                                    <td>{{ $item->current_fuel_status }}</td>
                                    <td>{{ $item->time }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->fuel_cost }}</td>
                                    <td>{{ $item->total_fuel_qty }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>{{ $item->refilling_station }}</td>
                                    <td>{{ $item->remarks }}</td>
                                    <td>{{ $item->payment_mode }}</td>
                                    <td>
                                        <img src="{{ asset($item->file) }}" alt="Image" width="50" height="50" onclick="handleClick()">
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="{{ route('fuel.edit', $item->id) }}">Edit</a></li>
                                                <li>
                                                    <form method="POST" action="{{ route('fuel.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                    </form>
                                                </li>
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
