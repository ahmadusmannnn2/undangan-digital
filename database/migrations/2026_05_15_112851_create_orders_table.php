<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('template_id')->constrained()->cascadeOnDelete();
            $table->string('domain_url')->unique(); // Link undangan: website.com/romeo-juliet
            $table->string('groom_name'); // Nama Pria
            $table->string('bride_name'); // Nama Wanita
            $table->dateTime('event_datetime'); // Waktu acara
            $table->text('event_location'); // Lokasi/Alamat
            $table->string('music_url')->nullable(); // Link lagu
            $table->string('cover_image')->nullable(); // Foto utama mempelai
            $table->string('payment_status')->default('pending'); // pending, success, failed
            $table->string('payment_proof')->nullable(); // Bukti transfer
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};