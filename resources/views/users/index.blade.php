@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="col-lg-6 pull-left" style="float:left">
                <h2 style="text-align: left"> Users </h2>
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
                <td>Name</td>
                <td>Address</td>
                <td>Phone</td>
                <td>E-mail</td>
                <td>Registration Date</td>
                <td>Role</td>
                <td>Change Role</td>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->address }}</td>
                <td>{{ $value->phone }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->created_at}}</td>
                <td>{{ $value->role->role_type }}</td>
                <td style="text-align: center; min-width:175px;">
                    <a class="btn-lg text-secondary" href="{{ route('users.edit', $value->user_id) }}" title="Change Role"><i class="bi bi-person-circle"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    





</div>
@endsection