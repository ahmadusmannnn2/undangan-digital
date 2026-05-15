<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('groom_parents')->nullable()->after('groom_name'); // Nama ortu pria
            $table->string('bride_parents')->nullable()->after('bride_name'); // Nama ortu wanita
            $table->text('quote')->nullable()->after('event_location'); // Kutipan cinta
            $table->string('bank_name')->nullable(); // Bank untuk angpao (misal: BCA)
            $table->string('bank_account')->nullable(); // No Rekening
            $table->string('bank_owner')->nullable(); // Nama Pemilik Rekening
        });
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['groom_parents', 'bride_parents', 'quote', 'bank_name', 'bank_account', 'bank_owner']);
        });
    }
};