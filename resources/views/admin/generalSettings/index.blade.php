@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | General Settings
@endsection

{{-- Active Menu --}}
@section('generalSettings')
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
                Gerneral Settings
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-7 col-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">General Settings</h4>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('generalSettings.update', $generalSettings->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="logo">Logo</label>
                                                <div class="custom-file">
                                                    <input type="file" name="logo" class="custom-file-input" id="logo">
                                                    <label class="custom-file-label" for="logo">Choose file</label>
                                                </div>
                                                @error('logo')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="{{ asset('uploads/generalSettings') }}/{{ generalSettings()->logo }}" style="max-height: 60px" alt="Not Found">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="favicon">Favicon</label>
                                                <div class="custom-file">
                                                    <input type="file" name="favicon" class="custom-file-input" id="favicon">
                                                    <label class="custom-file-label" for="favicon">Choose file</label>
                                                </div>
                                                @error('favicon')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="{{ asset('uploads/generalSettings') }}/{{ generalSettings()->favicon }}" style="max-height: 60px" alt="Not Found">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" value="{{ generalSettings()->address }}" id="address" class="form-control" placeholder="Enter address"/>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" name="email" value="{{ generalSettings()->email }}" id="email" class="form-control" placeholder="Enter email address"/>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="phone">Phone number</label>
                                        <input type="text" name="phone" value="{{ generalSettings()->phone }}" id="phone" class="form-control" placeholder="Enter phone number"/>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" value="{{ generalSettings()->meta_keywords }}" id="meta_keywords" class="form-control" placeholder="Enter meta keywords"/>
                                        @error('meta_keywords')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" name="meta_title" value="{{ generalSettings()->meta_title }}" id="meta_title" class="form-control" placeholder="Enter meta title"/>
                                        @error('meta_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <input type="text" name="meta_description" value="{{ generalSettings()->meta_description }}" id="meta_description" class="form-control" placeholder="Enter meta description"/>
                                        @error('meta_description')
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