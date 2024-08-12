<x-form-section submit="save">
    <x-slot name="title">
        {{ __('Telegram UserId') }}
    </x-slot>

    <x-slot name="description">
        {{ __('User ID для отправки уведомлений ботом.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="user_id" value="{{ __('user_id') }}" />
            <x-input id="user_id" class="mt-1 block w-full" wire:model="user_id" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
