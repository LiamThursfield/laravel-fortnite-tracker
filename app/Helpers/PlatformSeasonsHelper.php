<?php

namespace App\Helpers;

class PlatformSeasonsHelper {

    /**
     * Return an array of seasons and active platforms
     * Optionally, with a Combined platforms option in the array
     * @param bool $with_combined_platforms
     * @return array
     */
    public static function getActive($with_combined_platforms = true) {
        // If Combined platforms is an option, add it to the array
        if ($with_combined_platforms) {
            $platforms = ['combined' => 'Combined'];
        } else {
            $platforms = [];
        }
        foreach (PlatformHelper::getAllPlatforms() as $platform) {
            $platforms[$platform->id] = $platform->platform_friendly;
        }

        $seasons = PlayerPlaylistStatsHelper::getActiveSeasons();

        return compact('platforms', 'seasons');
    }

}
