<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlayerPlaylistStats
 *
 * @property int $id
 * @property int $player_id
 * @property string $platform_id
 * @property string $playlist
 * @property string $period
 * @property int $matches_played
 * @property int $kills
 * @property float $kd
 * @property float $kpm
 * @property int $score
 * @property float $spm
 * @property int $top_1
 * @property float $top_1_ratio
 * @property int $top_5
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereKd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereKills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereKpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereMatchesPlayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats wherePlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats wherePlaylist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereSpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereTop1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereTop1Ratio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereTop5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerPlaylistStats whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlayerPlaylistStats extends Model
{
    protected $guarded = [];

    /**
     * Get the Player that the stats belong to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player() {
        return $this->belongsTo('App\Models\Player');
    }
}
