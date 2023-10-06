<?php

namespace App\Livewire\Settings;

use App\Enums\RequestMessageVariables;
use App\Models\Setting;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SettingsRequests extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public ?Setting $defaultRequestMessageSetting;
    public ?Setting $defaultPeriodeRequestMessageSetting;
    public ?array $defaultRequestMessageData = [];
    public ?array $defaultPeriodicRequestMessageData = [];

    public function mount()
    {
        $this->setSettingModels();

        $this->editDefaultRequestMessageForm->fill($this->defaultRequestMessageForm(
            configKey: 'defaultRequestMessage',
            model: $this->defaultRequestMessageSetting
        ));

        $this->editDefaultPeriodicRequestMessageForm->fill($this->defaultRequestMessageForm(
            configKey: 'defaultPeriodicRequestMessage',
            model: $this->defaultPeriodeRequestMessageSetting
        ));
    }

    protected function getForms(): array
    {
        return [
            'editDefaultPeriodicRequestMessageForm',
            'editDefaultRequestMessageForm',
        ];
    }

    public function editDefaultRequestMessageForm(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('defaultMessage')
                    ->label('Standaard bericht')
                    ->rows(8),
            ])
            ->statePath('defaultRequestMessageData');
    }

    public function editDefaultPeriodicRequestMessageForm(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('defaultMessage')
                    ->label('Standaard bericht')
                    ->rows(8),
            ])
            ->statePath('defaultPeriodicRequestMessageData');
    }

    public function submitRequests(): void
    {
        Setting::updateOrCreate(
            [
                'key' => 'defaultRequestMessage',
                'model_id' => Auth::id(),
                'model_type' => User::class,
            ],
            [
                'value' => $this->editDefaultRequestMessageForm->getState()['defaultMessage']
            ]
        );

        Notification::make()
            ->success()
            ->title('Standaard bericht succesvol opgeslagen')
            ->send();
    }

    public function submitPeriodicRequests(): void
    {
        Setting::updateOrCreate(
            [
                'key' => 'defaultPeriodicRequestMessage',
                'model_id' => Auth::id(),
                'model_type' => User::class,
            ],
            [
                'value' => $this->editDefaultPeriodicRequestMessageForm->getState()['defaultMessage']
            ]
        );

        Notification::make()
            ->success()
            ->title('Standaard bericht succesvol opgeslagen')
            ->send();
    }

    private function setSettingModels(): void
    {
        $this->defaultRequestMessageSetting = Setting::query()
            ->where('model_type', User::class)
            ->where('model_id', Auth::id())
            ->where('key', 'defaultRequestMessage')
            ->first();

        $this->defaultPeriodeRequestMessageSetting = Setting::query()
            ->where('model_type', User::class)
            ->where('model_id', Auth::id())
            ->where('key', 'defaultPeriodicRequestMessage')
            ->first();
    }

    private function defaultRequestMessageForm(string $configKey, ?Setting $model): array
    {
        return ['defaultMessage' => $model?->value ??
            str_replace(
                search: RequestMessageVariables::USER->value,
                replace: Auth::user()->name,
                subject: config('requests.'.$configKey)
            )
        ];
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.settings.settings-requests');
    }

}
