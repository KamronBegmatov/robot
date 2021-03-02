<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * App\Models\UserFromGoogle
 *
 * @property int $id
 * @property string $name
 * @property string $google_id
 * @property string $email
 * @property string|null $password
 * @property string|null $avatar
 * @property string|null $avatar_original
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereAvatarOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFromGoogle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserFromGoogle extends Authenticatable implements JWTSubject
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
