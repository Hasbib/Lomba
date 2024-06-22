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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_peserta_id')->constrained('users')->onDelete('cascade');
            $table->string('team_nama_lomba');
            $table->string('team_member_name');
            $table->string('team_member_nik');
            $table->string('team_member_instansi');
            $table->string('team_member_role');
            $table->string('team_member_picture');
            $table->enum('status', ['draft', 'submitted', 'on_verification', 'result'])
                ->comment('status from the competition');
            $table->timestamps();

            $table->foreign('team_nama_lomba')->references('nama_lomba')->on('lombas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('users');
    }
};