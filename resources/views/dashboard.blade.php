@include('layouts.session')
@extends('layouts.main')
@section('title', '')
@section('content')
    <div class="container mt-5">
        <h1>Edit or Delete Your Request</h1>
        <form action="{{ route('check-tracking-code') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tracking_code" class="form-label">Enter Tracking Code:</label>
                <input type="text" class="form-control" id="tracking_code" name="tracking_code">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <br>
        <h2>Your Reservations:</h2>

        @foreach(Auth::user()->reservations as $reservation)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Service Type: {{ $reservation->service_type }}</h5>
                    <p class="card-text">Reservation Date and Time: {{ $reservation->reservation_datetime }}</p>
                    <p class="card-text">Reservation Ends At: {{ $reservation->end_at }}</p>
                    <p class="card-text">Price: {{ number_format($reservation->price) }} T</p>
                    <p class="card-text">Tracking Code: {{ $reservation->tracking_code }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
