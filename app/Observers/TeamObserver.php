<?php

namespace App\Observers;

use App\Models\Team;

class TeamObserver
{
    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "updated" event.
     */
    public function updated(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        //
    }

    public function deleting(Team $team)
    {
        if ($team->teamInvitations->isNotEmpty()) {
            $team->teamInvitations()->delete();
        }

        if ($team->members->isNotEmpty()) {
            $team->members()->detach();
        }

        if ($team->contacts->isNotEmpty()) {
            $team->contacts()->delete();
        }

        if ($team->requests->isNotEmpty()) {
            $team->requests()->delete();
        }
    }

    /**
     * Handle the Team "restored" event.
     */
    public function restored(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "force deleted" event.
     */
    public function forceDeleted(Team $team): void
    {
        //
    }
}
