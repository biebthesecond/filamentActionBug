<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\Request;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitedToTeam extends Mailable
{
    use Queueable, SerializesModels;

    private User $invitedUser;
    private User $administrationAdmin;
    private TeamInvitation $invitation;

    /**
     * Create a new request instance.
     *
     * @return void
     */
    public function __construct(TeamInvitation $invitation, User $administrationAdmin)
    {
        $this->administrationAdmin = $administrationAdmin;
        $this->invitedUser = User::find($invitation->invited_user_id)->first();
        $this->invitation = $invitation;
    }

    /**
     * Build the request.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('[Safesent] ' . $this->administrationAdmin->name . ' heeft je uitgenodigd voor zijn administratie')
            ->markdown('mail.invited-to-team')
            ->from('no-reply@uteq.nl')
            ->to($this->invitation->email)
            ->with([
                'invitedUser' => $this->invitedUser,
                'administrationAdmin' => $this->administrationAdmin,
                'invitation' => $this->invitation,
            ]);
    }
}
