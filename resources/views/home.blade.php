@include('layouts.session')
@extends('layouts.main')
@section('content')
    @if(!Auth::check())
    <div class="container text-center mt-3">
        <div class="alert alert-info" role="alert">
            <h4>Welcome to our car wash reservation system!</h4>
            <h5>To book a car wash, You have to register or login</h5>
        </div>
    </div>
    @endif
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Book a Car Wash</h2>
                    <p>Working Hours: 9:00 AM to 9:00 PM</p>

                    <form action="{{route('reservation-store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="service_type">Service Type</label>
                            <select class="form-control" id="service_type" name="service_type" multiple>
                                <option value="wash-basin">Wash Basin - 25,000 T - 15 min</option>
                                <option value="interior-cleaning">Interior Cleaning - 30,000 T - 20 min</option>
                                <option value="zero-washing">Zero Washing - 80,000 T - 60 min</option>
                            </select>
                            @error('service_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="reserve-type">Reserve Type</label>
                            <select class="form-control" id="reserve-type" name="reserve_type">
                                <option value="fastest">Fastest Time Possible</option>
                                <option value="day-hour">Reserve Day and Hour</option>
                            </select>
                            @error('reserve_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" id="day-time-fields">
                            <label for="reserve-day">Select Day</label>
                            <input type="date" class="form-control" id="reserve-day" name="reserve_day">
                            @error('reserve_day')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" id="reserve-time-fields">
                            <label for="reserve-time">Select Time</label>
                            <select class="form-control" id="reserve-time" name="reserve_time">
                            </select>
                        </div>

                        @if(Auth::check())
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection



