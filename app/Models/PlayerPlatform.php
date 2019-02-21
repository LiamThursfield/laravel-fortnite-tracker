<?php

namespace App\Models;

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
    //
    protected $table = 'player_platforms';
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
