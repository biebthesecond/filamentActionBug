@props(['back_route', 'action', 'plural', 'singular'])

<x-slot name="header">{{ __(ucfirst($plural)) }}</x-slot>

<div class="bg-white shadow rounded-lg">
    <form wire:submit.prevent="submit">
        <div class="px-4 pt-6 pb-3 sm:px-6">
            <div class="sm:flex sm:items-center mb-6">
                <a href="{{ route($back_route) }}" class="w-auto shadow bg-teal-500 ring-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-semibold py-2 px-4 rounded transition ring-offset-2 active:ring-2 flex">
                    <svg class="w-5 h-5 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Terug
                </a>
                <div class="mt-6 sm:mt-0 sm:ml-3">
                    @switch($action)
                        @case('create')
                            <h2 class="leading-none text-xl text-gray-800 font-bold">Nieuwe {{ $singular }} maken</h2>
                            @break
                        @case('edit')
                            <h2 class="leading-none text-xl text-gray-800 font-bold">{{ ucfirst($singular) }} bewerken</h2>
                            @break
                    @endswitch
                </div>
            </div>
            {{ $slot }}
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-b-lg">
            <button class="text-center shadow bg-teal-500 ring-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-semibold py-2 px-4 rounded transition ring-offset-2 active:ring-2" type="submit">
                Opslaan
            </button>
        </div>
    </form>
</div>
