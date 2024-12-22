@extends('layouts.master')
@section('title', 'Driver Details')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Driver Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Driver Data</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn">
                        <a href="{{ route('drivers.create') }}" class="btn btn-light">Add Driver</a>
                    </button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Drivers Details</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th style="padding: 15px;">ID</th>
                                <th style="padding: 15px;">Employee Number</th>
                                <th style="padding: 15px;">Full Name</th>
                                <th style="padding: 15px;">Father's Name</th>
                                <th style="padding: 15px;">Date of Birth</th>
                                <th style="padding: 15px;">CNIC #</th>
                                <th style="padding: 15px;">Permanent Address</th>
                                <th style="padding: 15px;">Temporary Address</th>
                                <th style="padding: 15px;">Contact Number</th>
                                <th style="padding: 15px;">Blood Group</th>
                                <th style="padding: 15px;">Disability</th>
                                <th style="padding: 15px;">Emergency Contact</th>
                                <th style="padding: 15px;">Marital Status</th>
                                <th style="padding: 15px;">Health Certificate</th>
                                <th style="padding: 15px;">Driver Photo</th>
                                <th style="padding: 15px;">License (Front and Back)</th>
                                <th style="padding: 15px;">CNIC (Front and Back)</th>
                                <th style="padding: 15px;">Reference Name</th>
                                <th style="padding: 15px;">Relationship to Applicant</th>
                                <th style="padding: 15px;">Reference Contact</th>
                                <th style="padding: 15px;">Reference CNIC</th>
                                <th style="padding: 15px;">Reference Address</th>
                                <th style="padding: 15px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indexdata as $driver)
                                <tr>

                                    <td>{{ $driver->id }}</td>
                                    <td>{{ $driver->employee_number }}</td>
                                    <td>{{ $driver->full_name }}</td>
                                    <td>{{ $driver->father_name }}</td>
                                    <td>{{ $driver->date_of_birth }}</td>
                                    <td>{{ $driver->cnic_number }}</td>
                                    <td>{{ $driver->permanent_address }}</td>
                                    <td>{{ $driver->temporary_address }}</td>
                                    <td>{{ $driver->contact_number }}</td>
                                    <td>{{ $driver->blood_group }}</td>
                                    <td>{{ $driver->disability }}</td>
                                    <td>{{ $driver->emergency_contact }}</td>
                                    <td>{{ $driver->marital_status }}</td>
                                    <td>
                                        <img src="{{ asset($driver->health_certificate) }}" alt="Health Certificate" width="50" height="50">
                                    </td>
                                    <td>
                                        <img src="{{ asset($driver->driver_photo) }}" alt="Driver Photo" width="50" height="50">
                                    </td>
                                    <td>
                                        @php
                                            $licenseImages = explode(',', $driver->license_images);
                                        @endphp
                                    
                                        @if (!empty($licenseImages) && count($licenseImages) > 0)
                                            @foreach ($licenseImages as $image)
                                                <img src="{{ asset($image) }}" alt="License Image" width="50" height="50">
                                            @endforeach
                                        @else
                                            <span>No License Images</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @php
                                            $cnicImages = explode(',', $driver->cnic_images);
                                        @endphp
                                    
                                        @if (!empty($cnicImages) && count($cnicImages) > 0)
                                            @foreach ($cnicImages as $image)
                                                <img src="{{ asset($image) }}" alt="CNIC Image" width="50" height="50">
                                            @endforeach
                                        @else
                                            <span>No CNIC Images</span>
                                        @endif
                                    </td>
                                    
                                    <td>{{ $driver->reference_name }}</td>
                                    <td>{{ $driver->relationship }}</td>
                                    <td>{{ $driver->reference_contact }}</td>
                                    <td>{{ $driver->reference_cnic }}</td>
                                    <td>{{ $driver->reference_address }}</td>
                                    <td class="d-flex align-items-center">
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
                <a class="dropdown-item" href="{{ route('drivers.edit', $driver->id) }}">Edit</a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('drivers.destroy', $driver->id) }}" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this driver?')) { document.getElementById('delete-driver-{{ $driver->id }}').submit(); }">Delete</a>
                <form id="delete-driver-{{ $driver->id }}" action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
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
