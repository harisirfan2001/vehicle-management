@extends('layouts.master')
@section('title', 'Update Role')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Roles Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Role</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('manage-roles.index') }}" class="btn btn-light">View Roles</a>
                </div>
            </div>
        </div>

        <h6 class="text-uppercase mb-3">Edit Role</h6>
        <hr>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('manage-roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-4">
                            <label for="InputName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Role Name" value="{{ $role->name }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-light px-4">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
