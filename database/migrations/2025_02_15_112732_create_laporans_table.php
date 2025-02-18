<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kodeLaporan');
            $table->string('nomor_lhp')->unique();
            $table->string('judul');
            $table->date('tgl_pemeriksaan');
            $table->text('ringkasan_hasil');
            $table->text('uraian_hasil');
            $table->text('kesimpulan');
            $table->text('saran');
            $table->string('ttd');
            $table->string('namaTtd');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('laporans');
    }
};
