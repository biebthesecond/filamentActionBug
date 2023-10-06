<div>
    <div class="relative z-0" aria-labelledby="slide-over-title" role="dialog" aria-modal="true"
         x-show="slideOverOpen">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        {{--        <div class="fixed inset-0"></div>--}}

        <div class="{{--fixed inset-0--}} overflow-hidden">
            <div class="{{--absolute inset-0--}} overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                     x-show="slideOverOpen"
                     x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full">

                    <!--
                      Slide-over panel, show/hide based on slide-over state.

                      Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                        From: "translate-x-full"
                        To: "translate-x-0"
                      Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                        From: "translate-x-0"
                        To: "translate-x-full"
                    -->
                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="bg-primary-600 px-4 py-6 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-base font-semibold leading-6 text-white" id="slide-over-title">Te
                                        gebruiken variabelen</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button"
                                                x-on:click="slideOverOpen = !slideOverOpen"
                                                class="relative rounded-md bg-primary-600 text-primary-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                                            <span class="absolute -inset-2.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                 stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <p class="text-sm text-white">De onderstaande variabelen zijn te gebruiken in het bericht zodat tijdens het aanmaken van een aanvraag deze velden automatisch ingevuld kunnen worden. </p>
                                </div>
                            </div>
                            <div class="relative flex-1 px-4 py-6 sm:px-6">
                                <ul role="list" class="grid grid-cols-1 gap-6 ">
                                    @foreach(\App\Enums\RequestMessageVariables::options() as $option)
                                        <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                                            <div class="flex w-full items-center justify-between space-x-6 p-6">
                                                <div class="flex-1 truncate">
                                                    <div class="flex items-center space-x-3">
                                                        <h3 class="truncate text-sm font-medium text-gray-900">{{ $option['message'] }}</h3>
                                                    </div>
                                                    <p class="mt-1 truncate text-sm text-gray-500">{{ $option['value'] }}</p>
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
