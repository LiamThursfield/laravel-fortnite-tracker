<?php

namespace App\Helpers;

use App\Models\Platform;

class PlatformHelper {

    /**
     * Get all platforms
     * @param string $order_column
     * @param string $order_direction
     * @return Platform[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAllPlatforms($order_column = 'platform_friendly', $order_direction = 'ASC') {
        return Platform::orderBy($order_column, $order_direction)->get();
    }
}
