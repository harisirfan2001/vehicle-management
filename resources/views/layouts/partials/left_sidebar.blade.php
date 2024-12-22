<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="{{ route('dashboard') }}">
                <img src="/vehicles/PPS-Logo/pps_logo.png" class="logo-icon" alt="logo icon">
            </a>
        </div>
        <div>
            <h4 class="logo-text">Dashboard</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                <div class="menu-title">Home</div>
            </a>
        </li>

        <li class="menu-label">Vehicles</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-grid-alt"></i></div>
                <div class="menu-title">Drivers</div>
            </a>
            <ul>
                <li><a href="{{route('drivers.create')}}"><i class='bx bx-radio-circle'></i>Add Driver</a></li>
                <li><a href="{{route('drivers.index')}}"><i class='bx bx-radio-circle'></i>Drivers List</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-grid-alt"></i></div>
                <div class="menu-title">Gate Pass</div>
            </a>
            <ul>
                <li><a href="{{route('gate-passes.create')}}"><i class='bx bx-radio-circle'></i>Add Gatepass</a></li>
                <li><a href="{{route('gate-passes.index')}}"><i class='bx bx-radio-circle'></i>Gatepass List</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-grid-alt"></i></div>
                <div class="menu-title">Vehicles</div>
            </a>
            <ul>
                <li><a href="{{route('vehicle.create')}}"><i class='bx bx-radio-circle'></i>Add Vehicle</a></li>
                <li><a href="{{route('vehicle.index')}}"><i class='bx bx-radio-circle'></i>Vehicles List</a></li>

                <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                <li><a href="{{route('vehicle-makes.create')}}"><i class='bx bx-radio-circle'></i>Vehicle Makes</a></li>
                <li><a href="{{route('vehicle-models.create')}}"><i class='bx bx-radio-circle'></i>Vehicle Models</a></li>
                <li><a href="{{route('vehicle-varients.create')}}"><i class='bx bx-radio-circle'></i>Vehicle Varients</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-grid-alt"></i></div>
                <div class="menu-title">Vehicle Type</div>
            </a>
            <ul>
                <li><a href="{{route('vehicle-types.create')}}"><i class='bx bx-radio-circle'></i>Add Vehicle Type</a></li>
                <li><a href="{{route('vehicle-types.index')}}"><i class='bx bx-radio-circle'></i>Vehicle Type List</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-grid-alt"></i></div>
                <div class="menu-title">Fuel</div>
            </a>
            <ul>
                <li><a href="{{route('fuel.create')}}"><i class='bx bx-radio-circle'></i>Add Fueling</a></li>
                <li><a href="{{route('fuel.index')}}"><i class='bx bx-radio-circle'></i>Fueling List</a></li>
            </ul>
        </li>

        <!-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"></div>
                <div class="menu-title">Tags/Token</div>
            </a>
            <ul>
                <li><a href="#"><i class='bx bx-radio-circle'></i>E-Tags</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>M-Tags</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Token</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-lock'></i></div>
                <div class="menu-title">Parts</div>
            </a>
            <ul>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Add Parts</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Manage Parts</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-donate-blood'></i></div>
                <div class="menu-title">Reports</div>
            </a>
            <ul>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Report</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Vehicle Report</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Vehicle Type</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Vehicle Track</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Fuel Report</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>E-Tags Report</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>M-Tags Report</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Token Report</a></li>
                <li><a href="#"><i class='bx bx-radio-circle'></i>Parts Report</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-error'></i></div>
                <div class="menu-title">Notes</div>
            </a>
            <ul>
                <li><a href="errors-404-error.html" target="_blank"><i class='bx bx-radio-circle'></i>Manage Notes</a></li>
                <li><a href="errors-500-error.html" target="_blank"><i class='bx bx-radio-circle'></i>Create Notes</a></li>
            </ul>
        </li>

        <li class="menu-label">Charts & Maps</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-line-chart"></i></div>
                <div class="menu-title">Charts</div>
            </a>
            <ul>
                <li><a href="charts-apex-chart.html"><i class='bx bx-radio-circle'></i>Apex</a></li>
                <li><a href="charts-chartjs.html"><i class='bx bx-radio-circle'></i>Chartjs</a></li>
                <li><a href="charts-highcharts.html"><i class='bx bx-radio-circle'></i>Highcharts</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-map-alt"></i></div>
                <div class="menu-title">Maps</div>
            </a>
            <ul>
                <li><a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google Maps</a></li>
                <li><a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Vector Maps</a></li>
            </ul>
        </li>

        <li class="menu-label">Others</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-grid-alt"></i></div>
                <div class="menu-title">Menu Levels</div>
            </a>
            <ul>
                <li><a href="javascript:;"><i class="bx bx-radio-circle"></i>Level One</a></li>
                <li>
                    <a href="javascript:;" class="has-arrow"><i class="bx bx-radio-circle"></i>Level One</a>
                    <ul>
                        <li><a href="javascript:;"><i class="bx bx-radio-circle"></i>Level Two</a></li>
                        <li>
                            <a href="javascript:;" class="has-arrow"><i class="bx bx-radio-circle"></i>Level Two</a>
                            <ul>
                                <li><a href="javascript:;"><i class="bx bx-radio-circle"></i>Level Three</a></li>
                                <li><a href="javascript:;"><i class="bx bx-radio-circle"></i>Level Three</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="bx bx-radio-circle"></i>Level One</a></li>
            </ul> -->
        </li>
    </ul>
</div>
