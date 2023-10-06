<?php

namespace App\Actions;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class InviteUserToTeam
{
    public function __invoke(Team $team, string $email, string $name): bool
    {
        $user = $this->checkUserExists($email) ?? $this->createUser($name, $email);

        if ($this->userPartOrOwnerOfTeam($user)) {
            return false;
        }

        if ($this->checkInvitationAlreadyExists($team, $user)) {
            return false;
        }

        $this->addUserToTeam($team, $user);

        $invitation = $this->createInvitation($team, $user);
        $this->inviteUserToTeam($invitation, User::find(Auth::id())->first());

        return true;
    }

    private function checkUserExists(string $email): Builder|User|null
    {
        return User::query()->where('email', $email)->first() ?? null;
    }

    private function createUser(string $name, string $email)
    {
        return User::create([
            'name' => $name,
            'email' => $email,
        ]);
    }

    private function userPartOrOwnerOfTeam(Builder|User $user): bool
    {

        if ($user->ownedTeams->isEmpty()) {
            return false;
        }

        if ($user->memberOfTeams->isEmpty()) {
            return false;
        }

        return true;
    }

    private function checkInvitationAlreadyExists(Team $team, User $user): bool
    {
        return TeamInvitation::query()
            ->where('invited_user_id', $user->id)
            ->where('team_id', $team->id)
            ->get()
            ->isNotEmpty();
    }

    private function addUserToTeam(Team $team, User $user): void
    {
        $team->users()->attach($user);
    }

    private function createInvitation(Team $team, User $user)
    {
        return TeamInvitation::create([
            'invited_user_id' => $user->id,
            'team_id' => $team->id,
            'email' => $user->email,
            'expiration_date' => Carbon::now()->addWeek()->toDateString(),
        ]);
    }

    private function inviteUserToTeam(TeamInvitation $invitation, User $sender): void
    {
//        \App\Jobs\SendTeamInvitationMailJob::dispatch($invitation, $sender);
    }

}
