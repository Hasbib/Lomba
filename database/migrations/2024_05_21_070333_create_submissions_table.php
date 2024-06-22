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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_peserta_id')->constrained('users')->onDelete('cascade');
            $table->string('sub_nama_lomba');
            $table->string('sub_judul');
            $table->text('sub_deskripsi');
            $table->string('sub_link');
            $table->string('sub_file');
            $table->enum('status', ['draft', 'submitted', 'on_verification', 'result'])
                ->comment('status from the competition');
            $table->timestamps();

            $table->foreign('sub_nama_lomba')->references('nama_lomba')->on('lombas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('users');
    }
};