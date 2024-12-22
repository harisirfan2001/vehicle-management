@extends('layouts.master')
@section('title', 'Vehicle Varients')
@section('content')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <script>
        $(document).ready(function() {
            function fetchMakes() {
                $.ajax({
                    url: "{{ route('vehicle-makes.index') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var makeDropdown = $('#vehicle_make_id');
                        makeDropdown.empty();
                        makeDropdown.append('<option selected>Select Vehicle Make</option>');
                        response.forEach(function(make) {
                            var option = `<option value="${make.id}">${make.name}</option>`;
                            makeDropdown.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching makes: ", xhr.responseText);
                    }
                });
            }

            function fetchModels(makeId) {
                $.ajax({
                    url: "{{ route('vehicle-models.index') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var modelDropdown = $('#vehicle_model_id');
                        modelDropdown.empty();
                        modelDropdown.append('<option selected>Select Vehicle Model</option>');
                        response.forEach(function(model) {
                            var option = `<option value="${model.id}">${model.name}</option>`;
                            modelDropdown.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching models: ", xhr.responseText);
                    }
                });
            }
            fetchMakes();

            $('#vehicle_make_id').change(function() {
                var makeId = $(this).val();
                fetchModels(makeId);
            });

            $('#varient-form').submit(function(e) {
                e.preventDefault();
                storeVarient();
            });

            function storeVarient() {
                let vehicleMakeId = $('#vehicle_make_id').val();
                let vehicleModelId = $('#vehicle_model_id').val();
                let varientName = $('#varient_name').val();
                let varientId = $('#varientId').val();

                if (!vehicleMakeId || !vehicleModelId || !varientName) {
                    alert('Please select a vehicle make, model, and enter a Varient name.');
                    return;
                }

                let url = varientId ? `/vehicle-varients/${varientId}` : "{{ route('vehicle-varients.store') }}";
                let method = varientId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        vehicle_make_id: vehicleMakeId,
                        vehicle_model_id: vehicleModelId,
                        name: varientName
                    },
                    success: function(response) {
                        $('#varient-form').trigger('reset');

                        alert('Vehicle Varient saved successfully.');
                        $('#varient-modal').modal('hide');
                        fetchVarients();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error storing Varient: ", xhr.responseText);
                        console.log("Error storing Varient: ", xhr.responseText);
                        alert(
                            'Failed to save the vehicle Varient. Please try again.'
                        );
                    }
                });
            }

            function fetchVarients() {
                $.ajax({
                    url: "{{ route('vehicle-varients.index') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var varientTableBody = $('#varientTable');
                        varientTableBody.empty();
                        response.forEach(function(varient) {
                            var makeName = varient.vehicle_model.vehicle_make.name;
                            var modelName = varient.vehicle_model.name;

                            var row = `
                    <tr>
                        <td>${varient.id}</td>
                        <td>${makeName}</td>
                        <td>${modelName}</td>
                        <td>${varient.name}</td>
                       <td>
    <div class="dropdown">
        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="z-index: 1050;">
            <li>
                <a href="#" class="dropdown-item" onclick="editVarient(${varient.id})">Edit</a>
            </li>
            <li>
                <a href="#" class="dropdown-item" onclick="deleteVarient(${varient.id})">Delete</a>
            </li>
        </ul>
    </div>
</td>

                    </tr>
                `;
                            varientTableBody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching Varients: ", xhr.responseText);
                    }
                });
            }



            window.editVarient = function(id) {
                $.ajax({
                    url: `/vehicle-varients/${id}/edit`,
                    type: 'GET',
                    success: function(varient) {
                        $('#varientId').val(varient.id);
                        $('#vehicle_make_id').val(varient.vehicle_make_id);
                        $('#vehicle_model_id').val(varient.vehicle_model_id);
                        $('#varient_name').val(varient.name);
                        fetchModels(varient.vehicle_make_id);
                        $('#varient-modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching Varient data: ", xhr.responseText);
                        alert('Failed to load Varient data. Please try again.');
                    }
                });
            };

            window.deleteVarient = function(id) {
                if (confirm("Are you sure you want to delete this Varient?")) {
                    $.ajax({
                        url: `/vehicle-varients/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            alert("Varient deleted successfully!");
                            fetchVarients();
                        },
                        error: function(xhr, status, error) {
                            console.error("Error deleting Varient: ", xhr.responseText);
                        }
                    });
                }
            };

            fetchVarients();
        });
    </script>

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
                <div class="breadcrumb-title pe-3">Vehicle Varients </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Vehicle Varients</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                    <button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#varient-modal">
                    Add Vehicle Varients
                </button>
                    </button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

        <!-- Vehicle Varient Modal -->
        <div class="modal fade" id="varient-modal" tabindex="-1" aria-labelledby="varientModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Vehicle Varient</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="varient-form">
                            @csrf
                            <input type="hidden" id="varientId" name="varientId" value="">

                            <!-- Vehicle Make Dropdown -->
                            <div class="mb-3">
                                <label for="vehicle_make_id" class="form-label">Vehicle Make</label>
                                <select class="form-select" id="vehicle_make_id" name="vehicle_make_id">
                                    <option selected disabled>Select Vehicle Make</option>
                                    <!-- Makes will be populated via AJAX -->
                                </select>
                            </div>

                            <!-- Vehicle Model Dropdown -->
                            <div class="mb-3">
                                <label for="vehicle_model_id" class="form-label">Vehicle Model</label>
                                <select class="form-select" id="vehicle_model_id" name="vehicle_model_id">
                                    <option selected disabled>Select Vehicle Model</option>
                                    <!-- Models will be populated via AJAX -->
                                </select>
                            </div>

                            <!-- Vehicle Varient Name Input -->
                            <div class="mb-3">
                                <label for="varient_name" class="form-label">Vehicle Varient Name</label>
                                <input type="text" class="form-control" id="varient_name" name="name"
                                    placeholder="Enter vehicle Varient name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="varient-form">Save Varient</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicle Varients Table -->
        <div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <p class="mb-0">Record of Vehicles</p>
                <h4 class="my-1">Varients</h4>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="VarientTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Varient</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="varientTable">
                    <!-- Varients will be populated here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>
<div class="mb-5"></div>
@endsection
