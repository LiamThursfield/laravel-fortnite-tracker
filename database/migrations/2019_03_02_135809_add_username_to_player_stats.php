<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameToPlayerStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_playlist_stats', function(Blueprint $table) {
            $table->string('player_username')->after('player_id')->index();
        });

        Schema::table('player_lifetime_stats', function(Blueprint $table) {
            $table->string('player_username')->after('player_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_playlist_stats', function (Blueprint $table) {
            $table->dropColumn('player_username');
        });

        Schema::table('player_lifetime_stats', function (Blueprint $table) {
            $table->dropColumn('player_username');
        });
    }
}
