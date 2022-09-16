@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Employees
@endsection

{{-- Active Menu --}}
@section('employees.create')
    active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
     <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                Create Employee
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-12 col-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employee</h4>
                        {{-- @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif --}}
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employees.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name"> Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control"/>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email"> Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control"/>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="phone"> Phone </label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="form-control"/>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="designation"> Designation <span class="text-danger">*</span></label>
                                        <input type="text" name="designation" value="{{ old('designation') }}" id="designation" class="form-control"/>
                                        @error('designation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address"> Address <span class="text-danger">*</span></label>
                                        <textarea name="address" id="address" class="form-control" cols="3" rows="4"></textarea>
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
                                        <label for="photo"> Status <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="Deactive">Deactive</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection