@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-6 pull-left" style="float:left">
                <h2 style="text-align: left"> Appointments </h2>
            </div>
            <div class="col-lg-6 pull-right" style="float:right">
                <a style="float:right" class="btn bg-warning text-dark border border-dark rounded font-weight-bold" href="#" title="Schedule an appointment"> Schedule an appointment </a>
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
                <td>Scheduled Date</td>
                <td>Status</td>
                <td>Broker</td>
            </tr>
        </thead>
        <tbody>

        @foreach($appointments as $value)
            
            <tr>
                <td>{{ $value['customer'] }}</td>
                <td>{{  date("d-m-Y", strtotime($value['date'])) }}</td>
                <td>{{ $value['status'] }}</td>
                <td>{{ $value['broker'] }}</td>
            </tr>
           
        @endforeach

        </tbody>
    </table>







</div>
@endsection