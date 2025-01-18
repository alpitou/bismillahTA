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
        Schema::table('domisilis', function (Blueprint $table) {
            $table->text('komentar')->nullable(); // Menambahkan kolom komentar
        });
    }
    
    public function down()
    {
        Schema::table('domisilis', function (Blueprint $table) {
            $table->dropColumn('komentar'); // Menghapus kolom komentar jika rollback
        });
    }

};
