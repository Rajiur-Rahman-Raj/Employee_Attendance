@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Employees
@endsection

{{-- Active Menu --}}
@section('employees.index')
    active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0"> Admin Dashboard </h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"> Home </a>
            </li>
            <li class="breadcrumb-item active">
                Employees
            </li>
        </ol>
    </div>
@endsection

{{-- Main Content --}}
@section('content')
<div class="row" id="basic-table">
    <div class="col-md-12 col-12 m-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Employee List </h4>
                {{-- @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">{{ session('warning') }}</div>
                @endif --}}
                <div class="col-md-6 text-right">
                    <a class="btn btn-info" href="{{ route('employees.create') }}">{{ __('Create Employee') }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="data_table">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->designation }}</td>
                                <td>
                                    <img src="{{ asset('uploads/images/employee') }}/{{ $employee->photo }}" alt="not found" height="80" width="100">
                                </td>
                                <td>{{ $employee->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('employees.show', $employee->id) }}">
                                                <i data-feather="eye" class="mr-50"></i>
                                                <span>Show</span>
                                            </a>

                                            <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">
                                                <i data-feather="edit" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>

                                            <a class="dropdown-item" data-toggle="modal" data-target="#employeeModal{{ $employee->id }}">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @push('all_modals')
                                <!-- Delete Modal -->
                            <div class="modal fade" id="employeeModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> {{ __('Employee') }} </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            {{ __("Are You Sure Delete Employee?") }}
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">{{ __("Delete") }}</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endpush  

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection