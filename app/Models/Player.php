<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Player
 *
 * @property int $id
 * @property string|null $account_id
 * @property string $username
 * @property int $is_epic_account
 * @property string|null $fetched_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereIsEpicAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereLastFetchedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereUsername($value)
 * @mixin \Eloquent
 */
class Player extends Model {

    /**
     * The platforms the Player plays on
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function platforms() {
        return $this->belongsToMany('App\Models\Platform', 'player_platforms')->withTimestamps();
    }

}
