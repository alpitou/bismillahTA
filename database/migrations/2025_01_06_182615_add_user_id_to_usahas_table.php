<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToUsahasTable extends Migration
{
    public function up()
    {
        Schema::table('usahas', function (Blueprint $table) {
            // Tambahkan kolom 'user_id' jika belum ada
            if (!Schema::hasColumn('usahas', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('usahas', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu sebelum menghapus kolom
            if (Schema::hasColumn('usahas', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
}
