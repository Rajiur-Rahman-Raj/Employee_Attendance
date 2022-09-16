@extends('layouts.dashboard')

{{-- title --}}
@section('title')
 {{ __('Employees') }}
@endsection


{{-- content --}}
@section('content')
<section class="banner-main-section py-5 all-pages-input" id="main">
    <div class="row">
        <div class="col-12">
            <h2 class="dash-ad-title m-0 mb-3">{{ __("Admin Dashboard") }} | <span class="dash-span-title">{{ __("Employee Details") }}</span></h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{ __(('Employee')) }} </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table  class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                             {{ __("Name") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_employee_details->name }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                             {{ __("Email") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_employee_details->email }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                             {{ __("Phone") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_employee_details->phone }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                             {{ __("Designation") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_employee_details->designation }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                             {{ __('Photo') }}
                                                        </th>
                                                        <td>
                                                            <img src="{{ asset('uploads/images/employee') }}/{{ $single_employee_details->photo }}" alt="not found" width="100" height="80">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                             {{ __("Status") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_employee_details->status }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                             {{ __("Created at") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_employee_details->created_at->format('d-m-Y') }}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            <a class="btn mt-1 btn-success" href="{{ route('employees.index') }}">{{ __("Return Back") }}</a>
                                            <a class="btn edit-btn mt-1 btn-primary" href="{{ route('employees.edit', $single_employee_details->id) }}">{{ __("Edit") }}</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection
