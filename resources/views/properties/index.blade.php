@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-6 pull-left" style="float:left">
                <h2>Properties </h2>
            </div>
            <div class="col-lg-6 pull-right" style="float:right">
                <a style="float:right" class="btn btn-success" href="{{ Route('properties.index') }}" title="Add a new propriety"> Add a new propriety </a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Price (€)</td>
                <td>District</td>
                <td>County</td>
                <td>Type</td>
                <td>m2</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
        @foreach($properties as $value)
            <tr>
                <td>{{ $value->property_price }}</td>
                <td>{{ $value->property_district }}</td>
                <td>{{ $value->property_county }}</td>
                <td>{{ $value->property_type }}</td>
                <td>{{ $value->property_sqm }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>







</div>
@endsection