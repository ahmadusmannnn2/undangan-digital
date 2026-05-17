<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Order;
use App\Models\LoveStory;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function show(Template $template)
    {
        // Membuat data order tiruan (dummy)
        $order = new Order([
            'groom_name' => 'Romeo',
            'bride_name' => 'Juliet',
            'groom_parents' => 'Bapak Montague & Ibu Montague',
            'bride_parents' => 'Bapak Capulet & Ibu Capulet',
            'groom_ig' => '@romeo_m',
            'bride_ig' => '@juliet_c',
            'akad_datetime' => now()->addDays(30)->setTime(9, 0),
            'akad_location' => 'Masjid Raya Al-Azhar, Kebayoran Baru, Jakarta Selatan',
            'resepsi_datetime' => now()->addDays(30)->setTime(11, 0),
            'resepsi_location' => 'Grand Ballroom Hotel Mulia, Senayan, Jakarta',
            'quote' => 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya...',
            'live_stream_url' => 'https://youtube.com',
            'cover_image' => null, 
            'music_url' => null, 
            'bank_name' => 'BCA',
            'bank_account' => '1234 5678 9012',
            'bank_owner' => 'Romeo Montague',
            'is_angpao_active' => true,
            'is_gallery_active' => false, 
            'is_lovestory_active' => true,
        ]);

        // SET ID SECARA MANUAL (Bypass proteksi database)
        // Kita beri ID 999 agar rute formulir RSVP bisa di-generate (contoh: /999/rsvp)
        $order->id = 999;

        // Menyisipkan data dummy untuk relasi Kisah Cinta (Timeline)
        $order->setRelation('loveStories', collect([
            new LoveStory([
                'year' => '2020',
                'title' => 'Pertemuan Pertama',
                'story' => 'Kami bertemu secara kebetulan di sebuah kedai kopi. Tatapan pertama yang akhirnya merubah segalanya.'
            ]),
            new LoveStory([
                'year' => '2023',
                'title' => 'Hari Lamaran',
                'story' => 'Momen tak terlupakan saat kami memutuskan untuk melangkah ke jenjang yang lebih serius bersama keluarga besar.'
            ])
        ]));

        // Menyisipkan koleksi kosong untuk relasi galeri dan tamu agar tidak error
        $order->setRelation('galleries', collect([]));
        $order->setRelation('guests', collect([]));

        return view($template->view_path, compact('order'));
    }
}