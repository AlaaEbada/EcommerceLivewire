<header class="bg-white text-gray-900 py-6 sticky top-0 z-50 transition-colors duration-300 ease-in-out" id="header"
    x-data="{ menuOpen: false, cartItemsCount: 0 }">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 space-x-8">
        <!-- Logo -->
        <a href="/" wire:navigate>
            <h1
                class="text-2xl font-extrabold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-[#159957] to-[#155799] hover:scale-105 transition-transform duration-300 cursor-pointer">
                MediaSharks Store
            </h1>
        </a>

        <!-- Mobile Menu Toggle -->
        <button class="lg:hidden text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500"
            x-on:click="menuOpen = true">
            <svg x-show="!menuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>



        <!-- Desktop Navigation Menu -->
        <nav class="hidden lg:flex space-x-6 items-center">
            <ul class="flex space-x-6 items-center rtl:space-x-reverse">
                <li><a href="/" wire:navigate
                        class="{{ request()->is('/') ? 'text-green-500 ' : '' }} text-base font-medium text-gray-800 hover:text-green-500 transition-colors duration-200">{{ __('home') }}</a>
                </li>
                <li><a href="/shop" wire:navigate
                        class="{{ request()->is('shop') ? 'text-green-500 ' : '' }} text-base font-medium text-gray-800 hover:text-green-500 transition-colors duration-200">{{ __('Shop') }}</a>
                </li>
                <li><a href="/blog" wire:navigate
                        class="{{ request()->is('offers') ? 'text-green-500 ' : '' }} text-base font-medium text-gray-800 hover:text-green-500 transition-colors duration-200">{{ __('Blog') }}</a>
                </li>
                <li><a href="/orders" wire:navigate
                        class="{{ request()->is('contact') ? 'text-green-500 ' : '' }} text-base font-medium text-gray-800 hover:text-green-500 transition-colors duration-200">{{ __('Orders') }}</a>
                </li>
            </ul>
        </nav>

        <!-- Search Bar -->
        @livewire('search-products')


        <!-- Cart and Authentication Links -->
        <section class="hidden lg:flex items-center space-x-6">
            <!-- Cart Icon -->

            @livewire('cart-widget')


            {{-- <a href="/cart" wire:navigate class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 hover:text-green-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span x-text="cartItemsCount"
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5"></span>
            </a> --}}

            @if (Route::has('login'))
                @auth
                    @if (Auth::check() && Auth::user()->is_admin == '1')
                        <a href="/admin"
                            class="text-base font-medium text-gray-800 hover:text-green-500 transition-colors duration-200 {{ request()->is('admin') ? 'text-green-500' : '' }}">
                            {{ __('messages.dashboard') }}
                        </a>
                    @endif
                    <div class="hidden sm:flex items-center space-x-3 font-medium">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-gray-800 text-1xl leading-4 font-medium rounded-md hover:text-green-500 focus:outline-none transition ease-in-out duration-150">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    {{ __('profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left rtl:text-right px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('logout') }}
                                    </button>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <a wire:navigate href="{{ route('login') }}"
                        class="text-base font-medium text-black px-4 py-2 border border-transparent rounded hover:text-gray-600 focus-visible:ring focus-visible:ring-green-500">
                        {{ __('login') }}
                    </a>
                    @if (Route::has('register'))
                        <a wire:navigate href="{{ route('register') }}"
                            class="text-base font-medium text-black px-4 py-2 border border-transparent rounded hover:text-gray-600 focus-visible:ring focus-visible:ring-green-500">
                            {{ __('register') }}
                        </a>
                    @endif
                @endauth
            @endif
        </section>

        <!-- Mobile Navigation Menu -->
        <div class="fixed inset-0 z-50" x-show="menuOpen" x-cloak>
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity duration-300" x-show="menuOpen"></div>

            <!-- Menu Content -->
            <nav @click.away="menuOpen = false"
                class="fixed top-0 right-0 h-full w-4/5 bg-gray-900 text-white shadow-lg z-50 transform transition-transform duration-300"
                x-transition:enter="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="translate-x-0" x-transition:leave-end="translate-x-full">
                <div class="flex flex-col items-center h-full pt-6">
                    <!-- Close Button -->
                    <button class="self-end pr-6 text-gray-400 hover:text-white" x-on:click="menuOpen = false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <ul class="flex flex-col space-y-6 items-center justify-center mt-6">
                        <!-- Main Links -->
                        <li><a href="/" wire:navigate
                                class="{{ request()->is('/') ? 'text-green-500 ' : '' }} text-lg font-semibold hover:text-green-400 transition-colors duration-200">{{ __('home') }}</a>
                        </li>
                        <li><a href="/products" wire:navigate
                                class="{{ request()->is('products') ? 'text-green-500 ' : '' }} text-lg font-semibold hover:text-green-400 transition-colors duration-200">{{ __('products') }}</a>
                        </li>
                        <li><a href="/offers" wire:navigate
                                class="{{ request()->is('offers') ? 'text-green-500 ' : '' }} text-lg font-semibold hover:text-green-400 transition-colors duration-200">{{ __('offers') }}</a>
                        </li>
                        <li><a href="/contact" wire:navigate
                                class="{{ request()->is('contact') ? 'text-green-500 ' : '' }} text-lg font-semibold hover:text-green-400 transition-colors duration-200">{{ __('contact_us') }}</a>
                        </li>

                        <!-- Divider -->
                        <li class="w-4/5 border-t border-gray-500 mt-6"></li>

                        <!-- Authentication Links -->
                        <section>
                            @auth
                                <li
                                    class="text-center text-lg font-semibold hover:text-green-400 transition-colors duration-200">
                                    <a href="/admin">
                                        {{ __('dashboard') }}
                                    </a>
                                </li>

                                <li
                                    class="mt-4 text-center text-lg font-semibold hover:text-green-400 transition-colors duration-200">
                                    <a wire:navigate href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                        {{ __('profile') }}
                                    </a>
                                </li>

                                <li
                                    class="mt-4 text-center text-lg font-semibold text-red-500 hover:text-green-400 transition-colors duration-200">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit">
                                            {{ __('logout') }}
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li
                                    class="text-center text-lg font-semibold hover:text-green-400 transition-colors duration-200">
                                    <a wire:navigate href="{{ route('login') }}">
                                        {{ __('login') }}
                                    </a>
                                </li>

                                <li
                                    class="mt-4 text-center text-lg font-semibold hover:text-green-400 transition-colors duration-200">
                                    <a wire:navigate href="{{ route('register') }}">{{ __('register') }}</a>
                                </li>
                            @endauth
                        </section>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
