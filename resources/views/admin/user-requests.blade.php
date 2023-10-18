@extends('layouts.main')
@section('title', 'User Requests')
@section('content')
    <div class="container mt-5">
        <h1>Requests for User: {{ $user->name }}</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Tracking Code</th>
                <th>Service Type</th>
                <th>Reservation Date and Time</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->tracking_code }}</td>
                    <td>{{ $request->service_type }}</td>
                    <td>{{ $request->reservation_datetime }}</td>
                    <td>{{ number_format($request->price) }} T</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
