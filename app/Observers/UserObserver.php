<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function saving(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleting(User $user): void
    {
        if ($user->contacts->isNotEmpty()) {
            $user->contacts()->delete();
        }

        if ($user->messages->isNotEmpty()){
            $user->messages()->delete();
        }

        if ($user->ownedTeams->isNotEmpty()) {
            $team = $user->ownedTeams->first();
            if ($team->members->isEmpty()) {
                $team->delete();
            } else {
                $team->user_id = $team->members->first()->id;
                $team->save();
            }
        }
    }

}
