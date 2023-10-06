<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;

class Settings extends Component
{
    public User $user;

    public function mount() {

    }

    public function render()
    {
        return view('livewire.settings.settings');
    }
}
