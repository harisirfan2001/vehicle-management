@extends('layouts.master')
@section('title', 'Add Type')
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
            <div class="breadcrumb-title pe-3">Types</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Type</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn"><a href="{{route('vehicle-types.index')}}" class="btn btn-light">View Types</a></button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <!--start stepper one-->
        <h6 class="text-uppercase">Add Types</h6>
        <hr>
        <div id="stepper1" class="bs-stepper">
            <div class="card">
                <div class="card-body">
                    <div class="bs-stepper-content">
                        <form action="{{ route('vehicle-types.store') }}" method="POST">
                            @csrf
                            <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                <h5 class="mb-1">Add Types</h5>
                                <div class="row g-3">
                                    <div class="row g-3">
                                        <div class="col-12 col-lg-4">
                                            <label for="vehicle_type" class="form-label">Vehicle Types</label>
                                            <input type="text" class="form-control" placeholder="Vehicle Type" name="vehicle_type" id="vehicle_type">
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="display_name" class="form-label">Display Name</label>
                                            <input type="text" class="form-control" placeholder="Display Name" name="display_name" id="display_name">
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="seats" class="form-label">Seats</label>
                                            <select class="form-select" id="seats" aria-label="Default select example" name="seats">
                                                <option selected>Select Vehicle Seats</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                                <option value="3">Four</option>
                                                <option value="3">Five</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-3">
                                            <button type="submit" class="btn btn-light px-4">Submit</button>
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

@endsection
