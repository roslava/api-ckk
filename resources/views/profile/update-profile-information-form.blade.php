<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Информация о профиле пользователя') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Тут можно обновить информацию о профиле пользователя административной паннели.') }}
    </x-slot>

    <x-slot name="form">
       <!-- Name -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="name" value="{{ __('Имя:') }}" />
            <x-jet-input id="name" type="text" class="tw-mt-1 tw-block tw-w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="tw-mt-2" />
        </div>

        <!-- Email -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="email" value="{{ __('Email-адрес:') }}" />
            <x-jet-input id="email" type="email" class="tw-mt-1 tw-block tw-w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="tw-mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="tw-mr-3" on="saved">
            {{ __('Сохранено.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Сохранить') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
