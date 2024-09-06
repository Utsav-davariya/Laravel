


@extends('resourceView.layout')

@section('title')
    <h3>Add Student Data</h3>
@endsection

@section('content')
<div class="container">
<form method="POST" action="{{ route('resourceStudents.store') }}">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text"
            class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}"  autofocus>
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
            value="{{ old('email') }}" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>    <div class="form-group">
        <label for="age">Age</label>
        <input id="age" type="number"
            class="form-control @error('age') is-invalid @enderror" name="age"
            value="{{ old('age') }}" autofocus>
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
            value="{{ old('address') }}" autofocus>
        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>






    <div class="row justify-content-center">

        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
</div>
@endsection
