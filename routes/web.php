<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\GuestController;
use App\Models\Template;

// RUTE HALAMAN DEPAN (LANDING PAGE)
Route::get('/', function () {
    // Mengambil 6 template terbaru yang aktif untuk dipajang di halaman depan
    $templates = Template::where('is_active', true)->latest()->take(6)->get();
    return view('welcome', compact('templates'));
});

// Redirect utama saat login
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute khusus Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('templates', TemplateController::class);
    
    // Kelola Pesanan & Hapus Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/paid', [AdminOrderController::class, 'markAsPaid'])->name('orders.paid');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy'); // <-- Ini yang baru ditambahkan
});

// Rute khusus User
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/order/{template}', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/{template}', [OrderController::class, 'store'])->name('order.store');
    
    // Lihat Daftar Tamu
    Route::get('/order/{order}/guests', [UserDashboard::class, 'guests'])->name('guests.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// RUTE UNDANGAN & RSVP (Paling Bawah)
Route::post('/{order}/rsvp', [GuestController::class, 'store'])->name('guest.store');
Route::get('/{domain_url}', [InvitationController::class, 'show'])->name('invitation.show');