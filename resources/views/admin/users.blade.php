@extends('layouts.main')
@section('title', 'Admin Users')
@section('content')
    <div class="container mt-5">
        <h1>Admin Users</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Total Payments</th>
                <th>Last Request Date</th>
                <th>Activity Rate</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('admin.user.requests', $user->id) }}">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->reservations->count() > 0)
                            {{ $user->reservations->sum('price') }} T
                        @else
                            No reservations
                        @endif
                    </td>
                    <td>
                        @if ($user->reservations->count() > 0)
                            {{ optional($user->reservations->sortByDesc('created_at')->first())->created_at }}
                        @else
                            N/A
                        @endif
                    </td>
                    @php
                        $currentDate = now();
                             $requestsInLastThreeMonths = $user->reservations
                                 ->where('reservation_datetime', '<=', $currentDate)
                                 ->where('reservation_datetime', '>=', $currentDate->subMonths(3))
                                 ->count();
                              if ($requestsInLastThreeMonths >= 5) {
                                  $activityRateClass = 'text-success';
                              } elseif ($requestsInLastThreeMonths >= 2) {
                                  $activityRateClass = 'text-warning';
                              } else {
                                  $activityRateClass = 'text-danger';
                              }
                    @endphp
                    <td class="{{ $activityRateClass }}">{{ $requestsInLastThreeMonths }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
