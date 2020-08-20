<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaraatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laraats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('ユーザID');
            $table->string('txt_content')->comment('ツイート本文');
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::table('laraats', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laraats');
    }
}
