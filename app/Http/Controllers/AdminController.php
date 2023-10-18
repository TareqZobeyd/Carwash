<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::query();

        if ($request->filled('service_type')) {
            $reservations->where('service_type', $request->input('service_type'));
        }

        if ($request->filled('specific_day')) {
            $specificDay = $request->input('specific_day');
            $startTime = $specificDay . ' 00:00:00';
            $endTime = $specificDay . ' 23:59:59';
            $reservations->whereBetween('reservation_datetime', [$startTime, $endTime]);
        }

        $reservations = $reservations->get();

        return view('admin.dashboard', compact('reservations'));
    }

    public function users()
    {
        $users = User::with('reservations')->get();

        return view('admin.users', compact('users'));
    }
    public function userRequests(User $user)
    {
        $requests = $user->reservations;

        return view('admin.user-requests', compact('user', 'requests'));
    }
}
