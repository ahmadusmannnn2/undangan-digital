<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'template'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function markAsPaid(Order $order)
    {
        $order->update(['payment_status' => 'success']);
        return back()->with('success', 'Pesanan diaktifkan! Link undangan sekarang bisa diakses oleh tamu.');
    }

    // Fungsi baru untuk menghapus pesanan (beserta foto-fotonya)
    public function destroy(Order $order)
    {
        // Hapus foto cover dari storage
        if ($order->cover_image) {
            Storage::disk('public')->delete($order->cover_image);
        }

        // Hapus foto galeri dari storage
        foreach ($order->galleries as $gallery) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $order->delete();

        return back()->with('success', 'Data pesanan berhasil dihapus secara permanen.');
    }
}