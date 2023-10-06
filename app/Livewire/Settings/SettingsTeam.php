<?php

namespace App\Livewire\Settings;

use App\Actions\InviteUserToTeam;
use App\Models\Team;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class  SettingsTeam extends Component implements HasTable, HasForms, HasActions
{
    use InteractsWithTable;
    use InteractsWithForms;
    use InteractsWithActions;

    public ?Team $team = null;

    public string $teamName = '';
    private array $teamMemberIds = [];
    public bool $isTeamAdmin = true;


    public function mount()
    {
        $this->team = Auth::user()->ownedTeams->where('personal_team', false)->first();

        if ($this->team == null) {
            $this->team = Auth::user()->memberOfTeams->first();
            if ($this->team == null) {
                return;
            }

            $this->isTeamAdmin = false;
        }

        $this->teamName = $this->team->name ?? '';
        $this->teamMemberIds = $this->team->members->isEmpty()
            ? []
            : $this->team->members->pluck('id')->toArray();
    }

    public function updatedTeamName(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application|null
    {
        $validator = Validator::make(['data' => $this->teamName], ['data' => 'required']);

        if (count($validator->invalid())) {
            Notification::make()
                ->danger()
                ->title('Administratie-naam mag niet leeg zijn')
                ->send();
            $this->teamName = $this->team->name;
            return null;
        }

        if ($this->team == null) {
            Team::create([
                'user_id' => Auth::id(),
                'name' => $this->teamName,
                'personal_team' => false,
            ]);

            /*Redirect to refresh page so table loads in*/
            return redirect(route('settings.team'));
        }

        $this->team->name = $this->teamName;
        $this->team->save();

        return redirect(route('settings.team'));
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                $this->team?->members()->getQuery() ?? Team::query()
            )
            ->columns([

                TextColumn::make('name')
                    ->searchable()
                    ->label('Naam')
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->label('E-mail')
                    ->sortable(),
            ])
            ->actions([
                /*TODO: Op moment van schrijven zit er een bug in filament 3 die ervoor zorgt dat dit niet werkt, tijdelijk bulk actions gebruiken*/
                \Filament\Tables\Actions\Action::make('DissociateTeamMember')
                    ->requiresConfirmation()
                    ->hidden(!$this->isTeamAdmin)
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->action(function () {
                        dd('test');
                    }),

            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkAction::make('DissociateTeamMember')
                    ->requiresConfirmation()
                    ->hidden(!$this->isTeamAdmin)
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->action(function () {
                        dd('test');
                    }),
            ])
//            ->emptyStateHeading('Je hebt nog geen gebruikers in je administratie')
            ->emptyStateDescription('Add person to team');
    }

    public function addUserToTeamAction(): Action
    {
        return Action::make('addUserToTeam')
            ->label('Voeg gebruiker toe aan administratie')
            ->form([
                Repeater::make('users')
                    ->label('Gebruikers')
                    ->addActionLabel('Gebruiker toevoegen')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Naam')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->label('E-mail')
                    ]),
            ])
            ->action(function ($data) {
                foreach ($data['users'] as $user) {
                    if (app(InviteUserToTeam::class)($this->team, $user['email'], $user['name'])) {
                        Notification::make('success')
                            ->success()
                            ->title($user['name'] . 'is succesvol toegevoegd')
                            ->send();
                        continue;
                    }

                    Notification::make('failed')
                        ->danger()
                        ->title($user['name'] . 'is al uitgenodigd of al onderdeel van een administratie ')
                        ->send();
                }
            });
    }

    public function leaveTeamAction(): Action
    {
        return Action::make('leaveTeam')
            ->requiresConfirmation()
            ->label('Administratie verlaten')
            ->modalHeading('Administratie verlaten')
            ->modalDescription('Weet je zeker dat je de administratie wil verlaten?')
            ->modalSubmitActionLabel('Ja, administratie verlaten')
            ->color('danger')
            ->action(function () {
                $this->team->users()->detach(Auth::user());
            });
    }


    public function render()
    {
        return view('livewire.settings.settings-team');
    }
}
