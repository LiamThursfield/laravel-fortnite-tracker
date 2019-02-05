<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlayerLifetimeStats
 *
 * @property int $id
 * @property int $player_id
 * @property string $platform_id
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereKd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereKills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereKpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereMatchesPlayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats wherePlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereSpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereTop1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereTop1Ratio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereTop5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerLifetimeStats whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlayerLifetimeStats extends Model
{
    //
}
