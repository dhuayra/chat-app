<x-form-section submit="saveSettingInformation">
    <x-slot name="title">
        {{ __('Setting Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your setting.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="pusher_app_id" value="{{ __('Pusher App ID') }}" />
            <x-input id="pusher_app_id" type="text" class="mt-1 block w-full" wire:model="pusher_app_id" required />
            <x-input-error for="pusher_app_id" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="pusher_app_key" value="{{ __('Pusher App Key') }}" />
            <x-input id="pusher_app_key" type="text" class="mt-1 block w-full" wire:model="pusher_app_key" required />
            <x-input-error for="pusher_app_key" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="pusher_app_secret" value="{{ __('Pusher App Secret') }}" />
            <x-input id="pusher_app_secret" type="text" class="mt-1 block w-full" wire:model="pusher_app_secret" required />
            <x-input-error for="pusher_app_secret" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="pusher_app_cluster" value="{{ __('Pusher App Cluster') }}" />
            <x-input id="pusher_app_cluster" type="text" class="mt-1 block w-full" wire:model="pusher_app_cluster" required />
            <x-input-error for="pusher_app_cluster" class="mt-2" />
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>