<x-jet-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="tw-text-lg tw-font-medium tw-text-gray-900">
            @if ($this->enabled)
                {{ __('You have enabled two factor authentication.') }}
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <div class="tw-mt-3 tw-max-w-xl tw-text-sm tw-text-gray-600">
            <p>
                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="tw-mt-4 tw-max-w-xl tw-text-sm tw-text-gray-600">
                    <p class="tw-font-semibold">
                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                    </p>
                </div>

                <div class="tw-mt-4 dark:tw-p-4 dark:tw-w-56 dark:tw-bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="tw-mt-4 tw-max-w-xl tw-text-sm tw-text-gray-600">
                    <p class="tw-font-semibold">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="tw-grid tw-gap-1 tw-max-w-xl tw-mt-4 tw-px-4 tw-py-4 tw-font-mono tw-text-sm tw-bg-gray-100 tw-rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="tw-mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="tw-mr-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="tw-mr-3">
                            {{ __('Show Recovery Codes') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('Disable') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
