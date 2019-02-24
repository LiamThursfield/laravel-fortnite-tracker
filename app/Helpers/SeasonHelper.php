<?php

namespace App\Helpers;

use App\Models\Season;
use Carbon\Carbon;

class SeasonHelper {

    /**
     * Get the Season based on the provided start date
     * @param Carbon|null $start_date
     * @return Season||null
     */
    public static function getSeasonByStartDate(Carbon $start_date = null) {
        if (is_null($start_date)) {
            $start_date = Carbon::now();
        }

        return Season::where('start_date', '<=', $start_date)
            ->orderBy('start_date', 'desc')
            ->first();
    }

    /**
     * Get the Season that is currently underway
     * @return Season||null
     */
    public static function getCurrentSeason() {
        $current_date = Carbon::now();
        return self::getSeasonByStartDate($current_date);
    }

    /**
     * Get the name of the Season that is currently underway
     * @return string||null
     */
    public static function getCurrentSeasonName() {
        $current_season = self::getCurrentSeason();
        return $current_season->season_name;
    }


}
