<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $isFastest = $request->input('reserve_type') === 'fastest';

        $rules = [
            'name' => 'required|string',
            'service_type' => 'required|string|max:255',
            'reserve_day' => $isFastest ? 'nullable' : 'required|date_format:Y-m-d',
            'reserve_time' => $isFastest ? 'nullable' : 'required|date_format:H:i',
            'tracking_code' => 'min:6',
        ];

        $validatedData = $request->validate($rules);
        $trackingCode = Str::random(6);
        $serviceType = $request->input('service_type');
        $price = $this->mapServiceTypeToPrice($serviceType);

        $user = Auth::user();

        if (!$isFastest) {
            $reserveDay = $validatedData['reserve_day'];
            $reserveTime = $validatedData['reserve_time'];

            $reservedCount = Reservation::query()->where('reservation_datetime', $reserveDay . ' ' . $reserveTime)
                ->count();

            if ($reservedCount >= 2) {
                return redirect()->route('reservation-home')
                    ->with('error', 'Sorry, both slots are already reserved for this time. Please choose another time.');
            }
        }

        $endAt = null;

        if (!$isFastest) {
            $serviceType = $request->input('service_type');
            $reservationDateTime = Carbon::parse($validatedData['reserve_day'] . ' ' . $validatedData['reserve_time']);

            if ($serviceType === 'wash-basin') {
                $endAt = $reservationDateTime->copy()->addMinutes(15);
            } elseif ($serviceType === 'interior-cleaning') {
                $endAt = $reservationDateTime->copy()->addMinutes(20);
            } elseif ($serviceType === 'zero-washing') {
                $endAt = $reservationDateTime->copy()->addMinutes(60);
            }
        }

        $reservation = new Reservation([
            'name' => $validatedData['name'],
            'service_type' => $validatedData['service_type'],
            'price' => $price,
            'is_fastest' => $isFastest,
            'reservation_datetime' => ($isFastest) ? null : $validatedData['reserve_day'] . ' ' . $validatedData['reserve_time'],
            'end_at' => $endAt,
            'tracking_code' => $trackingCode,
        ]);

        $user->reservations()->save($reservation);

        if ($reservation) {
            return redirect()->route('tracking', ['tracking_code' => $trackingCode])
                ->with('success', 'Reservation submitted successfully!');
        } else {
            return redirect()->route('reservation-home')->with('error', 'Failed to submit reservation.');
        }
    }

    private function mapServiceTypeToPrice($serviceType)
    {
        $priceMapping = [
            'wash-basin' => 25000,
            'interior-cleaning' => 30000,
            'zero-washing' => 80000,
        ];

        return $priceMapping[$serviceType] ?? 0;
    }
}
