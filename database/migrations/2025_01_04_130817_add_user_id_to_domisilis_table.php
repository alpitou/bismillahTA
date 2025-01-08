<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToDomisilisTable extends Migration
{
    public function up()
    {
        Schema::table('domisilis', function (Blueprint $table) {
            if (!Schema::hasColumn('domisilis', 'user_id')) {
                $table->foreignId('user_id')->nullable()->change();
            }
        });
    }

    public function down()
    {
        Schema::table('domisilis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
