@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ __('Employees') }}
@endsection

@section('employees.index')
    active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
     <h2 class="content-header-title float-left mb-0">{{ __('Admin Dashboard') }}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('Home') }}</a>
            </li>
            <li class="breadcrumb-item ">{{ __('Employees') }}</li>
            <li class="breadcrumb-item active">
                <a href="{{ route('employees.index') }}">{{ __('Employee List') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ _('Update Employee') }}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 col-12 m-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Update Employee') }}</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical" action="{{ route('employees.update', $single_employee_info->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                                
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name"> Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ $single_employee_info->name }}" id="name" class="form-control"/>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="email"> Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ $single_employee_info->email }}" id="email" class="form-control"/>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="phone"> Phone </label>
                                <input type="text" name="phone" value="{{ $single_employee_info->phone }}" id="phone" class="form-control"/>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="designation"> Designation <span class="text-danger">*</span></label>
                                <input type="text" name="designation" value="{{ $single_employee_info->designation }}" id="designation" class="form-control"/>
                                @error('designation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address"> Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="address" class="form-control" cols="3" rows="4">{{ $single_employee_info->address }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="photo"> Photo <span class="text-danger">*</span></label>
                                <input type="file" name="photo" class="form-control" id="photo"> 
                                @error('photo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="photo">Preview </label>
                                <img src="{{ asset('uploads/images/employee') }}/{{ $single_employee_info->photo }}" alt="not found" width="100" height="80">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="photo"> Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" {{ $single_employee_info->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Deactive" {{ $single_employee_info->status == 'Deactive' ? 'selected' : '' }}>Deactive</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

            
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mr-1">Update</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
