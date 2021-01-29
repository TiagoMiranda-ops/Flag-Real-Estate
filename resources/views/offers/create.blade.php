@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New offer') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('offers.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="purchase_offer_status" class="col-md-4 col-form-label text-md-right">{{ __(' Default Status') }}</label>

                            <div class="col-md-6">
                                <input readonly="readonly" id="purchase_offer_status" type="text" class="form-control @error('purchase_offer_status') is-invalid @enderror" name="purchase_offer_status" value="Pending" required autocomplete="purchase_offer_status">

                                @error('purchase_offer_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="purchase_offer_value" class="col-md-4 col-form-label text-md-right">{{ __('Value to offer') }}</label>

                            <div class="col-md-6">
                                <input id="purchase_offer_value" type="text" class="form-control @error('purchase_offer_value') is-invalid @enderror" name="purchase_offer_value" value="{{ old('purchase_offer_value') }}" required autocomplete="purchase_offer_value">

                                @error('purchase_offer_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn bg-warning text-dark border border-dark rounded font-weight-bold" title="Add">
                                    {{ __('Make offer') }}
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