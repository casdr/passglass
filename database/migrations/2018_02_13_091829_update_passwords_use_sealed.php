<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePasswordsUseSealed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passwords', function (Blueprint $table) {
            $table->dropForeign(['viewed_by_id']);
            $table->dropColumn('viewed_by_id');
            $table->boolean('sealed')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passwords', function (Blueprint $table) {
            $table->dropColumn('sealed');
            $table->integer('viewed_by_id')->unsigned()->nullable();
            $table->foreign('viewed_by_id')->references('id')->on('users');
        });
    }
}
