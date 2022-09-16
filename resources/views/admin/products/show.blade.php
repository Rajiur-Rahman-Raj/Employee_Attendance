@extends('layouts.dashboard')

{{-- title --}}
@section('title')
 {{ __('Products') }}
@endsection


{{-- content --}}
@section('content')
<section class="banner-main-section py-5 all-pages-input" id="main">
    <div class="row">
        <div class="col-12">
            <h2 class="dash-ad-title m-0 mb-3">{{ __("Admin Dashboard") }} | <span class="dash-span-title">{{ __("Product Details") }}</span></h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{ __(('Product')) }} </h4>
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
                                                            {{ $single_product_details->name }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                             {{ __("Price") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_product_details->price }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                             {{ __("Quantity") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_product_details->quantity }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                             {{ __("Short Desc") }}
                                                        </th>
                                                        <td>
                                                            {{ $single_product_details->short_desc }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                             {{ __('Long Description') }}
                                                        </th>
                                                        <td>
                                                            {{-- {!! $single_product_details->long_desc !!} --}}
                                                            {{ $single_product_details->long_desc }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>
                                                             {{ __('Photo') }}
                                                        </th>
                                                        <td>
                                                            <img src="{{ asset('uploads/products') }}/{{ $single_product_details->photo }}" alt="not found" width="100" height="80">
                                                        </td>
                                                    </tr>

                        

                                                    <tr>
                                                        <th>
                                                             {{ __("Created at") }}
                                                        </th>
                                                        <td>
                                                            {!! $single_product_details->created_at->format('d-m-Y') !!}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            <a class="btn mt-1 btn-success" href="{{ route('products.index') }}">{{ __("Return Back") }}</a>
                                            <a class="btn edit-btn mt-1 btn-primary" href="{{ route('products.edit', $single_product_details->id) }}">{{ __("Edit") }}</a>

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
