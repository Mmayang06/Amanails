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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // gel-polish, nail-art-custom, nail-extension
            $table->string('category_label');
            $table->integer('price');
            $table->integer('duration'); // dalam menit
            $table->string('image'); // path di storage/app/public/nails/...
            $table->string('uploaded_by'); // Aurel, Mayang, Nadia
            $table->string('uploader_role')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
