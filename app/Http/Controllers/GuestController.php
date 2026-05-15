<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:hadir,tidak_hadir,ragu',
            'message' => 'required|string',
        ]);

        Guest::create([
            'order_id' => $order->id,
            'name' => $request->name,
            'status' => $request->status,
            'message' => $request->message,
        ]);

        // Kembali ke halaman undangan dengan jangkar (anchor) #rsvp
        return back()->with('success_rsvp', 'Terima kasih! Ucapan dan konfirmasi kehadiran Anda telah terkirim.');
    }
}