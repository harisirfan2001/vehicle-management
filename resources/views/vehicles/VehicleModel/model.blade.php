@extends('layouts.master')
@section('title', 'Vehicle Models')
@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<script>
    $(document).ready(function() {
        // Function to fetch makes and populate the dropdown
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

        fetchMakes();

        // Handle model form submission
        $('#model-form').submit(function(e) {
            e.preventDefault();
            storeModel();
        });

        function storeModel() {
            let vehicleMakeId = $('#vehicle_make_id').val();
            let modelName = $('#model_name').val();
            let modelId = $('#modelId').val(); // Get the model ID if editing

            if (!vehicleMakeId || !modelName) {
                alert('Please select a vehicle make and enter a model name.');
                return;
            }

            // Determine the URL and method based on whether we're updating or creating
            let url = modelId ? `/vehicle-models/${modelId}` : "{{ route('vehicle-models.store') }}";
            let method = modelId ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    vehicle_make_id: vehicleMakeId,
                    name: modelName
                },
                success: function(response) {
                    alert('Vehicle model saved successfully.');
                    $('#model_name').val('');
                    $('#modelId').val(''); // Clear model ID after saving
                    $('#model-modal').modal('hide');
                    fetchModels();
                },
                error: function(xhr, status, error) {
                    console.error("Error storing model: ", xhr.responseText);
                }
            });
        }

        // Function to fetch models for displaying in the table
        function fetchModels() {
            $.ajax({
                url: "{{ route('vehicle-models.index') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var modelTableBody = $('#modelTable');
                    modelTableBody.empty();
                    response.forEach(function(model) {
                        var row = `
                            <tr>
                                <td>${model.id}</td>
                                <td>${model.name}</td>
                              <td>
    <div class="dropdown">
        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="z-index: 1050;">
            <li>
                <a href="#" class="dropdown-item" onclick="editModel(${model.id})">Edit</a>
            </li>
            <li>
                <a href="#" class="dropdown-item" onclick="deleteModel(${model.id})">Delete</a>
            </li>
        </ul>
    </div>
</td>

                            </tr>
                        `;
                        modelTableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching models: ", xhr.responseText);
                }
            });
        }

        // Function to fetch model data for editing
        window.editModel = function(id) {
            $.ajax({
                url: `/vehicle-models/${id}/edit`, // Adjust the route to fetch the model by ID
                type: 'GET',
                success: function(model) {
                    // Populate the form with the existing model data
                    $('#modelId').val(model.id); // Set the hidden field for the model ID
                    $('#vehicle_make_id').val(model.vehicle_make_id); // Set the vehicle make ID
                    $('#model_name').val(model.name); // Set the model name

                    // Open the modal
                    $('#model-modal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching model data: ", xhr.responseText);
                    alert('Failed to load model data. Please try again.');
                }
            });
        };

        // Delete model function
        window.deleteModel = function(id) {
            if (confirm("Are you sure you want to delete this model?")) {
                $.ajax({
                    url: `/vehicle-models/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        alert("Model deleted successfully!");
                        fetchModels();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting model: ", xhr.responseText);
                    }
                });
            }
        };

        // Initial fetch for models
        fetchModels();
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
                <div class="breadcrumb-title pe-3">Vehicle Model </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Vehicle Models</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                    <button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#model-modal">
                Add Vehcle Models
            </button>
                    </button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

    <!-- Vehicle Model Modal -->
    <div class="modal fade" id="model-modal" tabindex="-1" aria-labelledby="modelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                        <h4 class="modal-title">Add Vehicle Model</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                <div class="modal-body">
                    <form id="model-form">
                        @csrf
                        <input type="hidden" id="modelId" name="modelId" value="">

                        <!-- Vehicle Make Dropdown -->
                        <div class="mb-3">
                            <label for="vehicle_make_id" class="form-label">Vehicle Make</label>
                            <select class="form-select" id="vehicle_make_id" name="vehicle_make_id">
                                <option selected disabled>Select Vehicle Make</option>
                                <!-- Makes will be populated via AJAX -->
                            </select>
                        </div>

                        <!-- Vehicle Model Name Input -->
                        <div class="mb-3">
                            <label for="model_name" class="form-label">Vehicle Model Name</label>
                            <input type="text" class="form-control" id="model_name" name="name"
                                placeholder="Enter vehicle model name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="model-form">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicle Model Table -->
    <div class="mt-5">
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                <p class="mb-0">Record of Vehicles</p>
                    <h4 class="my-1">Models</h4>
                </div>
            </div>
            <table class="table table-dark table-hover mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Model</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="modelTable">
                
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<div class="mb-5"></div>

@endsection
