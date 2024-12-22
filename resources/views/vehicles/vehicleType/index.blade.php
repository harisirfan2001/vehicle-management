@extends('layouts.master')
@section('title', 'Vehicles Type ')
@section('content')

<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Vehicles Type</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"> Vehicles Type</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn"><a href="{{route('vehicle-types.create')}}" class="btn btn-light">Add Type</a></button>
							
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				
				
				<h6 class="mb-0 text-uppercase"> Vehicles Type </h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Vehicles Type </th>
										<th>Display Name</th>
										<th>Seats</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($indexdata as $item)
									<tr>
										<td>{{$item->id}}</td>
										<td>{{$item->vehicle_type}}</td>
										<td>{{$item->display_name}}</td>
										<td>{{$item->seats}}</td>
										<td class="d-flex align-items-center">
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown">
            <li>
                <a href="{{ route('vehicle-types.edit', $item->id) }}" class="dropdown-item text-light">Edit</a>
            </li>
            <li>
                <form action="{{ route('vehicle-types.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-light" onclick="return confirm('Are you sure you want to delete this item?')">
                        Delete
                    </button>
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