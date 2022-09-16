@extends('layouts.emp_dashboard.master')

@section('emp_attendance_list')
    active
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row ml-0">
            {{-- Breadcrumb Start --}}
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">{{ __('Employee Attendance') }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('emp.dashboard') }}">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('emp.attendance.list', $name) }}">{{ __('Attendance') }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    {{ __('List') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Breadcrumb End --}}
            </div>

            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                        <!-- Statistics Card -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="card card-statistics shadow mb-4">
                            {{-- <div class="card-header">
                                    <div class="float-right d-inline">
                                        <a href="{{ route('document.generate.create') }}" class="btn btn-success mr-1">
                                            <i class="bi bi-plus"></i> {{ __('Create Document Form') }}
                                        </a>
                                    </div>
                                </div> --}}

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SL') }}</th>
                                                <th>{{ __('Emp Name') }}</th>
                                                <th>{{ __('Designation') }}</th>
                                                <th>{{ __('Check In') }}</th>
                                                <th>{{ __('Check Out') }}</th>
                                                {{-- <th>{{ __('Action') }}</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($emp_attendance_infos as $emp_attendance_info)               
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $emp_attendance_info->name }}</td>
                                                    <td>{{ $emp_attendance_info->designation }}</td>
                                                    <td>{{ Carbon\Carbon::Parse($emp_attendance_info->check_in)->format('d-M-Y') }} ({{ Carbon\Carbon::Parse($emp_attendance_info->check_in)->format('h:i a') }})</td>
                                                    @if ($emp_attendance_info->check_out == null)
                                                        <td>
                                                            <span class="badge badge-danger">{{ __('No check out today') }}</span>
                                                        </td>
                                                    @else
                                                        <td>{{ Carbon\Carbon::Parse($emp_attendance_info->check_out)->format('d-M-Y') }} ({{ Carbon\Carbon::Parse($emp_attendance_info->check_out)->format('h:i a') }})</td>
                                                    @endif
                                                    {{-- <td></td> --}}
                                                </tr>
                                            @endforeach
                                            {{-- Carbon::Parse($emp_info->check_in)->format('Y-m-d'); --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection