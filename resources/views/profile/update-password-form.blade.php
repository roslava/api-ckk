<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Изменить пароль') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Убедитесь, что вы используете достаточно длинный пароль.') }}
    </x-slot>

    <x-slot name="form">
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="current_password" value="{{ __('Текущий пароль:') }}" />
            <x-jet-input id="current_password" type="password" class="tw-mt-1 tw-block tw-w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="tw-mt-2" />
        </div>

        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="password" value="{{ __('Новый пароль:') }}" />
            <x-jet-input id="password" type="password" class="tw-mt-1 tw-block tw-w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="tw-mt-2" />
        </div>

        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('Подтвердить новый пароль:') }}" />
            <x-jet-input id="password_confirmation" type="password" class="tw-mt-1 tw-block tw-w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="tw-mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="tw-mr-3" on="saved">
            {{ __('Сохранено.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Сохранить') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
