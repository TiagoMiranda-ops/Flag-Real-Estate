@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-6 pull-left" style="float:left">
                <h2 style="text-align: left"> Purchase Offers </h2>
            </div>
            <div class="col-lg-6 pull-right" style="float:right">
                <a style="float:right" class="btn bg-warning text-dark border border-dark rounded font-weight-bold" href="{{ route('offers.create') }}" title="Make a new offer"> Make a new offer </a>
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
                <td>Customer</td>
                <td>Date of entry</td>
                <td>Status</td>
                <td>Value</td>
                <td>Adjudicate</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
        @foreach($purchaseOffers as $value)
            <tr>
                <td></td>
                <td>{{ $value->purchase_offer_date_entry }}</td>
                <td>{{ $value->purchase_offer_status }}</td>
                <td>{{ number_format($value->purchase_offer_value, 0, '', '.') }}</td>
                <td style="text-align: center; min-width:175px;">
                <a class="btn-lg text-dark" href="{{ route('offers.edit', $value->purchase_offer_id) }}" title="Adjudicate"><i class="bi bi-pen"></i></a>
                </td>
                <td style="text-align: center; min-width:175px;"> 
                <form style="display:inline" method="POST" action="{{ route('offers.destroy', $value->purchase_offer_id) }}">
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