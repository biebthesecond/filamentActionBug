<x-app-layout>
    <x-slot name="header">{{ __('Automatiseringen') }}</x-slot>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <ul role="list" class="divide-y divide-gray-200" >
            @forelse($automations as $automation)
                <li x-data="{ open: sessionStorage.getItem('open-{{ $automation->id }}' || 'false') }"
                      x-init="$watch('open', (val) => sessionStorage.setItem('open-{{ $automation->id }}', val))" class="hover:bg-gray-50 transition-colors">
                    <button x-on:click="open = open == 'false' ? 'true' : 'false'" class="block w-full">
                        <div class="px-4 py-4 flex items-center sm:px-6">
                            <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                <div class="truncate">
                                    <div class="flex text-sm">
                                        <p class="font-medium truncate text-teal-500">{{ $automation->model->name }}</p>
                                    </div>
                                    <div class="mt-2 flex text-sm items-center text-gray-500">
                                        <p class="truncate">
                                            {{ $automation->requests->count() }} verzoek(en), {{ $automation->requests->where('handed_in_at', '!=', null)->count() }} ontvangen
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-5 flex-shrink-0 transition" x-bind:class="{'rotate-180': open == 'true'}">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="h-5 w-5 text-gray-400" style="vertical-align: -0.125em; transform: rotate(90deg);"><g fill="none"><path d="M9 5l7 7l-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                            </div>
                        </div>
                    </button>
                    <div x-show="open == 'true'" x-collapse>
                        <div class="px-4 pb-4 sm:px-6">
                            <div class="flex sm:justify-between flex-col sm:flex-row gap-y-2">
                                <div class="flex justify-center">
                                    <div
                                        x-data="{
                                            open: false,
                                            toggle() {
                                                if (this.open) {
                                                    return this.close()
                                                }
                                                this.$refs.button.focus()
                                                this.open = true
                                            },
                                            close(focusAfter) {
                                                if (! this.open) return
                                                this.open = false
                                                focusAfter && focusAfter.focus()
                                            }
                                        }"
                                        x-on:keydown.escape.prevent.stop="close($refs.button)" x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" class="w-full">

                                        <!-- Button -->
                                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')" type="button" class="inline-flex w-full text-center box-border shadow border-2 border-teal-500 ring-teal-400 hover:border-teal-400 hover:bg-gray-100 focus:shadow-outline focus:outline-none text-teal-500 hover:text-teal-400 font-semibold py-1.5 px-4 rounded transition ring-offset-2 active:ring-2 flex justify-between">
                                            Acties
                                            <svg x-bind:class="{'rotate-180': open}" class="w-5 h-5 mt-0.5 ml-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <!-- Panel -->
                                        <div class="relative w-auto">
                                            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;" class="absolute mt-1 bg-white rounded border-2 border-teal-500 text-teal-500 shadow-lg overflow-hidden">
                                                <button onclick="Livewire.emit('openModal', 'export-automation-to-automation', {'item_id':'{{ $automation->id }}'})" class="flex px-4 py-2 text-left text-sm font-medium hover:bg-gray-100 hover:text-teal-400 transition">
                                                    <svg class="w-4 h-4 mt-0.5 -ml-1 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <p class="whitespace-nowrap">Automatisering dupliceren</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('automations.create', $automation->id) }}" class="inline-flex text-center shadow bg-teal-500 ring-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-semibold py-2 px-4 rounded transition ring-offset-2 active:ring-2 flex">
                                    <svg class="w-5 h-5 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Verzoek maken
                                </a>
                            </div>
                            <div class="w-full mt-3 border rounded-lg divide-y text-sm">
                                @forelse($automation->requests as $request)
                                    <div class="px-5 py-4">
                                        <div class="flex gap-x-4 flex-wrap">
                                            <p class="flex-grow order-1 font-medium leading-relaxed truncate">{{ $request->name }}</p>
                                            @if($request->sent_at && !$request->handed_in_at && now() < $request->end_date)
                                                <a href="{{ route('automations.requests.remind', $request->id) }}" class="flex-initial order-3 w-full sm:w-auto sm:order-2 my-2 sm:my-0 flex text-center shadow text-white bg-teal-500 hover:bg-teal-400 font-semibold py-0.5 px-3 rounded transition ring-teal-400 focus:shadow-outline focus:outline-none ring-offset-2 active:ring-2 transition @if(session('id') === $request->id) opacity-50 pointer-events-none @endif">
                                                    <svg class="w-4 h-4 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                                    </svg>
                                                    Herinnering sturen
                                                </a>
                                            @endif
                                            @if($request->handed_in_at)
                                                <span class="flex-initial inline-flex order-2 sm:order-3 items-center px-2.5 py-0.5 rounded-full text-xs bg-green-100 text-green-800">
                                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Ontvangen
                                                </span>
                                            @elseif(!$request->sent_at)
                                                <span class="flex-initial inline-flex order-2 sm:order-3 items-center px-2.5 py-0.5 rounded-full text-xs bg-gray-100 text-gray-800">
                                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-gray-500" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Verzoek nog niet verzonden
                                                </span>
                                            @elseif(now() >= $request->end_date)
                                                <span class="flex-initial inline-flex order-2 sm:order-3 items-center px-2.5 py-0.5 rounded-full text-xs bg-red-100 text-red-800">
                                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-500" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Verlopen
                                                </span>
                                            @elseif(!$request->handed_in_at)
                                                <span class="flex-initial inline-flex order-2 sm:order-3 items-center px-2.5 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-800">
                                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-500" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    In afwachting
                                                </span>
                                            @endif
                                        </div>
                                        @forelse($request->request_documents as $document)
                                            @if($request->handed_in_at)
                                                <a @if($document->getMedia('files')->first() != null) href="{{ $document->getMedia('files')->first()->getUrl() }}" @endif class="flex text-teal-500" download>
                                                    <svg class="w-4 h-4 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                    </svg>
                                                    <p class="leading-relaxed">{{ $document->name }}</p>
                                                </a>
                                            @else
                                                <div class="flex text-gray-500">
                                                    <svg class="w-4 h-4 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <p class="leading-relaxed">{{ $document->name }}</p>
                                                </div>
                                            @endif
                                        @empty
                                            <div class="flex text-gray-500">
                                                <svg class="w-4 h-4 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                                <p class="leading-relaxed">Dit verzoek bevat momenteel geen documenten</p>
                                            </div>
                                        @endforelse
                                        <div class="mt-2 flex">
                                            <div class="flex items-center text-sm gap-2">
                                                <a href="{{ route('automations.edit', $request->id) }}" class="text-center shadow border text-teal-500 border-teal-500 hover:border-teal-400 font-medium py-0.5 px-3 rounded transition active:bg-teal-500 active:text-white">
                                                    Bewerken
                                                </a>
                                                <button onclick="Livewire.emit('openModal', 'delete-request', {'item_id':'{{ $request->id }}'})" class="text-center shadow border text-teal-500 border-teal-500 hover:border-teal-400 font-medium py-0.5 px-3 rounded transition active:bg-teal-500 active:text-white">
                                                    Verwijderen
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <x-data.empty-state
                                        plural="verzoeken"
                                        singular="verzoek"/>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <div class="text-center my-14">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Geen automatiseringen</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Er zijn op dit moment geen contactpersonen, en daardoor ook geen automatiseringen.<br>
                        Voeg een contactpersoon toe door naar de pagina 'Contactpersonen' te gaan en op 'Contactpersoon maken' te klikken.
                    </p>
                </div>

            @endforelse
        </ul>
    </div>

    @if(session('message') !== null)
        <x-message message="{{ session('message') }}" />
    @endif

</x-app-layout>
