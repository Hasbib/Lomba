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
        Schema::create('registrasi_lomba', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reg_lombas_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_members_id')->constrained()->onDelete('cascade');
            $table->foreignId('submissions_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi_lomba');
    }
};