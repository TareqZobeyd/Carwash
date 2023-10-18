<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class InvoiceController extends Controller
{
    public function checkTrackingCode(Request $request)
    {
        $trackingCode = $request->input('tracking_code');

        $reservation = Reservation::where('tracking_code', $trackingCode)->first();

        if (!$reservation) {
            return redirect()->route('dashboard')->with('error', 'Invalid tracking code.');
        }

        return view('invoice', ['reservation' => $reservation]);
    }

    public function editInvoice($id)
    {
        $reservation = Reservation::query()->findOrFail($id);

        return view('/updateInvoice', compact('reservation'));
    }

    public function updateInvoice(Request $request, $id)
    {
//
        $reservation = Reservation::findOrFail($id);

        $reservation->update($request->validate([
            'name' => 'required|string',
            'service_type' => 'required|string',
            'reservation_datetime' => 'required|date_format:Y-m-d\TH:i',
        ]));

        return redirect()->route('reservation-home', ['id' => $reservation->id])->with('success', 'Your order updated successfully');
    }

    public function deleteInvoice($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->delete();
        }

        return redirect()->route('dashboard')->with('success', 'Your Order deleted successfully.');
    }
}
