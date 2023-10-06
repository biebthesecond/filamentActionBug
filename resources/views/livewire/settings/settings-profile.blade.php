<div>
    <x-page-header>
        <x-page-header-title>
            Profiel
        </x-page-header-title>
        {{--        <livewire:page-header-action text="Aanvraag toevoegen" icon="{{ svg('heroicon-o-plus') }}" route="{{ route('requests.add') }}"/>--}}
    </x-page-header>
    <div class="my-10 ">
        Account gegevens aanpassen
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <div>
                    <div class="mt-2">
                        <form wire:submit="submitUserData">

                            {{ $this->editUserForm }}

                            <div class="w-full flex justify-end">
                                <x-filament::button type="submit" class="mt-2">
                                    Opslaan
                                </x-filament::button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-10 ">
        Wachtwoord aanpassen
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <div>
                    <div class="mt-2">
                        <form wire:submit="submitPasswordData">

                            {{ $this->editPasswordForm }}

                            <div class="w-full flex justify-end">
                                <x-filament::button type="submit" class="mt-2">
                                    Opslaan
                                </x-filament::button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-10 ">
        Account verwijderen
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <div>
                    <div class="mt-2">
                        <div class="w-full flex justify-end">
                            {{ $this->deleteAccountAction }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-filament-actions::modals/>
</div>
