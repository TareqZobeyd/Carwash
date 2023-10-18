<?php

namespace App\Http\Controllers;

use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function showTracking($trackingCode)
    {
        return view('tracking', compact('trackingCode'));
    }
}

