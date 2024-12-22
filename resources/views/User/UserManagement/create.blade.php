@extends('layouts.master')
@section('title', 'Create User')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Management</div>
            <div class="ms-auto">
                <a href="{{ route('manage-user.index') }}" class="btn btn-light">View Users</a>
            </div>
        </div>

        <h6 class="text-uppercase mb-3">Create New User</h6>
        <hr>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('manage-user.store') }}" method="POST">
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <label for="InputName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="InputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
               
                        <div class="col-12 col-lg-6">
                            <label for="InputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        </div>
                            <div class="col-12 col-lg-6">
                            <label for="Role" class="form-label">Role</label>
                            <select name="role" id="Role" class="form-select" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-light px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
