<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerPlaylistStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_playlist_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('player_id');
            $table->string('platform_id');
            $table->string('playlist');
            $table->string('period');
            $table->unsignedInteger('matches_played');
            $table->unsignedInteger('kills');
            $table->float('kd');
            $table->float('kpm');
            $table->unsignedInteger('score');
            $table->float('spm');
            $table->unsignedInteger('top_1');
            $table->float('top_1_ratio');
            $table->unsignedInteger('top_5');
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
        Schema::dropIfExists('player_playlist_stats');
    }
}
