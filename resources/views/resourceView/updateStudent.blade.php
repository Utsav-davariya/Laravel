


@extends('resourceView.layout')

@section('title')
    <h3>Edit Student Data</h3>
@endsection

@section('content')
<div class="container">
<form method="POST" action="{{ route('resourceStudents.update',$students->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text"
            class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ $students->name }}"  autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email"
            class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{  $students->email }}" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>    <div class="form-group">
        <label for="age">Age</label>
        <input id="age" type="number"
            class="form-control @error('age') is-invalid @enderror" name="age"
            value="{{  $students->age }}" autofocus>
        @error('age')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="address">Address : </label>
        <input id="address" type="text"
            class="form-control @error('address') is-invalid @enderror" name="address"
            value="{{  $students->address }}" autofocus>
        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>






    <div class="row justify-content-center">

        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
</div>
@endsection
