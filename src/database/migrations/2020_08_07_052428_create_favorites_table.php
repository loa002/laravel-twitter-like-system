<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->comment('ユーザID');
            $table->integer('laraat_id')->unsigned()->comment('ツイートID');
            $table->timestamps();

            $table->unique(['user_id','laraat_id']); //いいねは1ツイートにつき1回のみのため
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('laraat_id')
            ->references('id')
            ->on('laraats')
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
        Schema::dropIfExists('favorites');
    }
}
