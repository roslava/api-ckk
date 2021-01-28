<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="tw-mb-4 tw-text-sm tw-text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="tw-mb-4 tw-font-medium tw-text-sm tw-text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="tw-mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="tw-block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
