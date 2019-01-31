<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_platforms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('player_id');
            $table->string('platform_id');
            $table->timestamps();

            $table->foreign('player_id')
                ->references('id')->on('players')
                ->onDelete('cascade');

            $table->foreign('platform_id')
                ->references('id')->on('platforms')
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
        Schema::dropIfExists('player_platforms');
    }
}
