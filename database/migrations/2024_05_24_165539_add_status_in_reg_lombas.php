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
        Schema::table('reg_lombas', function (Blueprint $table) {
            $table->enum('status', ['draft', 'submitted', 'on_verification', 'result'])
                ->after('reg_peserta_id')
                ->comment('status from the competition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reg_lombas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};