<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="tw-mb-4" />

        @if (session('status'))
            <div class="tw-mb-4 tw-font-medium tw-text-sm tw-text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="tw-mt-4">
                <x-jet-label for="password" value="{{ __('Пароль') }}" />
                <x-jet-input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

    

            <div class="tw-flex items-center justify-end mt-4">


                <x-jet-button class="tw-mt-6">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
