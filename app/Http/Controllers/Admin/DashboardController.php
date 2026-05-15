<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung Total Pendapatan dari pesanan yang sukses
        $totalPendapatan = 0;
        $ordersSuccess = Order::with('template')->where('payment_status', 'success')->get();
        foreach ($ordersSuccess as $order) {
            if ($order->template) {
                $totalPendapatan += $order->template->price;
            }
        }

        // Statistik Umum
        $totalPesanan = Order::count();
        $pesananPending = Order::where('payment_status', 'pending')->count();
        $totalPengguna = User::where('role', 'user')->count();
        $totalTemplate = Template::count();

        // Mengambil 5 pesanan terakhir untuk sekilas info di dashboard
        $recentOrders = Order::with(['user', 'template'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPendapatan', 
            'totalPesanan', 
            'pesananPending', 
            'totalPengguna', 
            'totalTemplate',
            'recentOrders'
        ));
    }
}