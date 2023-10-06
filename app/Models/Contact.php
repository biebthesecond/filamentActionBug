<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'owner_id',
        'owner_type',
        'email',
    ];


    public function scopeCurrentUser($query)
    {
        return $query
            ->where(function ($query) {
                $query->where('owner_type', User::class)
                    ->where('owner_id', Auth::id());
            })->orWhere(function ($query) {
                $query->where('owner_type', Team::class)
                    ->where('owner_id', Auth::user()->memberOfTeams->first() != null
                        ? Auth::user()->memberOfTeams->first()->id
                        : false);
            });
    }

    public function getOwnerTypeStatusAttribute(): string
    {
        if ($this->owner_type == Team::class) {
            return 'Van mijn team';
        }
        return 'Van mij';
    }

    /**
     * Get the owner of the contact.
     */
    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id', 'id');
    }

    /**
     * Get the contact's requests.
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'contact_id', 'id');
    }
}
