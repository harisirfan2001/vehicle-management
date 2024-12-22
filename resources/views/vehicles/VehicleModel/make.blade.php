<!-- Make Blade File: resources/views/vehicle/make.blade.php -->

@extends('layouts.master')
@section('title', 'Vehicle Makes')
@section('content')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <div class="page-wrapper">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    @if ($errors->any())
    <div class="alert alert-muted">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="breadcrumb-title pe-3">Vehicle Makes </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Vehicle Makes</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                    <button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#make-modal">
                        Add Vehicle Makes
                    </button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

           <div class="modal fade" id="make-modal" tabindex="-1" aria-labelledby="makeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Vehicle Make</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="make-form">
                            @csrf
                            <input type="hidden" id="makeId" name="makeId" value="">
                            <div class="mb-3">
                                <label for="make_name" class="form-label">Vehicle Make Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter vehicle make name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="make-form">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Make Table -->
        <div class="row">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Record of Vehicles</p>
                            <h4 class="my-1">Makes</h4>
                        </div>
                    </div>
                    <table class="table table-dark table-hover mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Make</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="makeTable">
                            <!-- Data will be appended here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function fetchMakes() {
                $.ajax({
                    url: "{{ route('vehicle-makes.index') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var tableBody = $('#makeTable');
                        tableBody.empty();
                        response.forEach(function(make, index) {
                            var row = `
                            <tr id="makeRow-${make.id}">
                                <td>${index + 1}</td>
                                <td>${make.name}</td>
                              <td class="d-flex justify-content-between">
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="z-index: 1050;">
            <li>
                <a href="#" class="dropdown-item update-btn" data-id="${make.id}">Update</a>
            </li>
            <li>
                <a href="#" class="dropdown-item" onclick="deleteMake(event, ${make.id})">Delete</a>
            </li>
        </ul>
    </div>
</td>

                            </tr>
                        `;
                            tableBody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error in fetchMakes: " + status + " - " + error);
                    }
                });
            }

            fetchMakes();

            $('#make-form').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var id = $('#makeId').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var url = id ? `/vehicle-makes/${id}` : "{{ route('vehicle-makes.store') }}";
                var type = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: type,
                    data: formData + `&_token=${csrfToken}`,
                    success: function() {
                        alert('Vehicle Make saved Successfully!');
                        $('#makeId').val('');
                        $('#make-modal').modal('hide');
                        fetchMakes();
                        $('#make-form')[0].reset();
                        $('.modal-title').text('Add Vehicle Make');

                    },
                    error: function() {
                        alert("There is an error while saving the make.");
                    }
                });
            });

            $(document).on('click', '.update-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: `/vehicle-makes/${id}/edit`,
                    type: 'GET',
                    success: function(data) {
                        $('#make-modal').modal('show');
                        $('#name').val(data.name);
                        $('#makeId').val(data.id);
                        $('.modal-title').text('Update Vehicle Make');
                    },
                    error: function() {
                        console.error("Error fetching make details.");
                    }
                });
            });

            window.deleteMake = function(event, id) {
                event.preventDefault();
                if (confirm("Are you sure you want to delete this vehicle make?")) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: `/vehicle-makes/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: csrfToken
                        },
                        success: function() {
                            alert("Vehicle make deleted successfully!");
                            fetchMakes();
                        },
                        error: function() {
                            console.error("Error deleting vehicle make.");
                        }
                    });
                }
            };
        });
    </script>
<div class="mb-5"></div>
@endsection
