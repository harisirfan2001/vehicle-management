@extends('layouts.master')
@section('title', 'Add Driver')
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

            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Adding New Driver</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Driver</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn"><a href="{{ route('drivers.index') }}"
                                class="btn btn-light">View
                                History</a></button>
                    </div>
                </div>
            </div>
            <div class="row mt-4">


                <h6 class="text-uppercase">Add Driver</h6>
                <hr>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12 col-lg-4">
                                    <label class="form-label">Employee Number</label>
                                    <input type="text" class="form-control" name="employee_number"
                                        placeholder="Employee Number" required>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <label class="form-label">Father's Name</label>
                                    <input type="text" class="form-control" name="father_name"
                                        placeholder="Father's Name" required>
                                </div>
                            </div>

                            <div class="row g-4 mt-1">
                                <div class="col-12 col-lg-4">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" required>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <label class="form-label">CNIC #</label>
                                    <input type="text" class="form-control" name="cnic_number" placeholder="CNIC #" required>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <label class="form-label">Permanent Address</label>
                                    <input type="text" class="form-control" name="permanent_address"
                                        placeholder="Permanent Address" required>
                                </div>
                            </div>

                            <div class="row g-4 mt-1">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Temporary Address</label>
                                    <input type="text" class="form-control" name="temporary_address"
                                        placeholder="Temporary Address" required>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <label class="form-label">Contact #</label>
                                    <input type="text" class="form-control" name="contact_number[]"
                                        placeholder="Contact Number" required>
                                </div>
                                <div class="col-10 col-lg-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-success" id="addPhoneNumberBioData"
                                        style="background-color: transparent; border: none; color: white; transition: box-shadow 0.3s;">
                                        +
                                    </button>

                                    <style>
                                        #addPhoneNumberBioData {
                                            font-size: 1rem;
                                            /* Normal size */
                                        }

                                        #addPhoneNumberBioData:hover {
                                            box-shadow: 0 0 15px rgba(138, 238, 255, 0.7);
                                            color: #555;
                                            /* Optional: Change text color on hover */
                                        }
                                    </style>



                                </div>
                            </div>

                            <div id="phoneNumbersContainerBioData"></div>

                            <div class="row g-4 mt-1">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Blood Group</label>
                                    <select class="form-select" name="blood_group" required>
                                        <option value="">--Select Blood Group--</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Disability (if any)</label>
                                    <input type="text" class="form-control" name="disability" value="None" required>
                                </div>


                            </div>

                            <div class="row g-4 mt-1">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Emergency Contact Information</label>
                                    <input type="text" class="form-control" name="emergency_contact"
                                        placeholder="Emergency Contact" required>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Marital Status</label>
                                    <select class="form-select" name="marital_status" required>
                                        <option value="">--Select Marital Status--</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-4 mt-1">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Health Certificate</label>
                                    <input type="file" class="form-control" name="health_certificate" required>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Driver Photo</label>
                                    <input type="file" class="form-control" name="driver_photo" required>
                                </div>

                            </div>
                            <div class="row g-4 mt-1">

                                <div class="col-12 col-lg-6">
                                    <label class="form-label">License (Front and Back)</label>
                                    <input type="file" class="form-control" name="license_images[]" multiple
                                        accept="image/*" required>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label class="form-label">CNIC (Front and Back)</label>
                                    <input type="file" class="form-control" name="cnic_images[]" multiple
                                        accept="image/*" required>
                                </div>
                            </div>


                            <div class="row mt-4">
                            </div>
                    </div>
                </div>
                <div class="mt-3"></div>
                <h6 class="text-uppercase mt-4" id="referenceHeading">Add References</h6>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12 col-lg-4 mt-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="reference_name[]"
                                    placeholder="Reference Name" required>
                            </div>

                            <div class="col-12 col-lg-4 mt-3">
                                <label class="form-label">Relationship to Applicant</label>
                                <input type="text" class="form-control" name="relationship[]"
                                    placeholder="Relationship" required>
                            </div>

                            <div class="col-12 col-lg-4 mt-3">
                                <label class="form-label">Contact #</label>
                                <input type="text" class="form-control" name="reference_contact[]"
                                    placeholder="Contact Number" required>
                            </div>

                            <div class="col-12 col-lg-4 mt-3">
                                <label class="form-label">CNIC Number</label>
                                <input type="text" class="form-control" name="reference_cnic[]"
                                    placeholder="CNIC Number" required>
                            </div>

                            <div class="col-12 col-lg-4 mt-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="reference_address[]"
                                    placeholder="Address" required>
                            </div>
                        </div>
                        <div id="referencesContainer"></div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="button" class="btn btn-success" id="addReference">+ Add Another
                                    Reference</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-light px-4">Submit</button>
                    </div>
                    </form>
                    <div class="mb-4"></div>
                </div>

                <script>
                    // Phone Number Related Code

                    let phoneNumberCount = 2;

                    document.getElementById('addPhoneNumberBioData').addEventListener('click', function() {
                        let phoneContainer = document.getElementById('phoneNumbersContainerBioData');
                        let newInput = document.createElement('div');
                        newInput.classList.add('row', 'g-4', 'mt-1');

                        newInput.innerHTML = `
        <div class="col-12 col-lg-4">
            <label class="form-label">Contact # ${phoneNumberCount}</label>
            <input type="text" class="form-control" name="contact_number[]" placeholder="Contact Number" required>
        </div>
        <div class="col-auto align-self-end">
            <button type="button" class="btn btn-success remove-phone" style="background-color: transparent; border: none; color: white; transition: box-shadow 0.3s;">
                Remove
            </button>
            <style>
                .remove-phone {
                    background-color: transparent;
                    border: none;
                    color: white;
                    transition: box-shadow 0.3s;
                    font-size: 1rem;
                }
                .remove-phone:hover {
                    box-shadow: 0 0 15px rgba(138, 238, 255, 0.7);
                    color: white;
                }
            </style>
        </div>
    `;
                        phoneContainer.appendChild(newInput);
                        phoneNumberCount++;

                        newInput.querySelector('.remove-phone').addEventListener('click', function() {
                            phoneContainer.removeChild(newInput);
                            phoneNumberCount--;
                            updateLabels();
                        });
                    });

                    function updateLabels() {
                        const labels = document.querySelectorAll('#phoneNumbersContainerBioData .form-label');

                        labels.forEach((label, index) => {
                            label.textContent = `Contact #${index + 2}`;
                        });
                    }

                    // Reference Related Code
                    let referenceCount = 1;

                    document.getElementById('addReference').addEventListener('click', function() {
                        let referencesContainer = document.getElementById('referencesContainer');
                        let newReference = document.createElement('div');
                        newReference.classList.add('row', 'g-4', 'mt-2');

                        newReference.innerHTML = `
        <h6 class="text-uppercase mt-4 reference-heading">Reference #${referenceCount}</h6>
        <hr>
        <div class="col-12 col-lg-4 mt-2">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="reference_name[]" placeholder="Reference Name" required>
        </div>
        <div class="col-12 col-lg-4 mt-3">
            <label class="form-label">Relationship to Applicant</label>
            <input type="text" class="form-control" name="relationship[]" placeholder="Relationship" required>
        </div>
        <div class="col-12 col-lg-4 mt-3">
            <label class="form-label">Contact #</label>
            <input type="text" class="form-control" name="reference_contact[]" placeholder="Contact Number" required>
        </div>
        <div class="col-12 col-lg-4 mt-3">
            <label class="form-label">CNIC Number</label>
            <input type="text" class="form-control" name="reference_cnic[]" placeholder="CNIC Number" required>
        </div>
        <div class="col-12 col-lg-4 mt-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="reference_address[]" placeholder="Address" required>
        </div>
        <div class="col-auto align-self-end">
            <button type="button" class="btn btn-danger remove-reference" style="background-color: transparent; border: none; color: white; transition: box-shadow 0.3s; font-size: 1rem;">
                Remove Reference
            </button>
        </div>
    `;

                        referencesContainer.appendChild(newReference);
                        referenceCount++;

                        // Event listener to remove the reference and update headings
                        newReference.querySelector('.remove-reference').addEventListener('click', function() {
                            referencesContainer.removeChild(newReference);
                            referenceCount--;
                            updateReferenceHeading();
                        });

                        updateReferenceHeading();

                        // if (referenceCount >= 3) {
                        //     document.getElementById('addReference').disabled = true;
                        // }
                    });

                    function updateReferenceHeading() {
                        const referenceHeadings = document.querySelectorAll('.reference-heading');

                        referenceHeadings.forEach((heading, index) => {
                            heading.textContent = `Reference #${index + 2}`;
                        });

                        // if (referenceHeadings.length < 4) {
                        //     document.getElementById('addReference').disabled = false;
                        // } else {
                        //     document.getElementById('addReference').disabled = true;
                        // }
                    }

                    // Format phone numbers for biodata
                    document.addEventListener('DOMContentLoaded', function() {
                        function formatPhoneNumber(input) {
                            input.addEventListener('input', function() {
                                let value = input.value.replace(/\D/g, '');
                                if (value.length > 4) {
                                    value = value.slice(0, 4) + '-' + value.slice(4);
                                }
                                input.value = value;
                                if (input.value.length > 12) {
                                    alert('Phone Number must not exceed 11 characters.');
                                    input.value = input.value.slice(0, 11);
                                }
                            });

                            input.addEventListener('keydown', function(e) {
                                if (input.value.length >= 12 && e.key !== 'Backspace' && e.key !== 'Delete') {
                                    e.preventDefault();
                                }
                            });
                        }

                        document.querySelectorAll('input[name="contact_number[]"]').forEach(function(input) {
                            formatPhoneNumber(input);
                        });

                        document.getElementById('addPhoneNumberBioData').addEventListener('click', function() {
                            setTimeout(function() {
                                let newPhoneInputs = document.querySelectorAll(
                                    'input[name="contact_number[]"]');
                                let lastPhoneInput = newPhoneInputs[newPhoneInputs.length - 1];
                                formatPhoneNumber(lastPhoneInput);
                            }, 100);
                        });
                    });


                    document.addEventListener('DOMContentLoaded', function() {
                        function formatPhoneNumber(input) {
                            input.addEventListener('input', function() {
                                let value = input.value.replace(/\D/g, '');
                                if (value.length > 4) {
                                    value = value.slice(0, 4) + '-' + value.slice(4);
                                }
                                input.value = value;
                                if (input.value.length > 15) {
                                    alert('Phone Number must not exceed 11 characters.');
                                    input.value = input.value.slice(0, 12);
                                }
                            });

                            input.addEventListener('keydown', function(e) {
                                if (input.value.length >= 12 && e.key !== 'Backspace' && e.key !== 'Delete') {
                                    e.preventDefault();
                                }
                            });
                        };
                        document.querySelectorAll('input[name="reference_contact[]"]').forEach(function(input) {
                            formatPhoneNumber(input);
                        })


                        // CNIC Format for References
                        function formatCnic(input) {
                            input.addEventListener('input', function() {
                            let value = input.value.replace(/\D/g, '');
                            if (value.length > 5) {
                                value = value.slice(0, 5) + '-' + value.slice(5);
                            }
                            if (value.length > 13) {
                                value = value.slice(0, 13) + '-' + value.slice(13, 14);
                            }
                            input.value = value;

                            if (input.value.length > 15) {
                                alert('CNIC must not exceed 13 characters.');
                                input.value = input.value.slice(0, 15);
                            }
                        });

                        input.addEventListener('keydown', function(e) {
                            if (input.value.length >= 15 && e.key !== 'Backspace' && e.key !== 'Delete') {
                                e.preventDefault();
                            }
                        });
                    }

                    document.querySelectorAll('input[name="reference_cnic[]"]').forEach(function(input) {
                        formatCnic(input);
                    });

                    document.getElementById('addReference').addEventListener('click', function() {
                        setTimeout(function() {
                            let newCnicInputs = document.querySelectorAll('input[name="reference_cnic[]"]');
                            let lastCnicInput = newCnicInputs[newCnicInputs.length - 1];
                            formatCnic(lastCnicInput);
                        }, 100);
                    });

                    document.getElementById('addReference').addEventListener('click', function() {
                        setTimeout(function() {
                            let newReferenceInputs = document.querySelectorAll(
                                'input[name="reference_contact[]"]');
                            let lastReferenceInput = newReferenceInputs[newReferenceInputs.length - 1];
                            formatPhoneNumber(lastReferenceInput);
                        }, 100);
                    });
                });
                    // Function to format CNIC input
                    function cnicnumber(input) {
                        input.addEventListener('input', function() {
                            let value = input.value.replace(/\D/g, '');
                            if (value.length > 5) {
                                value = value.slice(0, 5) + '-' + value.slice(5);
                            }
                            if (value.length > 13) {
                                value = value.slice(0, 13) + '-' + value.slice(13, 14);
                            }
                            input.value = value;
                        });
                    };

                    const cnicInput = document.querySelector('input[name="cnic_number"]');
                    if (cnicInput) {
                        cnicnumber(cnicInput);
                    }


                    // Function to format emergency contact number
                    function formatEmergencyContact(inputemergency) {
                        inputemergency.addEventListener('input', function() {
                            let value = inputemergency.value.replace(/\D/g, '');
                            if (value.length > 4) {
                                value = value.slice(0, 4) + '-' + value.slice(4);
                            }
                            inputemergency.value = value;


                            if (inputemergency.value.length > 12) {
                                alert('Emergency contact number must not exceed 12 characters.');
                                inputemergency.value = inputemergency.value.slice(0, 12);
                            }
                        });

                        inputemergency.addEventListener('keydown', function(e) {
                            if (inputemergency.value.length >= 12 && e.key !== 'Backspace' && e.key !== 'Delete') {
                                e.preventDefault();
                            }
                        });
                    }

                    document.querySelectorAll('input[name="emergency_contact"]').forEach(function(input) {
                        formatEmergencyContact(input);
                    });
                </script>
              @if(session('success'))
              <script>
                  alert("{{ session('success') }}");
              </script>
          @endif


            @endsection
