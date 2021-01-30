@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-6 pull-left" style="float:left">
                <h2 style="text-align: left"> Properties </h2>
            </div>
            <div class="col-lg-6 pull-right" style="float:right">
                <a style="float:right" class="btn bg-warning text-dark border border-dark rounded font-weight-bold" href="{{ route('properties.create') }}" title="Add a new property"> Add a new property </a>
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
                <td>Price (€)</td>
                <td>District</td>
                <td>County</td>
                <td>Type</td>
                <td>m<sup>2</sup></td>
                <td>Broker</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
        @foreach($properties as $value)
            <tr>
                <td>{{ number_format($value->property_price, 0, '', '.') }}</td>
                <td>{{ $value->property_district }}</td>
                <td>{{ $value->property_county }}</td>
                <td>{{ $value->property_type }}</td>
                <td>{{ $value->property_sqm }}</td>
                <td></td>
                <td style="text-align: center; min-width:175px;">
                <a class="btn-lg text-dark" href="{{ route('properties.show', $value->property_id) }}" title="View"><i class="bi bi-info-square"></i></a>
                <a class="btn-lg text-dark" href="{{ route('properties.edit', $value->property_id) }}" title="Edit"><i class="bi bi-pen"></i></a>
                <a class="btn-lg text-success" href="{{ route('offers.create', $value->property_id) }}" title="Make an offer"><i class="bi bi-cash-stack"></i></a>
                <form style="display:inline" method="POST" action="{{ route('properties.destroy', $value->property_id) }}">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-lg text-danger" title="Delete"><i class="bi bi-x-square"></i></button>
                </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>







</div>
@endsection