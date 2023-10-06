<x-form-section submit="updateMessage" id="updateMessage" :withoutTitle="$withoutTitle ?? false">
    <x-slot name="title">
        {{ __('Message settings') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Decide what happens whenever a message is sent.') }}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('Acknowledgment of receipt') }}
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>{{ __('Decide what data to show in the e-mail send to you, whenever an e-mail is sent.') }}</p>
            </div>
        </div>

        <div class="col-span-6 flex flex-col gap-2">
            <div class="flex items-center gap-2">
                <x-input id="acknowledgment_of_receipt_show_subject" type="checkbox" class="form-checkbox block h-6 w-6 text-teal-700" value="1" wire:model.defer="state.acknowledgment_of_receipt_show_subject" />
                <x-label for="acknowledgment_of_receipt_show_subject" value="{{ __('Show subject') }}" />
            </div>
            <x-input-error for="acknowledgment_of_receipt_show_subject" class="mt-2" />

            <div class="flex items-center gap-2">
                <x-input id="acknowledgment_of_receipt_show_content" type="checkbox" class="form-checkbox block h-6 w-6 text-teal-700" value="1" wire:model.defer="state.acknowledgment_of_receipt_show_content" />
                <x-label for="acknowledgment_of_receipt_show_content" value="{{ __('Show content') }}" />
            </div>
            <x-input-error for="acknowledgment_of_receipt_show_content" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="logo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
