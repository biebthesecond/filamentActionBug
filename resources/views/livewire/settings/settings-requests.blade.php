<div>
    <x-page-header>
        <x-page-header-title>
            Aanvragen
        </x-page-header-title>
    </x-page-header>
    <div class="my-10 ">
        Aanvragen standaard bericht
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <div>
                    <div class="mt-2">
                        <form wire:submit="submitRequests">

                            {{ $this->editDefaultRequestMessageForm }}

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
        Periodieke aanvragen standaard bericht
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <div>
                    <div class="mt-2">
                        <form wire:submit="submitPeriodicRequests">

                            {{ $this->editDefaultPeriodicRequestMessageForm }}

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

    <div x-data="{slideOverOpen: true}">
        <div x-show="!slideOverOpen" x-transition>
            <x-filament::button x-on:click="slideOverOpen = true" class="mt-2">
                Toon bericht variabelen
            </x-filament::button>
        </div>
        <livewire:settings.settings-request-message-variables-slide-over/>
    </div>

    <x-filament-actions::modals/>
</div>
