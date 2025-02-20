<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sakits', function (Blueprint $table) {
            $table->text('komentar')->nullable()->collation('utf8mb4_unicode_ci');
        });
    }

    public function down(): void
    {
        Schema::table('sakits', function (Blueprint $table) {
            $table->dropColumn('komentar');
        });
    }
};

