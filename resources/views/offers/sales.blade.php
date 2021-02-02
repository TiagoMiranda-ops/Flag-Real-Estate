@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-12 pull-left" style="float:left">
                <h2 style="text-align: left"> Sale Statistics </h2>
                <h3 style="text-align: right" class="btn bg-warning text-dark border border-dark rounded font-weight-bold" title="I had you there, this ain't a button!"> All sales combined: {{ number_format($totalValueSum, 0, '', '.') }} € </h3>
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
                <td>Broker ID</td>
                <td>Property ID</td>
                <td>Value of Sale (€)</td>
            </tr>
        </thead>
        <tbody>
        @foreach($acceptedOffers as $value)
            <tr>
                <td>{{ $value->property->user_id }}</td>
                <td>{{ $value->property->property_id }}</td>
                <td>{{ number_format($value->purchase_offer_value, 0, '', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection