<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus kolom lama yang tidak spesifik
            $table->dropColumn(['event_datetime', 'event_location']);
            
            // Kolom Acara Baru
            $table->dateTime('akad_datetime')->nullable()->after('bride_parents');
            $table->text('akad_location')->nullable()->after('akad_datetime');
            $table->dateTime('resepsi_datetime')->nullable()->after('akad_location');
            $table->text('resepsi_location')->nullable()->after('resepsi_datetime');
            
            // Kolom Sosial Media & Streaming
            $table->string('groom_ig')->nullable()->after('groom_parents');
            $table->string('bride_ig')->nullable()->after('bride_parents');
            $table->string('live_stream_url')->nullable()->after('quote');
            
            // Kolom Privasi (Tombol On/Off Fitur)
            $table->boolean('is_angpao_active')->default(true)->after('bank_owner');
            $table->boolean('is_gallery_active')->default(true)->after('is_angpao_active');
            $table->boolean('is_lovestory_active')->default(true)->after('is_gallery_active');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('event_datetime')->nullable();
            $table->text('event_location')->nullable();
            
            $table->dropColumn([
                'akad_datetime', 'akad_location', 'resepsi_datetime', 'resepsi_location',
                'groom_ig', 'bride_ig', 'live_stream_url', 
                'is_angpao_active', 'is_gallery_active', 'is_lovestory_active'
            ]);
        });
    }
};