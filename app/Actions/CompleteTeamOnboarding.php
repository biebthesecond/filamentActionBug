<?php

namespace App\Actions;

use App\Enums\OnboardingTypeEnum;
use App\Models\Onboarding;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CompleteTeamOnboarding
{
    public function __invoke(string $teamName, array $users): void
    {
        $team = $this->createTeam($teamName);

        foreach ($users as $name => $email) {
            app(InviteUserToTeam::class)($team, $email, $name);
        }

        $this->registerOnboardingComplete();
    }

    private function createTeam(string $teamName)
    {
        return Team::create([
            'user_id' => Auth::id(),
            'name' => $teamName,
            'personal_team' => false
        ]);
    }

    private function registerOnboardingComplete(): void
    {
        Onboarding::create([
            'user_id' => Auth::id(),
            'type' => OnboardingTypeEnum::TEAM->value,
            'completed' => true
        ]);
    }
}
