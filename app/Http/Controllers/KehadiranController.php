<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KehadiranController extends Controller
{
    public function index()
    {
        $kehadirans = Kehadiran::where('user_id', Auth::id())->get();
        return view('kehadiran.index', compact('kehadirans'));
    }

    public function checkIn(Request $request)
    {
        $kehadirans = Kehadiran::create([
            'user_id' => Auth::id(),
            'shift' => $request->shift, // 'pagi' atau 'sore'
            'date' => now()->toDateString(),
            'check_in' => now()->toTimeString(),
            'location' => $request->location,
        ]);

        return redirect()->back()->with('success', 'Berhasil absen masuk!');
    }

    public function checkOut(Request $request, $id)
    {
        $kehadiran = Kehadiran::findOrFail($id);
        $kehadiran->update([
            'check_out' => now()->toTimeString(),
            'location' => $request->location,
        ]);

        return redirect()->back()->with('success', 'Berhasil absen pulang!');
    }
}
