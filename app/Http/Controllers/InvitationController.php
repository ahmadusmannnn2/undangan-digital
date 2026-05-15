<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show($domain_url)
    {
        // Cari pesanan berdasarkan link custom (domain_url)
        $order = Order::with('template')->where('domain_url', $domain_url)->firstOrFail();

        // Kunci undangan jika belum dibayar/diaktifkan Admin
        if ($order->payment_status !== 'success') {
            return abort(403, 'Mohon maaf, halaman undangan ini belum diaktifkan.');
        }

        // Tampilkan view sesuai dengan path template yang dibeli (contoh: templates.rustic)
        return view($order->template->view_path, compact('order'));
    }
}