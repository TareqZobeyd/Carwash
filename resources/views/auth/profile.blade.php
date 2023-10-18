@include('layouts.session')
@extends('layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="container mt-5">
        <h1>Profile</h1>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    <br>
@endsection
