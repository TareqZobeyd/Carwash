@extends('layouts.main')
@section('title', 'create')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Your Order') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('update-invoice', ['id' => $reservation->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', $reservation->name) }}"
                                       autocomplete="name" autofocus>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                <input id="phone" type="text" class="form-control" value="{{ $reservation->user->phone }}"
                                       readonly>
                            </div>

                            <div class="mb-3">
                                <label for="service_type" class="form-label">{{ __('Service Type') }}</label>
                                <select id="service_type"
                                        class="form-control @error('service_type') is-invalid @enderror"
                                        name="service_type" required>
                                    <option
                                        value="wash-basin" {{ old('service_type', $reservation->service_type) === 'wash-basin' ? 'selected' : '' }}>
                                        Wash Basin - 25,000 T
                                    </option>
                                    <option
                                        value="interior-cleaning" {{ old('service_type', $reservation->service_type) === 'interior-cleaning' ? 'selected' : '' }}>
                                        Interior Cleaning - 30,000 T
                                    </option>
                                    <option
                                        value="zero-washing" {{ old('service_type', $reservation->service_type) === 'zero-washing' ? 'selected' : '' }}>
                                        Zero Washing - 80,000 T
                                    </option>
                                </select>
                                @error('service_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="reservation_datetime"
                                       class="form-label">{{ __('Reservation Date and Time') }}</label>
                                <input id="reservation_datetime" type="datetime-local"
                                       class="form-control @error('reservation_datetime') is-invalid @enderror"
                                       name="reservation_datetime"
                                       value="{{ old('reservation_datetime', optional($reservation)->reservation_datetime ? $reservation->reservation_datetime->format('Y-m-d\TH:i') : '') }}">
                                @error('reservation_datetime')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Your Order') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
