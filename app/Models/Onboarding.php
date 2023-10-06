<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'onboarding';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'completed',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the user that the onboarding belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
