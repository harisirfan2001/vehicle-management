@extends('layouts.master')
@section('title', 'Parwest Home')
@section('content')

<div class="page-wrapper">
			<div class="page-content">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Checked Out Vehicles</p>
										<h4 class="my-1">{{$data['counts']['total_checked_out_vehicles']}}</h4>
										<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>$34 Since last week</p>
									</div>
									<div class="widgets-icons ms-auto"><i class='bx bxs-wallet'></i>
									</div>
								</div>
								<!-- <div id="chart1"></div> -->
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total Vehicles</p>
										<h4 class="my-1">{{$data['counts']['total_vehicles']}}</h4>
										<p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>14% Since last week</p>
									</div>
									<div class="widgets-icons ms-auto"><i class='bx bxs-group'></i>
									</div>
								</div>
								<!-- <div id="chart2"></div> -->
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total Gate Passes</p>
										<h4 class="my-1">{{$data['counts']['total_gate_passes']}}</h4>
										<p class="mb-0 font-13"><i class='bx bxs-down-arrow align-middle'></i>12.4% Since last week</p>
									</div>
									<div class="widgets-icons ms-auto"><i class='bx bxs-binoculars'></i>
									</div>
								</div>
								<!-- <div id="chart3"></div> -->
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total Drivers</p>
										<h4 class="my-1">{{$data['counts']['total_drivers']}}</h4>
										<p class="mb-0 font-13"><i class='bx bxs-down-arrow align-middle'></i>12.4% Since last week</p>
									</div>
									<div class="widgets-icons ms-auto"><i class='bx bxs-binoculars'></i>
									</div>
								</div>
								<!-- <div id="chart3"></div> -->
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
				<div class="row row-cols-1 row-cols-xl-2">
					<div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-1">Checked Out Gate Passes</h5>
									</div>
								</div>
								<div class="table-responsive mt-4">
									<table class="table align-middle mb-0 table-hover">
										<thead class="table-light">
											<tr>
												<th>Vehicle No</th>
												<th>Checked Out Date</th>
												<th>Checked Out Time</th>
												<th>Checked Out By</th>
												<th>Meter Out</th>
											</tr>
										</thead>
										<tbody>
											@foreach($data['table']['total_checkedout_passes'] as $pass)
											<tr>
												<td>{{$pass->vehicle_no}}</td>
												<td>{{Carbon\Carbon::parse($pass->date)->format('d-M-Y')}}</td>
												<td>{{Carbon\Carbon::parse($pass->time_out)->format('h:i A')}}</td>
												<td>{{$pass->checkedout_by->name}}</td>
												<td>{{$pass->meter_out}}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header border-bottom-0">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-1">Vehicles List</h5>
									</div>
								</div>
							</div>
							<div class="product-list p-3 mb-3">
								@foreach($data['table']['total_vehicle_driven'] as $vehicle)
								<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
									<div class="col-sm-6">
										<div class="d-flex align-items-center">
											<div class="product-img">
											<img id="myImage" src="{{ asset( $vehicle->image) }}" alt="Image" width="50"
											height="50" onclick="handleClick()"> 
												<!-- <img src="assets/images/icons/chair.png" alt="" /> -->
											</div>
											<div class="ms-2">
												<h6 class="mb-1">{{ $vehicle->licence_plate}}</h6>
												<p class="mb-0">{{ $vehicle->make->name }} {{ $vehicle->model->name}} </p>
											</div>
										</div>
									</div>
									<div class="col-sm">
										<h6 class="mb-1">{{$vehicle->totalCoverdKms()}} Km</h6>
										<p class="mb-0">Total Driven</p>
									</div>
									<div class="col-sm">
										<h6 class="mb-1">{{$vehicle->initial_mileage}} Km</h6>
										<p class="mb-0">Inital Reading</p>
									</div>
								</div>
								@endforeach								
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
				<!-- <div class="row">
					
					<div class="col-xl-4">
						<div class="card radius-10 overflow-hidden">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="">
										<p class="mb-1">Bounce Rate</p>
										<h4 class="mb-0">48.32%</h4>
									</div>
									<div class="ms-auto">
										<p class="mb-0 font-13 text-white">+12.34 Increase</p>
										<p class="mb-0 font-13">From Last Week</p>
									</div>
								</div>
							</div>
							<div id="chart12"></div>
						</div>
						<div class="card radius-10 overflow-hidden">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="">
										<p class="mb-1">Pageviews</p>
										<h4 class="mb-0">52.64%</h4>
									</div>
									<div class="ms-auto">
										<p class="mb-0 font-13 text-white">+21.34 Increase</p>
										<p class="mb-0 font-13">From Last Week</p>
									</div>
								</div>
							</div>
							<div id="chart13"></div>
						</div>
						<div class="card radius-10 overflow-hidden">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="">
										<p class="mb-1">New Sessions</p>
										<h4 class="mb-0">68.23%</h4>
									</div>
									<div class="ms-auto">
										<p class="mb-0 font-13 text-white">+18.42 Increase</p>
										<p class="mb-0 font-13">From Last Week</p>
									</div>
								</div>
							</div>
							<div id="chart14"></div>
						</div>
					</div>
				</div> -->
				<!--end row-->
				<!-- <div class="row row-cols-1 row-cols-lg-3">
					<div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-0">Top Categories</h5>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-5" id="chart15"></div>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Kids <span class="badge bg-light-white-2 rounded-pill">25</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Women <span class="badge bg-light-white-3 rounded-pill">10</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Men <span class="badge bg-white rounded-pill text-dark">65</span>
								</li>
								<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Furniture <span class="badge bg-light-white-4 text-white rounded-pill">14</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<p class="font-weight-bold mb-1">Visitors</p>
								<div class="d-flex align-items-center">
									<div>
										<h4 class="mb-0">43,540</h4>
									</div>
									<div class="">
										<p class="mb-0 align-self-center font-weight-bold ms-2">4.4 <i class='bx bxs-up-arrow-alt mr-2'></i>
										</p>
									</div>
								</div>
								<div id="chart21"></div>
							</div>
						</div>
					</div>
					<div class="col d-flex">
						<div class="card radius-10 w-100 overflow-hidden">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-0">Sales Overiew</h5>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-5" id="chart20"></div>
							</div>
							<div class="card-footer bg-transparent border-top-0">
								<div class="d-flex align-items-center justify-content-between text-center">
									<div>
										<h6 class="mb-1 font-weight-bold">$289.42</h6>
										<p class="mb-0">Last Week</p>
									</div>
									<div class="mb-1">
										<h6 class="mb-1 font-weight-bold">$856.14</h6>
										<p class="mb-0">Last Month</p>
									</div>
									<div>
										<h6 class="mb-1 font-weight-bold">$987,25</h6>
										<p class="mb-0">Last Year</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<!--end row-->
				<!-- <div class="row">
					<div class="col-12 col-xl-6 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header border-bottom">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-0">New Customers</h5>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="customers-list p-3 mb-3">
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Emy Jackson</h6>
										<p class="mb-0 font-13">emy_jac@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-4.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Martin Hughes</h6>
										<p class="mb-0 font-13">martin.hug@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-23.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Laura Madison</h6>
										<p class="mb-0 font-13">laura_01@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-24.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Shoan Stephen</h6>
										<p class="mb-0 font-13">s.stephen@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-20.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Keate Medona</h6>
										<p class="mb-0 font-13">Keate@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-16.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Paul Benn</h6>
										<p class="mb-0 font-13">pauly.b@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-25.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Winslet Maya</h6>
										<p class="mb-0 font-13">winslet_02@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-11.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Bruno Bernard</h6>
										<p class="mb-0 font-13">bruno.b@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-17.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Merlyn Dona</h6>
										<p class="mb-0 font-13">merlyn.d@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
								<div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
									<div class="">
										<img src="assets/images/avatars/avatar-7.png" class="rounded-circle" width="46" height="46" alt="" />
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Alister Campel</h6>
										<p class="mb-0 font-13">alister_42@xyz.com</p>
									</div>
									<div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
										<a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-xl-6 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header border-bottom">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-0">Orders Summary</h5>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="row m-0 row-cols-1 row-cols-md-3">
									<div class="col border-end">
										<div id="chart16"></div>
									</div>
									<div class="col border-end">
										<div id="chart17"></div>
									</div>
									<div class="col">
										<div id="chart18"></div>
									</div>
								</div>
								<div id="chart19"></div>
							</div>
						</div>
					</div>
				</div> -->
				<!--end row-->
				
			</div>
		</div>
	
		
    <div class="welcome-message" id="welcomeMessage">
        Welcome back, {{ Auth::user()->name }}!
    </div>

	@if (session('notifications'))
    @foreach (session('notifications') as $notification)
        <div class="alert alert-info">
            {{ $notification->data['message'] }}
        </div>
    @endforeach
@endif

  


	<style>
    .welcome-message {
        position: fixed;
        bottom: 20px; 
        right: -300px; 
        background-color: #28a745; 
        color: white; 
        padding: 10px 20px; 
        border-radius: 5px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        z-index: 1000; 
        opacity: 0; 
        transition: right 0.5s ease, opacity 0.5s ease; 
    }

    .welcome-message.show {
        right: 20px; 
        opacity: 1; 
    }

    .welcome-message.hide {
        right: -300px; 
        opacity: 0; 
    }
</style>

<script>
	
    document.addEventListener("DOMContentLoaded", function() {
        var welcomeMessage = document.getElementById('welcomeMessage');
        welcomeMessage.classList.add('show');

        setTimeout(function() {
            welcomeMessage.classList.remove('show');
            welcomeMessage.classList.add('hide');
        }, 7000); 

        welcomeMessage.addEventListener('transitionend', function() {
            if (welcomeMessage.classList.contains('hide')) {
                welcomeMessage.remove();
            }
        });
    });
</script>
<!-- JavaScript for Notifications -->
<script>
    // Ensure Echo is already configured with Pusher in your `bootstrap.js` file
    window.Echo.channel('superadmin-channel')
        .listen('GatePassRequested', (e) => {
            displayBannerNotification(e.userName, e.gatePassId);
        });

    // Function to display the notification banner
    function displayBannerNotification(userName, gatePassId) {
        // Create the notification banner
        const banner = document.createElement('div');
        banner.className = 'notification-banner';
        banner.innerHTML = `
            <p>${userName} has requested gate pass approval.</p>
            <button onclick="approveGatePass(${gatePassId})" class="approve-btn">Approve</button>
            <button onclick="rejectGatePass(${gatePassId})" class="reject-btn">Reject</button>
        `;
        document.body.appendChild(banner);

        // Add animation to slide in from the side
        setTimeout(() => banner.classList.add('show'), 100);
    }

    // Functions to handle approval and rejection
    function approveGatePass(gatePassId) {
        fetch(`/gatepass/approve/${gatePassId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ approved: true })
        }).then(response => {
            if (response.ok) {
                alert('Gate pass approved!');
                removeBannerNotification(gatePassId);
            }
        });
    }

    function rejectGatePass(gatePassId) {
        fetch(`/gatepass/reject/${gatePassId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ approved: false })
        }).then(response => {
            if (response.ok) {
                alert('Gate pass rejected.');
                removeBannerNotification(gatePassId);
            }
        });
    }

    // Remove the banner notification
    function removeBannerNotification(gatePassId) {
        const banner = document.querySelector(`.notification-banner[data-id='${gatePassId}']`);
        if (banner) {
            banner.classList.remove('show');
            setTimeout(() => banner.remove(), 300);  // Delay to allow transition out
        }
    }
</script>

<!-- Styling for the Notification Banner -->
<style>
    .notification-banner {
        position: fixed;
        top: 20px;
        right: -300px;
        width: 250px;
        background-color: #f8d7da;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: right 0.3s ease;
        z-index: 1000;
    }
    .notification-banner.show {
        right: 20px;
    }
    .notification-banner p {
        margin: 0;
        font-size: 14px;
        color: #721c24;
    }
    .notification-banner button {
        margin-top: 10px;
        padding: 5px 10px;
        font-size: 12px;
        cursor: pointer;
    }
    .approve-btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 4px;
    }
    .reject-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 4px;
        margin-left: 10px;
    }
</style>



@endsection
