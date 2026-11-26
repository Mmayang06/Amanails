<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('artist_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_type')->default('Pelanggan Baru');
            $table->date('appointment_date');
            $table->string('time_slot');
            $table->string('station')->default('Station 01');
            $table->integer('guests')->default(1);
            $table->string('design_type')->default('catalog'); // catalog, custom
            $table->string('custom_design_image')->nullable();
            $table->text('custom_design_note')->nullable();
            $table->integer('dp_amount')->default(50000);
            $table->string('dp_payment_method')->nullable(); // qris, bank_transfer
            $table->string('dp_payment_proof')->nullable();
            $table->string('dp_status')->default('verified'); // pending, verified
            $table->integer('initial_total')->default(0);
            $table->integer('addons_total')->default(0);
            $table->integer('final_total')->default(0);
            $table->string('final_payment_method')->nullable(); // cash, qris, edc
            $table->string('final_payment_status')->default('unpaid'); // unpaid, paid
            $table->string('status')->default('Menunggu'); // Menunggu, Sedang Berlangsung, Selesai, Dibatalkan
            $table->integer('total_duration')->default(60);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
