@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Property') }} #{{ $property->property_id}}</div>

                @if (Session::has('message'))
                    <div class="alert alert-warning bg-warning text-dark">{{ Session::get('message') }}</div>
                @endif
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-5" style="text-align: center">
                            <p class="profile-img img-rounded img-responsive">{{ $property->property_description }}</p>
                        </div>
                        <div class="col-sm-6 col-md-7">
                            <h4><strong>{{ number_format($property->property_price, 0, '', '.') }}{{'€'}}</strong></h4>
                            <h5>{{ $property->property_district }}</h5>
                            <hr>
                            <p>
                                {{ $property->property_county }}<br>
                                <small>{{ $property->property_address }}</small>
                            </p> 
                            <hr>   
                            <p>
                                <strong>Type - </strong>{{ $property->property_type }}<br>
                                <strong>Square metres - </strong>{{ $property->property_sqm }}m<sup>2</sup>
                            </p>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection