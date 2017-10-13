<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePasswordsAddViewer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passwords', function (Blueprint $table) {
            $table->integer('viewed_by_id')->unsigned()->nullable();
            $table->foreign('viewed_by_id')->references('id')->on('users');
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
            $table->dropForeign(['viewed_by_id']);
            $table->dropColumn('viewed_by_id');
        });
    }
}
