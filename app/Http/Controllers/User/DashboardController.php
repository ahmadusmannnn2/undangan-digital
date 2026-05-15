<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $templates = Template::where('is_active', true)->latest()->get();
        // Mengambil riwayat pesanan beserta data tamunya
        $orders = Order::with(['template', 'guests'])->where('user_id', Auth::id())->latest()->get();

        return view('user.dashboard', compact('templates', 'orders'));
    }

    // Fungsi baru untuk melihat halaman daftar tamu secara spesifik
    public function guests(Order $order)
    {
        // Pastikan hanya pemilik pesanan yang bisa melihat
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        $guests = $order->guests()->latest()->get();
        return view('user.guests', compact('order', 'guests'));
    }
}