@include('layouts.session')
@extends('layouts.main')
@section('title', 'create')
@section('content')
<div class="container">
    <h1 class="mt-5">Your Tracking Code</h1>

    <div class="card mt-3">
        <div class="card-body">
            <p class="card-text">Tracking Code: {{ $trackingCode }}</p>
        </div>
        <br>
        <br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<br>
@endsection
