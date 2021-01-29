@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Offer Appraisal') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('offers.update', $purchaseOffer->purchase_offer_id) }}" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <div class="form-group row">
                            <label for="purchase_offer_status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <input id="purchase_offer_status" type="text" class="form-control @error('purchase_offer_status') is-invalid @enderror" name="purchase_offer_status" value="{{ $purchaseOffer->purchase_offer_status }}" required autocomplete="purchase_offer_status" autofocus>

                                @error('purchase_offer_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn bg-warning text-dark border border-dark rounded font-weight-bold" title="Update">
                                    {{ __('Adjudicate') }}
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