<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Platform
 *
 * @property string $id
 * @property string $platform_friendly
 * @property string $fn_api_code
 * @property string|null $fn_api_username_wrapper
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereFnApiCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereFnApiUsernameWrapper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform wherePlatformFriendly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Platform extends Model
{
    protected $casts = ['id' => 'string'];
}
