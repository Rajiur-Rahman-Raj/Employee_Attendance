@extends('layouts.emp_dashboard.master')
@section('emp_dashboard')
    active
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">

                        <div class="col-xl-12 col-md-6 col-12">
                            <div class="card mt-2 congratulations">
                                <div class="card-body text-center">
                                    <img src="{{ asset('uploads/employee_dashboard/decore-left.png') }}" class="congrates_img-left" alt="decore-left.png">
                                    <img src="{{ asset('uploads/employee_dashboard/decore-right.png') }}" class="congrates_img-right" alt="decore-right.png">
                                    <div class="congrates_avatar">
                                        <div class="congrates_avatar-icon">
                                            @php
                                                $emp_login_info = App\Models\Attendance::where('name',$emp_info->name)->latest()->first();
                                            @endphp

                                            @if ($emp_login_info)    
                                                @if ($emp_login_info->status == 'login')
                                                    
                                                    <a class="attendance-login-icon login-btn d-none" data-name='{{ $emp_info->name }}' data-designation='{{ $emp_info->designation }}'>
                                                        <i data-feather='log-in'></i>
                                                    </a>
                                                    
                                                    <a class="attendance-logout-icon logout-btn" data-name='{{ $emp_info->name }}' data-designation='{{ $emp_info->designation }}'>
                                                        <i data-feather='log-out'></i>
                                                    </a>
                                                @else
                                                    <a class="attendance-login-icon login-btn" data-name='{{ $emp_info->name }}' data-designation='{{ $emp_info->designation }}'>
                                                        <i data-feather='log-in'></i>
                                                    </a>
                                                    
                                                    <a class="attendance-logout-icon logout-btn d-none" data-name='{{ $emp_info->name }}' data-designation='{{ $emp_info->designation }}'>
                                                        <i data-feather='log-out'></i>
                                                    </a>
                                                @endif
                                            @else
                                                <a class="attendance-login-icon login-btn " data-name='{{ $emp_info->name }}' data-designation='{{ $emp_info->designation }}'>
                                                    <i data-feather='log-in'></i>
                                                </a>
                                                
                                                <a class="attendance-logout-icon logout-btn d-none" data-name='{{ $emp_info->name }}' data-designation='{{ $emp_info->designation }}'>
                                                    <i data-feather='log-out'></i>
                                                </a> 
                                            @endif
                                            {{-- <i class="fa-solid fa-award congrates__icon"></i> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="card-text">
                                        <h3 class="card-text_heading text-white">{{ _('Welcome') }}</h3>
                                        <p class="text-white">{{ __('You are logged in into your dahsboard!') }}</p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        

                        <!-- Statistics Card -->
                        {{-- <div class="col-xl-12 col-md-6 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Statistics</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-primary mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">230k</h4>
                                                    <p class="card-text font-small-3 mb-0">Sales</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-info mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">8.549k</h4>
                                                    <p class="card-text font-small-3 mb-0">Customers</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="media">
                                                <div class="avatar bg-light-danger mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="box" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">1.423k</h4>
                                                    <p class="card-text font-small-3 mb-0">Products</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="media">
                                                <div class="avatar bg-light-success mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">$9745</h4>
                                                    <p class="card-text font-small-3 mb-0">Revenue</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!--/ Statistics Card -->

                        <!-- Attendance Analytics -->
                        <div class="col-xl-12 col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Your Attendance Analyticks') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div id="chart_emp_attendance"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Attendance Analytics -->
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('custom_js')
    {{-- emp login logout button --}}
    <script>
        $(document).ready(function(){
            $('.login-btn').click(function(){

                let emp_name          = $('.login-btn').attr('data-name');
                let emp_designation   = $('.login-btn').attr('data-designation');
                
                $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('emp.attendance.login') }}",
                    data: {
                        emp_name: emp_name,
                        emp_designation: emp_designation,
                    },
                    success: function (response) {
                        console.log(response);
                        if(response.status == 200){
                            toastr.success(response.message);
                            $('.login-btn').addClass('d-none');
                            $('.logout-btn').removeClass('d-none');
                        }else{
                            toastr.error(response.message);
                            $('.login-btn').addClass('d-none');
                            $('.logout-btn').removeClass('d-none');
                        }
                        
                    },

                    error: function (response) {

                    }
                });
                
            });



            $('.logout-btn').click(function(){
                $('.login-btn').removeClass('d-none');
                $('.logout-btn').addClass('d-none');

                let emp_name          = $('.login-btn').attr('data-name');
                let emp_designation   = $('.login-btn').attr('data-designation');
                
                $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('emp.attendance.logout') }}",
                    data: {
                        emp_name: emp_name,
                        emp_designation: emp_designation,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status == 200) {
                            toastr.success(response.message);
                            $('.login-btn').removeClass('d-none');
                            $('.logout-btn').addClass('d-none');
                        } else {
                            toastr.error(response.message);
                            $('.login-btn').removeClass('d-none');
                            $('.logout-btn').addClass('d-none');
                        }
                        
                    },

                    error: function (response) {

                    }
                });
            });

        });
    </script>

    <script>
        var options = {
            series: [{
                name: 'Total Attendance',
                data: @json($total_attendance)
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
            },
            dataLabels: {
                enabled: true,
            },

            stroke: {
                show: true,
                width:1,
                // colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            fill: {
                opacity: 0.8
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart_emp_attendance"), options);
        chart.render();
    </script>
@endsection
    
