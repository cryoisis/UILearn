<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Akun baru otomatis Free. Pro hanya lewat upgrade.
            $table->string('plan', 16)->default('free')->after('password');

            // Penghitung pesan AI harian (tidak ikut reset saat chat dikosongkan).
            $table->date('ai_used_on')->nullable()->after('plan');
            $table->unsignedInteger('ai_used_count')->default(0)->after('ai_used_on');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['plan', 'ai_used_on', 'ai_used_count']);
        });
    }
};
