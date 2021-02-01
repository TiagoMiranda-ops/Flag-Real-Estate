@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-6 pull-left" style="float:left">
                <h2 style="text-align: left"> Sale Statistics </h2>
            </div>
          
        </div>
    </div>

    @if (Session::has('message'))
        <div style="text-align: left" class="alert alert-warning bg-warning text-dark">{{ Session::get('message') }}</div>
    @elseif (Session::has('message-delete'))
        <div style="text-align: left" class="alert alert-warning bg-danger text-white">{{ Session::get('message-delete') }}</div>
    @endif
   

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Broker</td>
                <td>Property ID</td>
                <td>Value</td>
            </tr>
        </thead>
        <tbody>
        @foreach($acceptedOffers as $acceptedOffer)
            <tr>
                <td></td>
                <td></td>
                <td>{{ number_format($acceptedOffer->purchase_offer_value, 0, '', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection