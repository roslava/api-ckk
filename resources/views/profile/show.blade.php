

    @extends('layouts.app')
@section('title', 'Профиль')

@section('content')






    
<x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="">
           
           
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="tw-mt-10 sm:tw-mt-0">
                @livewire('profile.update-profile-information-form')
                </div>
                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="tw-mt-10 sm:tw-mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="tw-mt-10 sm:tw-mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <x-jet-section-border />

        </div>
    </div>

    @endsection