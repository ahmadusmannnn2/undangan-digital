<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('love_stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('year'); // Contoh: 2018
            $table->string('title'); // Contoh: Awal Bertemu
            $table->text('story'); // Cerita lengkapnya
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('love_stories');
    }
};