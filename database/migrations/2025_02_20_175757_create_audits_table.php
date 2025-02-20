<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->string('kodeLaporan');
            $table->string('nomor_lhp')->unique();
            $table->string('judul');
            $table->date('tgl_pemeriksaan');
            $table->text('latar_belakang');
            $table->text('tujuan');
            $table->text('waktu');
            $table->text('ruang_lingkup');
            $table->text('hasil');
            $table->text('rekomendasi');
            $table->text('kesimpulan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('audits');
    }
};
