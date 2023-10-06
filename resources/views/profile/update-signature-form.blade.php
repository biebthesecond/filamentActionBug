<x-form-section submit="updateSignature" id="updateSignature" :withoutTitle="$withoutTitle">
    <x-slot name="title">
        {{ __('Create signature') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create a signature that will be send to all you contacts.') }}
    </x-slot>

    <x-slot name="form">
        <div x-data="{logoName: null, logoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file"
                   class="hidden"
                   wire:model="logo"
                   x-ref="logo"
                   x-on:change="
                        logoName = $refs.logo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            logoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.logo.files[0]);
                    " />

            <x-label for="logo" value="{{ __('Logo') }}" />

            <!-- Current Profile Photo -->
            @if ($this->user->signature && $this->user->signature->logo_url)
            <div class="mt-2" x-show="! logoPreview">

                <img src="{{ $this->user->signature->logo_url }}"
                     alt="{{ $this->user->signature->signature }}"
                     class="w-full object-cover"
                />
            </div>
            @endif

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="logoPreview">
                <span class="block w-full h-32"
                      x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + logoPreview + '\');'">
                </span>
            </div>

            <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.logo.click()">
                {{ __('Upload een logo') }}
            </x-secondary-button>

            @if ($this->user->signature?->logo_path)
                <x-secondary-button type="button" class="mt-2" wire:click="deleteLogo">
                    {{ __('Logo verwijderen') }}
                </x-secondary-button>
            @endif

            <x-input-error for="logo" class="mt-2" />
        </div>

        <div class="col-span-6">
            <label>
                {{ __('Signature') }}
                <textarea rows="5" class="w-full border p-5" wire:model.lazy="state.signature"></textarea>
            </label>
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
