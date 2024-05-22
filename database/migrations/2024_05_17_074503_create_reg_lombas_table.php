<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reg_lombas', function (Blueprint $table) {
            $table->id();
            $table->string('reg_nama_tim');
            $table->string('reg_instansi');
            $table->string('reg_nama_lomba');
            $table->string('reg_no_whatsapp');
            $table->string('reg_email');
            $table->string('reg_bukti_pembayaran');
            $table->foreignId('reg_peserta_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->foreign('reg_nama_lomba')->references('nama_lomba')->on('lombas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg_lombas');
        Schema::dropIfExists('users');
    }
};