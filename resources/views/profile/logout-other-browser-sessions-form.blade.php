<x-jet-action-section>
    <x-slot name="title">
        {{ __('Браузерные сессии') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Управление сессиями') }}
    </x-slot>

    <x-slot name="content">
        <div class="tw-max-w-xl tw-text-sm tw-text-gray-600">
            {{ __('Если требуется, вы можете выйти из системы во всех браузерах и других девайсах. Ниже можно узнать, с помощью каких браузеров и устройств выполнялся вход в систему:') }}
        </div>

        @if (count($this->sessions) > 0)
        <div class="tw-mt-5 tw-space-y-6">
            <!-- Other Browser Sessions -->
            @foreach ($this->sessions as $session)
            <div class="tw-flex tw-items-center">
                <div>
                    @if ($session->agent->isDesktop())
                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="tw-w-8 tw-h-8 tw-text-gray-500">
                        <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="tw-w-8 tw-h-8 tw-text-gray-500">
                        <path d="M0 0h24v24H0z" stroke="none"></path>
                        <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                        <path d="M11 5h2M12 17v.01"></path>
                    </svg>
                    @endif
                </div>

                <div class="tw-ml-3">
                    <div class="tw-text-sm tw-text-gray-600">
                        {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                    </div>

                    <div>
                        <div class="tw-text-xs tw-text-gray-500">
                            {{ $session->ip_address }},

                            @if ($session->is_current_device)
                            <span class="tw-text-green-500 tw-font-semibold">{{ __('This device') }}</span>
                            @else
                            {{ __('Last active') }} {{ $session->last_active }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="tw-flex tw-items-center tw-mt-5">
            <x-jet-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Выйти из других браузерных сессий') }}
            </x-jet-button>

            <x-jet-action-message class="tw-ml-3" on="loggedOut">
                {{ __('Done.') }}
            </x-jet-action-message>
        </div>

        <!-- Logout Other Devices Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                {{ __('Выход из других браузерных сессий') }}
            </x-slot>



            <x-slot name="content">
                {{ __('Пожалуйста, введите ваш пароль для подтверждения того, что вы хотите выйти из системы на всех других устройствах.') }}

                <div class="tw-mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="tw-mt-1 tw-block tw-w-3/4" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-jet-input-error for="password" class="tw-mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">


                <div class="profile-ckk__button-save-area">
                    <button class="profile-ckk__button-save" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                        {{ __('Отменить') }}
                    </button>
                </div>



                <div class="profile-ckk__button-save-area">
                    <button class="profile-ckk__button-save" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                        {{ __('Выйти из других сессий!') }}
                    </button>
                </div>


            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>