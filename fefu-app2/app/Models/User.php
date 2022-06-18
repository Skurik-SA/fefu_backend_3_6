<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $github_id
 * @property \Illuminate\Support\Carbon|null $github_logged_in_at
 * @property \Illuminate\Support\Carbon|null $github_registered_at
 * @property \Illuminate\Support\Carbon|null $app_logged_in_at
 * @property \Illuminate\Support\Carbon|null $app_registered_at
 * @property string|null $vkontakte_id
 * @property \Illuminate\Support\Carbon|null $vkontakte_logged_in_at
 * @property \Illuminate\Support\Carbon|null $vkontakte_registered_at
 * @property string|null $google_id
 * @property \Illuminate\Support\Carbon|null $google_logged_in_at
 * @property \Illuminate\Support\Carbon|null $google_registered_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAppLoggedInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAppRegisteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubLoggedInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubRegisteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleLoggedInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleRegisteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVkontakteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVkontakteLoggedInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVkontakteRegisteredAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'github_id',
        'github_logged_in_at',
        'github_registered_at',
        'vkontakte_id',
        'vkontakte_logged_in_at',
        'vkontakte_registered_at',
        'google_id',
        'google_logged_in_at',
        'google_registered_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'github_id',
        'vkontakte_id',
        'google_id',
        'app_logged_in_at',
        'app_registered_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'github_logged_in_at' => 'datetime',
        'github_registered_at' => 'datetime',
        'vkontakte_logged_in_at' => 'datetime',
        'vkontakte_registered_at' => 'datetime',
        'google_logged_in_at' => 'datetime',
        'google_registered_at' => 'datetime',
        'app_logged_in_at' => 'datetime',
        'app_registered_at' => 'datetime',
    ];

    public static function createFromRequest(array $requestedData) : self
    {
        $user = new User();
        $user->name = $requestedData['name'];
        $user->email = $requestedData['email'];
        $user->password = Hash::make($requestedData['password']);
        $user->save();

        return $user;
    }

    public static function changeFromRequest(User $user, array $requestedData) : self {
        $user->password = Hash::make($requestedData['password']);
        $user->app_logged_in_at = Carbon::now();
        $user->app_registered_at = Carbon::now();
        $user->save();

        return $user;
    }
}
