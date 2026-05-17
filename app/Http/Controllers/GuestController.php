<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Fungsi untuk tamu mengisi buku (Publik)
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

        return back()->with('success_rsvp', 'Terima kasih! Ucapan dan konfirmasi kehadiran Anda telah terkirim.');
    }

    // Fungsi untuk pemilik undangan menghapus ucapan (Hanya User/Admin)
    public function destroy(Guest $guest)
    {
        // Pastikan yang menghapus adalah pemilik undangan
        if ($guest->order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak menghapus ucapan ini.');
        }

        $guest->delete();

        return back()->with('success', 'Ucapan tamu berhasil dihapus.');
    }
}