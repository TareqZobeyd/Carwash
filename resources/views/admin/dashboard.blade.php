@extends('layouts.main')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        <form method="get" action="{{ route('admin.dashboard') }}">
            @csrf
            <div class="mb-3">
                <label for="service_type" class="form-label">Service Type</label>
                <select class="form-select" id="service_type" name="service_type">
                    <option value="">All</option>
                    <option value="wash-basin">Wash Basin</option>
                    <option value="interior-cleaning">Interior Cleaning</option>
                    <option value="zero-washing">Zero Washing</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="specific_day" class="form-label">Specific Day</label>
                <input type="date" class="form-control" id="specific_day" name="specific_day">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Service Type</th>
                <th>Fastest Possible Time</th>
                <th>Reservation Date and Time</th>
                <th>Reservation Ends At</th>
                <th>Price</th>
                <th>Expired</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->service_type }}</td>
                    <td>{{ $reservation->is_fastest }}</td>
                    <td>{{ $reservation->reservation_datetime }}</td>
                    <td>{{ $reservation->end_at }}</td>
                    <td>{{ number_format($reservation->price) }} T</td>
                    <td>
                        @if (strtotime($reservation->end_at) < time())
                            Expired
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
