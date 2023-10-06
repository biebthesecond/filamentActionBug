<x-app-layout>
    <x-slot name="header">{{ __('Contactpersonen') }}</x-slot>
    <x-slot name="header_action">
        <a href="{{ route('contacts.create') }}" class="text-center shadow bg-teal-500 ring-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-semibold py-2 px-4 rounded transition ring-offset-2 active:ring-2 flex">
            <svg class="w-5 h-5 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Contactpersoon maken
        </a>
    </x-slot>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <ul role="list" class="divide-y divide-gray-200" >
            @forelse($contacts as $contact)
                <li>
                    <div class="px-4 py-4 items-center sm:px-6">
                        <div class="min-w-0 sm:flex sm:items-center sm:justify-between">
                            <div class="truncate">
                                <div class="flex text-sm">
                                    <p class="truncate">
                                        <span class="font-medium mr-2">{{ $contact->name }}</span>
                                        <span class="text-gray-500">{{ $contact->email }}</span>
                                    </p>
                                </div>
                                <div class="mt-2 flex">
                                    <div class="flex items-center text-sm gap-2">
                                        <a href="{{ route('contacts.edit', $contact->id) }}" class="text-center shadow border text-teal-500 border-teal-500 hover:border-teal-400 font-medium py-0.5 px-3 rounded transition active:bg-teal-500 active:text-white">
                                            Bewerken
                                        </a>
                                        <button onclick="Livewire.emit('openModal', 'delete-contact', {'item_id':'{{ $contact->id }}'})" class="text-center shadow border text-teal-500 border-teal-500 hover:border-teal-400 font-medium py-0.5 px-3 rounded transition active:bg-teal-500 active:text-white">
                                            Verwijderen
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <x-data.empty-state
                    plural="contactpersonen"
                    singular="contactpersoon"/>
            @endforelse
        </ul>
    </div>

    @if(session('message') !== null)
        <x-message message="{{ session('message') }}" />
    @endif

</x-app-layout>
