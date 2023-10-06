<?php

namespace App\Livewire\Settings;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SettingsProfile extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public User $user;

    public ?array $userData = [];
    public ?array $passwordData = [];

    public function mount()
    {
        $this->user = User::findOrFail(Auth::id());
        $this->editUserForm->fill($this->user->toArray());
        $this->editPasswordForm->fill();
    }

    protected function getForms(): array
    {
        return [
            'editUserForm',
            'editPasswordForm',
        ];
    }

    public function editUserForm(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Naam')
                    ->required(),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->unique(ignorable: $this->user)
                    ->required(),
            ])
            ->model($this->user)
            ->statePath('userData');
    }

    public function editPasswordForm(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('currentPassword')
                    ->label('Huidige wachtwoord')
                    ->required()
                    ->password(),
                TextInput::make('password')
                    ->label('Nieuw wachtwoord')
                    ->required()
                    ->password(),
                TextInput::make('confirmPassword')
                    ->label('Herhaal wachtwoord')
                    ->required()
                    ->same('password')
                    ->password(),
            ])
            ->statePath('passwordData');
    }

    public function submitUserData(): void
    {
        $this->user->name = $this->editUserForm->getState()['name'];
        $this->user->email = $this->editUserForm->getState()['email'];

        if ($this->user->save()) {
            Notification::make()
                ->title('Gegevens succesvol aangepast')
                ->success()
                ->send();
            return;
        }

        Notification::make()
            ->title('Er is iets foutgegaan met het opslaan. Probeer opnieuw')
            ->danger()
            ->send();
    }

    public function submitPasswordData(): void
    {
        if (Hash::check($this->editPasswordForm->getState()['currentPassword'], $this->user->password)) {
            $this->user->password = Hash::make($this->editPasswordForm->getState()['password']);
            if ($this->user->save()) {
                Notification::make()
                    ->title('Wachtwoord succesvol aangepast')
                    ->success()
                    ->send();
                return;
            }
            Notification::make()
                ->title('Er is iets foutgegaan tijdens het opslaan. Probeer opnieuw')
                ->danger()
                ->send();
            return;
        }
        Notification::make()
            ->title('Ingevoerde wachtwoord komt niet overeen met huidige wachtwoord')
            ->danger()
            ->send();
    }


    public function deleteAccountAction(): Action
    {
        return DeleteAction::make('deleteAccount')
            ->requiresConfirmation()
            ->label('Verwijder account')
            ->before(function (Action $action) {
                if (($action->getRecord()->ownedTeams)->isNotEmpty()) {
                    Notification::make()
                        ->title('Kan account niet verwijderen')
                        ->body('Omdat u eigenaar ben van een administratie kan uw account niet worden verwijderd. Neem contact op met Uteq om dit op te lossen')
                        ->duration(10000)
                        ->danger()
                        ->send();
                    $action->cancel();
                }
            })
            ->modalHeading('Verwijder account')
            ->modalDescription('Weet je zeker dat je je account wilt verwijderen?')
            ->modalSubmitActionLabel('Ja, account verwijderen')
            ->color('danger')
            ->record($this->user)
            ->successRedirectUrl(route('register'));
    }

    public function render()
    {
        return view('livewire.settings.settings-profile');
    }
}
