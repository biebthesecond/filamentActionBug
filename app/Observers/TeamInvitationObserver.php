<?php

namespace App\Observers;

use App\Models\TeamInvitation;

class TeamInvitationObserver
{
    /**
     * Handle the TeamInvitation "created" event.
     */
    public function created(TeamInvitation $teamInvitation): void
    {
        //
    }

    /**
     * Handle the TeamInvitation "created" event.
     */
    public function creating(TeamInvitation $teamInvitation): void
    {
        $teamInvitation->uuid = \Illuminate\Support\Str::uuid()->toString();
    }

    /**
     * Handle the TeamInvitation "updated" event.
     */
    public function updated(TeamInvitation $teamInvitation): void
    {
        //
    }

    /**
     * Handle the TeamInvitation "deleted" event.
     */
    public function deleted(TeamInvitation $teamInvitation): void
    {
        //
    }

    /**
     * Handle the TeamInvitation "restored" event.
     */
    public function restored(TeamInvitation $teamInvitation): void
    {
        //
    }

    /**
     * Handle the TeamInvitation "force deleted" event.
     */
    public function forceDeleted(TeamInvitation $teamInvitation): void
    {
        //
    }
}
