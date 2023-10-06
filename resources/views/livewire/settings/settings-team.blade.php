<div>
    <x-page-header>
        <x-page-header-title>
            Administratie
        </x-page-header-title>
        {{--        <livewire:page-header-action text="Aanvraag toevoegen" icon="{{ svg('heroicon-o-plus') }}" route="{{ route('requests.add') }}"/>--}}
    </x-page-header>
    <div class="my-10 w-full flex justify-center">
        <div class="w-full overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:p-6">
                <div>
                    <label for="teamName"
                           class="block text-sm font-medium leading-6 text-gray-900">team name, if empty add text to create team.</label>
                    <div class="mt-2">
                        @if($isTeamAdmin)
                            <input type="text" name="teamName" id="teamName" wire:model.lazy="teamName"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @else
                            <input type="text" disabled id="teamName" value="{{$teamName}}"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($this->team))
        <div>
            <div class="w-full flex justify-between py-2">
                <h2 class="text-lg text-gray-800 p-0">Leden administratie</h2>
                @if($isTeamAdmin)
                    {{ $this->addUserToTeamAction }}
                    @else
                    {{ $this->leaveTeamAction }}
                @endif
            </div>
            {{ $this->table }}
        </div>
    @endif
    <x-filament-actions::modals/>
</div>
