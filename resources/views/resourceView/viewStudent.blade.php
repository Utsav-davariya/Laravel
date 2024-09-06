


@extends('resourceView.layout')

@section('title')
    <h3>Students Data</h3>
@endsection

@section('content')

<table class="table table-striped table-bordered bg-dark  text-light">
    <tr>
        <th width="100px">name :</th>
        <td>{{$students->name}}</td>
    </tr>
    <tr>
        <th>Email :</th>
        <td>{{$students->email}}</td>
    </tr>
    <tr>
        <th>Age :</th>
        <td>{{$students->age}}</td>
    </tr>
    <tr>
        <th>Address :</th>
        <td>{{$students->address}}</td>
    </tr>
    <tr>
        <th>City :</th>
        <td>{{$students->city}}</td>
    </tr>

</table>
<a href="{{route('resourceStudents.index')}}" class="btn btn-danger">Back</a>


@endsection
