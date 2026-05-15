<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Template $template)
    {
        return view('user.orders.create', compact('template'));
    }

    public function store(Request $request, Template $template)
    {
        $request->validate([
            'domain_url' => 'required|string|unique:orders,domain_url|alpha_dash',
            'groom_name' => 'required|string|max:255',
            'groom_parents' => 'required|string|max:255',
            'groom_ig' => 'nullable|string|max:255',
            'bride_name' => 'required|string|max:255',
            'bride_parents' => 'required|string|max:255',
            'bride_ig' => 'nullable|string|max:255',
            'akad_datetime' => 'required|date',
            'akad_location' => 'required|string',
            'resepsi_datetime' => 'required|date',
            'resepsi_location' => 'required|string',
            'live_stream_url' => 'nullable|url',
            'quote' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'music_url' => 'nullable|string',
            'galleries.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi banyak gambar
        ]);

        // Upload Cover
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('order-covers', 'public');
        }

        // Buat Pesanan
        $order = Order::create([
            'user_id' => auth()->id(),
            'template_id' => $template->id,
            'domain_url' => strtolower($request->domain_url),
            
            // Mempelai
            'groom_name' => $request->groom_name,
            'groom_parents' => $request->groom_parents,
            'groom_ig' => $request->groom_ig,
            'bride_name' => $request->bride_name,
            'bride_parents' => $request->bride_parents,
            'bride_ig' => $request->bride_ig,
            
            // Acara
            'akad_datetime' => $request->akad_datetime,
            'akad_location' => $request->akad_location,
            'resepsi_datetime' => $request->resepsi_datetime,
            'resepsi_location' => $request->resepsi_location,
            'live_stream_url' => $request->live_stream_url,
            
            // Info Tambahan & Media
            'quote' => $request->quote,
            'cover_image' => $coverImagePath,
            'music_url' => $request->music_url,
            
            // Angpao
            'bank_name' => $request->bank_name,
            'bank_account' => $request->bank_account,
            'bank_owner' => $request->bank_owner,
            
            // Privasi (Checkbox jika dicentang akan ada nilainya, jika tidak maka false)
            'is_angpao_active' => $request->has('is_angpao_active'),
            'is_gallery_active' => $request->has('is_gallery_active'),
            'is_lovestory_active' => $request->has('is_lovestory_active'),
            
            'payment_status' => 'pending',
        ]);

        // Proses Multi Upload Galeri
        if ($request->hasFile('galleries')) {
            foreach ($request->file('galleries') as $image) {
                $path = $image->store('galleries', 'public');
                $order->galleries()->create(['image_path' => $path]);
            }
        }

        // Proses Array Kisah Cinta
        if ($request->has('ls_year')) {
            $years = $request->ls_year;
            $titles = $request->ls_title;
            $stories = $request->ls_story;

            for ($i = 0; $i < count($years); $i++) {
                if (!empty($years[$i]) && !empty($titles[$i]) && !empty($stories[$i])) {
                    $order->loveStories()->create([
                        'year' => $years[$i],
                        'title' => $titles[$i],
                        'story' => $stories[$i],
                    ]);
                }
            }
        }

        return redirect()->route('user.dashboard')->with('success', 'Pesanan Super Premium berhasil dibuat! Menunggu konfirmasi pembayaran.');
    }
}