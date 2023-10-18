<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('auth.profile');
    }
    public function update(Request $request)
    {
        $user = Auth::user();


        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:11',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone')
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

}
