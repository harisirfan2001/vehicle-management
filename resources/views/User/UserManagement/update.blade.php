@extends('layouts.master')
@section('title', 'Edit User')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn">
                        <a href="{{ route('manage-user.index') }}" class="btn btn-light">View Users</a>
                    </button>
                </div>
            </div>
        </div>

        <h6 class="text-uppercase mb-3">Edit User</h6>
        <hr>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('manage-user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-4">
                            <label for="InputName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $user->name }}" required>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="InputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email }}" required>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="InputPassword" class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter new password">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-4">
                            <label for="InputRole" class="form-label">Role</label>
                            <select class="form-control" name="role" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" 
                                    @if($user->hasRole($role->name)) selected @endif>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-light px-4">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
