<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domisilis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('kodeSurat');
            $table->string('noSurat')->unique();
            $table->string('nama');
            $table->string('nik');
            $table->string('tempatTglLahir');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->text('keterangan');
            $table->date('tglSurat');
            $table->string('ttd');
            $table->string('namaTtd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domisilis');
    }
};
