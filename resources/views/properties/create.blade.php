@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New property') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="property_district" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                                <input id="property_district" type="text" class="form-control @error('property_district') is-invalid @enderror" name="property_district" value="{{ old('property_district') }}" required autocomplete="property_district" autofocus>

                                @error('property_district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="property_county" class="col-md-4 col-form-label text-md-right">{{ __('County') }}</label>

                            <div class="col-md-6">
                                <input id="property_county" type="text" class="form-control @error('property_county') is-invalid @enderror" name="property_county" value="{{ old('property_county') }}" required autocomplete="property_county">

                                @error('property_county')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="property_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="property_address" type="text" class="form-control @error('property_address') is-invalid @enderror" name="property_address" value="{{ old('property_address') }}" required autocomplete="property_address">

                                @error('property_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="property_year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                            <div class="col-md-6">
                                <input id="property_year" type="text" class="form-control @error('property_year') is-invalid @enderror" name="property_year" value="{{ old('property_year') }}" required autocomplete="property_year">

                                @error('property_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="property_sqm" class="col-md-4 col-form-label text-md-right">{{ __('Square metres') }}</label>

                            <div class="col-md-6">
                                <input id="property_sqm" type="text" class="form-control @error('property_sqm') is-invalid @enderror" name="property_sqm" value="{{ old('property_sqm') }}" required autocomplete="property_sqm">

                                @error('property_sqm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="property_type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                            <div class="col-md-6">
                                 <select class="custom-select" name="property_type" id="property_type">
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Industrial">Industrial</option>
                                    <option value="Land">Land</option>   
                                </select>                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="property_description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input style="height:100px" id="property_description" type="text" class="form-control  @error('property_description') is-invalid @enderror" name="property_description" value="{{ old('property_description') }}" required autocomplete="property_description">

                                @error('property_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="property_price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="property_price" type="text" class="form-control @error('property_price') is-invalid @enderror" name="property_price" value="{{ old('property_price') }}" required autocomplete="property_price">

                                @error('property_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn bg-warning text-dark border border-dark rounded font-weight-bold">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection