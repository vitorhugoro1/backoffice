<x-jet-form-section submit="updateAnnouncementInformation">
    <x-slot name="title">
        {{ __('Announcent Information') }}
    </x-slot>

    <x-slot name="description"></x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="subject" value="{{ __('Subject') }}" />
            <x-jet-input id="subject" type="text" class="mt-1 block w-full" wire:model.defer="state.subject"
                autocomplete="subject" />
            <x-jet-input-error for="subject" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="start_at" value="{{ __('Start At') }}" />
            <x-jet-input id="start_at" type="date" min="{{ today()->format('Y-m-d') }}" class="mt-1 block w-full"
                wire:model.defer="state.start_at" />
            <x-jet-input-error for="start_at" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="expiration_at" value="{{ __('Expiration At') }}" />
            <x-jet-input id="expiration_at" type="date" min="{{ today()->format('Y-m-d') }}" class="mt-1 block w-full"
                wire:model.defer="state.expiration_at" />
            <x-jet-input-error for="expiration_at" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-jet-label for="content" value="{{ __('Content') }}" />
            <textarea name="content" class="mt-1 block w-full form-input rounded-md shadow-sm" id="content" cols="30"
                rows="6" wire:model.defer="state.content"></textarea>
            <x-jet-input-error for="content" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="save">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>