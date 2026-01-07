<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <style>
        div[x-show="open"] .rounded-md {
            background-color: #0f1b3d !important;
            border: 1px solid var(--color-primary) !important;
            box-shadow: 0 0 20px rgba(79, 163, 255, 0.4) !important;
        }

        .block.px-4.py-2.text-sm {
            background-color: transparent !important;
            color: var(--color-text) !important;
        }

        .block.px-4.py-2.text-sm:hover {
            background-color: rgba(79, 163, 255, 0.2) !important;
            color: var(--color-accent) !important;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="ロゴ" style="height: 40px; width: auto;">
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                
                <div style="margin-right: 10px;">
                    <a href="{{ route('welcome') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md transition ease-in-out duration-150"
                       style="background: rgba(15, 27, 61, 0.6) !important; 
                            border: 1px solid var(--color-primary) !important; 
                            color: var(--color-primary) !important;
                            backdrop-filter: blur(5px);
                            box-shadow: 0 0 10px rgba(79, 163, 255, 0.3);
                            text-decoration: none;">
                            {{ __('チケットを予約する') }}
                    </a>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md transition ease-in-out duration-150" 
                                style="background: rgba(15, 27, 61, 0.6) !important; 
                                    border: 1px solid var(--color-primary) !important; 
                                    color: var(--color-primary) !important;
                                    backdrop-filter: blur(5px);
                                    box-shadow: 0 0 10px rgba(79, 163, 255, 0.3);">
                            
                            <div>{{ Auth::user()->name }} 様</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" style="color: var(--color-primary);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')" style="color: var(--color-text) !important;">
                            {{ __('予約一覧') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')" style="color: var(--color-text) !important;">
                            {{ __('設定') }}
                        </x-dropdown-link>

                        <div style="border-t: 1px solid rgba(79, 163, 255, 0.2); margin: 4px 0;"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    style="color: #ff4f4f !important;"> {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('予約一覧') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                {{ __('チケットを予約する') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
