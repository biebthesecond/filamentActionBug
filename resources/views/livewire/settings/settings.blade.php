<div>
    <x-page-header-title>
        Instellingen
    </x-page-header-title>

    <ul role="list" class="divide-y divide-gray-100 border-gray-400 border-2 rounded mt-10">
        <li class="transition-colors duration-300 ease-in-out hover:bg-gray-200 cursor-pointer">
            <a href="{{ route('settings.team') }}" wire:navigate
               class="py-5 px-2 flex justify-between gap-x-6">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">Administratie</p>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </div>
            </a>
        </li>
        <li class="transition-colors duration-300 ease-in-out hover:bg-gray-200 cursor-pointer">
            <a href="{{ route('settings.profile') }}" wire:navigate
               class="py-5 px-2 flex justify-between gap-x-6">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">Profiel</p>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </div>
            </a>
        </li>
        <li class="transition-colors duration-300 ease-in-out hover:bg-gray-200 cursor-pointer">
            <a href="{{ route('settings.requests') }}" wire:navigate
               class="py-5 px-2 flex justify-between gap-x-6">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">Aanvragen</p>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </div>
            </a>
        </li>
    </ul>

</div>
