<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // Contoh: tema-rustic
            $table->text('description')->nullable();
            $table->string('preview_image')->nullable(); // Foto thumbnail template
            $table->string('view_path'); // File blade tujuan, misal: 'templates.rustic'
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('templates');
    }
};