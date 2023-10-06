<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];



    public function settings(): Collection
    {
        return $this->settingsRelation()
                ->get()
                ->mapWithKeys(fn ($setting) => [
                    $setting->key => $setting->value
                ]);
    }

    public function getSettingsAttribute(): Collection
    {
        return $this->settings();
    }

    public function setting($key, $default = null)
    {
        return $this->settings[$key] ?? $default;
    }

    public function ownedTeams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function memberOfTeams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }


    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'owner');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'sender_id', 'id');
    }

    public function signature(): MorphOne
    {
        return $this->morphOne(Signature::class, 'model');
    }

    public function settingsRelation(): MorphMany
    {
        return $this->morphMany(Setting::class, 'model');
    }
}
