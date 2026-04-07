<nav x-data="{ open: false }" class="relative bg-cream-100/80 backdrop-blur-xl border-b border-cream-200 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <span class="w-9 h-9 rounded-full bg-gradient-to-br from-espresso-400 to-espresso-700 grid place-items-center text-cream-100 font-serif text-lg shadow-inner transition-transform duration-500 group-hover:rotate-12">B</span>
                        <span class="font-serif text-xl text-espresso-700 tracking-tight hidden sm:inline">BrewLog</span>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    @php
                        $links = [
                            ['dashboard', 'Dashboard'],
                            ['brews.index', 'Brews'],
                            ['beans.index', 'Beans'],
                        ];
                    @endphp
                    @foreach($links as [$route, $label])
                        @php $active = request()->routeIs($route) || request()->routeIs(str_replace('.index','.*',$route)); @endphp
                        <a href="{{ route($route) }}"
                           class="inline-flex items-center px-4 my-3 rounded-xl text-sm font-medium transition-all duration-200 {{ $active ? 'bg-espresso-600 text-cream-50 shadow-md shadow-espresso-500/20' : 'text-espresso-500 hover:text-espresso-700 hover:bg-cream-200/60' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-2">
                <a href="{{ route('brews.create') }}" class="px-4 py-2 text-sm font-medium rounded-xl bg-caramel-500 text-cream-50 hover:bg-caramel-600 hover:shadow-lg hover:shadow-caramel-500/30 active:scale-95 transition-all">+ New brew</a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-cream-200 text-sm leading-4 font-medium rounded-xl text-espresso-600 bg-cream-50 hover:bg-cream-100 hover:text-espresso-800 focus:outline-none focus:ring-2 focus:ring-caramel-400 transition-all">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-espresso-500 hover:text-espresso-700 hover:bg-cream-200 focus:outline-none transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-cream-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('brews.index')" :active="request()->routeIs('brews.*')">{{ __('Brews') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('beans.index')" :active="request()->routeIs('beans.*')">{{ __('Beans') }}</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-cream-200">
            <div class="px-4">
                <div class="font-medium text-base text-espresso-700">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-espresso-400">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
