<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFfRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ff_relationships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('following_user_id')->unsigned()->comment('フォローするユーザID');
            $table->integer('followed_user_id')->unsigned()->comment('フォローされるユーザID');
            $table->timestamps();

            $table->unique(['following_user_id','followed_user_id']);
        });

        Schema::table('ff_relationships', function (Blueprint $table) {
            $table->foreign('following_user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('followed_user_id')
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
        Schema::dropIfExists('ff_relationships');
    }
}
