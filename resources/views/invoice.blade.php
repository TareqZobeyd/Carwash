@include('layouts.session')
@extends('layouts.main')
@section('title', 'create')
@section('content')
    <div class="card-body">
        @if ($reservation->hasExpired())
            <div class="alert alert-danger">
                Your reservation has expired.
            </div>
        @endif
<div class="container mt-5">
    <h1>Invoice Details</h1>
    @if (!$reservation->hasExpired())
    <form method="get" action="{{ route('edit-invoice', ['id' => $reservation->id]) }}">
        @csrf
        <button type="submit" class="btn btn-sm btn-secondary mb-3">
            <i class="bi bi-pencil"></i> Edit
        </button>
    </form>
    <form method="POST" action="{{ route('delete-invoice', ['id' => $reservation->id]) }}">
        @csrf
        <button type="submit" class="btn btn-sm btn-danger mb-3 ms-2">
            <i class="bi bi-trash"></i> Delete
        </button>
    </form>
    @endif
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $reservation->name }}</h5>
            <p class="card-text">Phone: {{ $reservation->user->phone }}</p>
            <p class="card-text">Service Type: {{ $reservation->service_type }}</p>
            <p class="card-text">Reservation Date and Time: {{ $reservation->reservation_datetime }}</p>
            <p class="card-text">Reservation Ends At: {{ $reservation->end_at }}</p>
            <p class="card-text">Price: {{ number_format($reservation->price) }} T</p>

        </div>
    </div>
    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Back to Dashboard</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<br>
@endsection

