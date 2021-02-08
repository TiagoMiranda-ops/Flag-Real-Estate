@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-6 pull-left" style="float:left">
                <h2 style="text-align: left"> Purchase Offers </h2>
            </div>
          
        </div>
    </div>

    @if (Session::has('message'))
        <div style="text-align: left" class="alert alert-warning bg-warning text-dark">{{ Session::get('message') }}</div>
    @elseif (Session::has('message-delete'))
    <div style="text-align: left" class="alert alert-warning bg-danger text-white">{{ Session::get('message-delete') }}</div>
    @elseif (Session::has('message-denied'))
    <div style="text-align: left" class="alert alert-warning bg-danger text-white">{{ Session::get('message-denied') }}</div>
    @endif
   

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Customer</td>
                <td>Property ID</td>
                <td>Value (€)</td>
                <td>Date of entry</td>
                <td>Status</td>
                @canany(['isAdmin', 'isBroker'], auth()->user())
                <td>Adjudicate</td>
                <td>Delete (No Backup)</td>
                @endcanany
            </tr>
        </thead>
        <tbody>
        @foreach($purchaseOffers as $value)
            <tr>
                <td>{{ $value->userCustomer->name}}</td>
                <td>{{ $value->property->property_id }}</td>
                <td>{{ number_format($value->purchase_offer_value, 0, '', '.') }}</td>
                <td>{{ $value->purchase_offer_date_entry }}</td>
                @if ($value->purchase_offer_status == "Pending")
                    <td class="bg-secondary">{{ $value->purchase_offer_status }}</td>
                @elseif ($value->purchase_offer_status == "Accepted")
                    <td class="bg-success">{{ $value->purchase_offer_status }}</td>
                @else ($value->purchase_offer_status == "Declined")
                    <td class="bg-danger">{{ $value->purchase_offer_status }}</td>
                @endif
                @canany(['isAdmin', 'isBroker'], auth()->user())
                <td style="text-align: center; min-width:175px;">
                <a class="btn-lg text-secondary" href="{{ route('offers.edit', $value->purchase_offer_id) }}" title="Adjudicate"><i class="bi bi-hammer"></i></a>
                </td>
                <td style="text-align: center; min-width:175px;"> 
                <form style="display:inline" method="POST" action="{{ route('offers.destroy', $value->purchase_offer_id) }}">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-lg text-danger" title="Delete"><i class="bi bi-x-square"></i></button>
                </form>
                </td>
                @endcanany
            </tr>
        @endforeach
        </tbody>
    </table>







</div>
@endsection