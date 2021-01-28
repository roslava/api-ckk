<nav x-data="{ open: false }" class="tw-min-w-full tw-bg-white tw-border-b tw-border-gray-100 tw-mb-15">
    <!-- Primary Navigation Menu -->
    <div
    style="border-left: dotted 1px #cecece;  border-right: dotted 1px #cecece;"
    class="tw-max-w-7xl tw-min-w-full tw-mx-auto tw-px-4 sm:tw-px-6 lg:tw-px-8">
        <div class="tw-flex tw-justify-between tw-h-16">
            <div class="tw-flex">
                
           

                <!-- Navigation Links -->

                <div class="tw-hidden  sm:tw--my-px sm:tw-mr-10 sm:tw-flex">
                    <x-jet-nav-link href="{{ route('articles.index') }}" :active="request()->routeIs('articles')">
                        {{ __('Все статьи') }}
                    </x-jet-nav-link>
                </div>
                <div class="tw-hidden  sm:tw--my-px sm:tw-mr-10 sm:tw-flex">
                    <x-jet-nav-link href="{{ route('articles.create') }}" :active="request()->routeIs('articles/create')">
                        {{ __('Создать статью') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="tw-hidden sm:tw-flex sm:tw-items-center sm:tw-ml-6">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="tw-flex tw-text-sm tw-border-2 tw-border-transparent tw-rounded-full focus:tw-outline-none focus:tw-border-gray-300 tw-transition tw-duration-150 tw-ease-in-out">
                                <img class="tw-h-8 tw-w-8 tw-rounded-full tw-object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <button class="tw-flex tw-items-center tw-text-sm tw-font-medium tw-text-gray-500 hover:tw-text-gray-700 hover:tw-border-gray-300 focus:tw-outline-none focus:tw-text-gray-700 focus:tw-border-gray-300 tw-transition tw-duration-150 tw-ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="tw-ml-1">
                                    <svg class="tw-fill-current tw-h-4 tw-w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="tw-block tw-px-4 tw-py-2 tw-text-xs tw-text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="tw-border-t tw-border-gray-100"></div>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="tw-block tw-px-4 tw-py-2 tw-text-xs tw-text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <div class="tw-border-t tw-border-gray-100"></div>

                            <!-- Team Switcher -->
                            <div class="tw-block tw-px-4 tw-py-2 tw-text-xs tw-text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                            @endforeach

                            <div class="tw-border-t tw-border-gray-100"></div>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="tw--mr-2 tw-flex tw-items-center sm:tw-hidden">
                <button @click="open = ! open" class="tw-inline-flex tw-items-center tw-justify-center tw-p-2 tw-rounded-md tw-text-gray-400 hover:tw-text-gray-500 hover:tw-bg-gray-100 focus:tw-outline-none focus:tw-bg-gray-100 focus:tw-text-gray-500 tw-transition tw-duration-150 tw-ease-in-out">
                    <svg class="tw-h-6 tw-w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'tw-hidden': open, 'tw-inline-flex': ! open }" class="tw-inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'tw-hidden': ! open, 'tw-inline-flex': open }" class="tw-hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'tw-block': open, 'tw-hidden': ! open}" class="tw-hidden sm:tw-hidden">
        <div class="tw-pt-2 tw-pb-3 tw-space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="tw-pt-2 tw-pb-3 tw-space-y-1">
            <x-jet-responsive-nav-link href="{{ route('articles.index') }}" :active="request()->routeIs('articles')">
                {{ __('Все статьи') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="tw-pt-2 tw-pb-3 tw-space-y-1">
            <x-jet-responsive-nav-link href="{{ route('articles.create') }}" :active="request()->routeIs('articles/create')">
                {{ __('Создать статью') }}
            </x-jet-responsive-nav-link>
        </div>
        

        <!-- Responsive Settings Options -->
        <div class="tw-pt-4 tw-pb-1 tw-border-t tw-border-gray-200">
            <div class="tw-flex tw-items-center tw-px-4">
                <div class="tw-flex-shrink-0">
                    <img class="tw-h-10 tw-w-10 tw-rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="tw-ml-3">
                    <div class="tw-font-medium tw-text-base tw-text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="tw-font-medium tw-text-sm tw-text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="tw-mt-3 tw-space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="tw-border-t tw-border-gray-200"></div>

                    <div class="tw-block tw-px-4 tw-py-2 tw-text-xs tw-text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-jet-responsive-nav-link>

                    <div class="tw-border-t tw-border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="tw-block tw-px-4 tw-py-2 tw-text-xs tw-text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
