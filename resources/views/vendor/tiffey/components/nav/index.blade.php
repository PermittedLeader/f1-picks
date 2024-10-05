<div class="flex flex-col md:flex-row justify-between" x-data="{ open: false }" @click.outside="open = false">
    <div class="flex flex-col md:flex-row md:gap-2 content-center">
        <div class="flex flex-row gap-2 justify-between md:place-content-center">
            @if(\View::exists('components.icon.logo'))
            <div class="pr-2 hidden md:flex">
                <x-icon.logo class="h-16" />
            </div>
            @endif
            <div class="my-auto px-2 text-xl font-bold text-brand-mid">
                <a href="/">{{ config('app.name') }}</a>
            </div>
            <div @click="open = ! open" class="my-2 mr-4 flex md:hidden">
                <i class="fa-solid fa-bars" x-show="!open"></i>
                <i class="fa-solid fa-xmark" x-show="open"></i>
                <span class="fa-sr-only">{{ __('app.show_hide_menu') }}</span>
            </div>
        </div>
        <div class="flex flex-col md:flex md:flex-row md:gap-2 border-solid border-t md:border-none" x-bind:class="{ 'hidden': !open }">
            @auth
                <x-tiffey::nav.link href="{{ route('home') }}" active="{{ request()->routeIs('home') }}">{{ __('app.home') }}</x-tiffey::nav.link>
                <x-tiffey::nav.dropdown title="More">
                    @role('League Administrator')
                    <x-tiffey::nav.link href="{{ route('pick.index') }}" :active="request()->routeIs('pick.*')">
                        {{ trans_choice('crud.picks.plural',2) }}
                    </x-tiffey::nav.link>
                    @endrole
                    @can('create',App\Models\Pickable::class)
                        <x-tiffey::nav.link href="{{ route('pickable.index') }}" :active="request()->routeIs('pickable.*')">
                            {{ trans_choice('crud.pickables.plural',2) }}
                        </x-tiffey::nav.link>
                    @endcan
                    @can('viewAny',App\Models\League::class)
                        <x-tiffey::nav.link href="{{ route('league.index') }}" :active="request()->routeIs('league.*')">
                            {{ trans_choice('crud.leagues.plural',2) }}
                        </x-tiffey::nav.link>
                    @endcan
                    @can('viewAny',App\Models\Event::class)
                        <x-tiffey::nav.link href="{{ route('event.index') }}" :active="request()->routeIs('event.*')">
                            {{ trans_choice('crud.events.plural',2) }}
                        </x-tiffey::nav.link>
                    @endcan
                    @can('viewAny',App\Models\Season::class)
                        <x-tiffey::nav.link href="{{ route('season.index') }}" :active="request()->routeIs('season.*')">
                            {{ trans_choice('crud.seasons.plural',2) }}
                        </x-tiffey::nav.link>
                    @endcan
                    @can('list users')
                        <x-tiffey::nav.link href="{{ route('user.index') }}" :active="request()->routeIs('user.*')">
                            {{ trans_choice('crud.users.plural',2) }}
                        </x-tiffey::nav.link>
                    @endcan
                </x-tiffey::nav.dropdown>
                
                @canany(['list roles','list permissions'])
                <x-tiffey::nav.dropdown title="Admin">
                    <x-tiffey::nav.link href="{{ route('roles.index') }}" :active="request()->routeIs('roles.*')">
                    {{ trans_choice('auth::auth.roles.name',2) }}
                </x-tiffey::nav.link>
                <x-tiffey::nav.link href="{{ route('permissions.index') }}" :active="request()->routeIs('permissions.*')">
                    {{ trans_choice('auth::auth.permissions.name',2) }}
                </x-tiffey::nav.link>
                </x-tiffey::nav.dropdown>
                @endcan 
            @endauth
            @guest  
                <x-tiffey::nav.link href="{{ route('welcome') }}" active="{{ request()->routeIs('welcome') }}">{{ __('app.home') }}</x-tiffey::nav.link>
            @endguest
            
        </div>
    </div>
    <div class="flex flex-col md:flex md:flex-row md:gap-2" x-bind:class="{ 'hidden': !open }">
        @auth
        <x-tiffey::nav.dropdown title="{{ Auth::user()->name }}" position="right">
            <x-tiffey::nav.link href="{{ route('profile.update') }}" :active="request()->routeIs('dashboard')">{{ __('app.profile') }}</x-tiffey::nav.link>
        </x-tiffey::nav.dropdown>
        <div class="h-full flex place-items-center pl-2 py-1">
        <form method="POST" action="{{ route('logout') }}" class="ml-3">
            @csrf
            <x-tiffey::form-button href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" color="bg-brand-mid">
                {{ __('app.logout') }}
            </x-tiffey::form-button>
        </form>
        </div>
    @endauth
    @guest
        @if (Route::has('register'))
        <x-tiffey::nav.link href="{{ route('register') }}" active="{{request()->routeIs('register')}}">
            {{ __('app.register') }}
        </x-tiffey::nav.link>
        @endif
        <div class="h-full flex place-items-center pl-2 py-1">
            <x-tiffey::button href="{{ route('login') }}" color="bg-brand-mid">
                {{ __('app.login') }}
            </x-tiffey::button>
        </div>
            
    @endguest
    </div>
</div>