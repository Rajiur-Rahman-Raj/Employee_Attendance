@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ __('Products') }}
@endsection

@section('products.index')
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
            <li class="breadcrumb-item ">{{ __('Products') }}</li>
            <li class="breadcrumb-item active">
                <a href="{{ route('products.index') }}">{{ __('Product List') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ _('Update Product') }}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 col-12 m-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Update Product') }}</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical" action="{{ route('products.update', $single_product_info->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                                
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ $single_product_info->name }}" id="name" class="form-control"/>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <input type="text" name="price" value="{{ $single_product_info->price }}" id="price" class="form-control"/>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="text" name="quantity" value="{{ $single_product_info->quantity }}" id="quantity" class="form-control"/>
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="short_desc">Short Desc <span class="text-danger">*</span></label>
                                <textarea name="short_desc" id="short_desc" class="form-control" cols="3" rows="4">{{ $single_product_info->short_desc }}</textarea>
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="short_desc">Long Desc</label>
                                <textarea name="long_desc" id="long_desc" class="form-control" cols="3" rows="4">{{ $single_product_info->long_desc }}</textarea>
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="photo">Photo <span class="text-danger">*</span></label>
                                <input type="file" name="photo" class="form-control" id="photo">
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="photo">Preview </label>
                                <img src="{{ asset('uploads/products') }}/{{ $single_product_info->photo }}" alt="not found" width="100" height="80">
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
