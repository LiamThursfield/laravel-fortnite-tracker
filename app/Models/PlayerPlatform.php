<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\PlayerPlatform
 *
 * *
 * @property int $id
 * @property int $player_id
 * @property string $platform_id
 * @property \Illuminate\Support\Carbon|null $fetched_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlatform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlatform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlatform query()
 * @mixin \Eloquent
 */
class PlayerPlatform extends Pivot
{
    protected $table = 'player_platforms';

    /**
     * Get Player Platforms that have not been fetched for more than $min_minutes
     * @param int $min_minutes
     * @return PlayerPlatform
     */
    public static function requiresFetching($min_minutes = 5) {
        return self::where(function ($player_platform) use ($min_minutes) {
            $player_platform->where('fetched_at', '<', Carbon::now()->subMinutes($min_minutes))
                ->orWhereNull('fetched_at')
                ->orderBy('fetched_at', 'asc');
        })->whereHas('player', function ($q) {
            $q->whereNotNull('account_id');
        });
    }

    /**
     * Get the Platform that the PlayerPlatform belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player() {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the Platform that the PlayerPlatform belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function platform() {
        return $this->belongsTo(Platform::class);
    }
}
