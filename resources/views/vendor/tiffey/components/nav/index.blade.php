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
                <span class="fa-sr-only">Show/hide menu</span>
            </div>
        </div>
        <div class="flex flex-col md:flex md:flex-row md:gap-2 border-solid border-t md:border-none" x-bind:class="{ 'hidden': !open }">
            @auth
                <x-tiffey::nav.link href="{{ route('home') }}" active="{{ request()->routeIs('home') }}">Home</x-tiffey::nav.link>
                <x-tiffey::nav.dropdown title="More">
                    @can('create',App\Models\Pickable::class)
                        <x-tiffey::nav.link href="{{ route('pickable.index') }}" :active="request()->routeIs('pickable.*')">
                            Pickables
                        </x-tiffey::nav.link>
                    @endcan
                    @can('viewAny',App\Models\League::class)
                        <x-tiffey::nav.link href="{{ route('league.index') }}" :active="request()->routeIs('league.*')">
                            Leagues
                        </x-tiffey::nav.link>
                    @endcan
                    @can('viewAny',App\Models\Event::class)
                        <x-tiffey::nav.link href="{{ route('event.index') }}" :active="request()->routeIs('event.*')">
                            Events
                        </x-tiffey::nav.link>
                    @endcan
                    @can('viewAny',App\Models\Season::class)
                        <x-tiffey::nav.link href="{{ route('season.index') }}" :active="request()->routeIs('season.*')">
                            Seasons
                        </x-tiffey::nav.link>
                    @endcan
                </x-tiffey::nav.dropdown>
            @endauth
            @guest  
                <x-tiffey::nav.link href="{{ route('welcome') }}" active="{{ request()->routeIs('welcome') }}">Home</x-tiffey::nav.link>
            @endguest
            
        </div>
    </div>
    <div class="flex flex-col md:flex md:flex-row md:gap-2" x-bind:class="{ 'hidden': !open }">
        @auth
        <x-tiffey::nav.dropdown title="{{ Auth::user()->name }}" position="right">
            <x-tiffey::nav.link href="{{ route('profile.update') }}" :active="request()->routeIs('dashboard')">Profile</x-tiffey::nav.link>
        </x-tiffey::nav.dropdown>
        <div class="h-full flex place-items-center pl-2 py-1">
        <form method="POST" action="{{ route('logout') }}" class="ml-3">
            @csrf
            <x-tiffey::form-button href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" color="bg-brand-mid">
                {{ __('Logout') }}
            </x-tiffey::form-button>
        </form>
        </div>
    @endauth
    @guest
        @if (Route::has('register'))
        <x-tiffey::nav.link href="{{ route('register') }}" active="{{request()->routeIs('register')}}">
            {{ __('Register') }}
        </x-tiffey::nav.link>
        @endif
        <div class="h-full flex place-items-center pl-2 py-1">
            <x-tiffey::button href="{{ route('login') }}" color="bg-brand-mid">
                {{ __('Login') }}
            </x-tiffey::button>
        </div>
            
    @endguest
    </div>
</div>