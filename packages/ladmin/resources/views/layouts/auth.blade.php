<x-layouts-ladmin>
    <x-slot name="header">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex w-[90%]">
                        <div class="shrink-0 flex items-center bt-white sticky left-0 w-[10%]">
                            <a href="{{ route('admin.dashboard') }}">
                                {{ config('app.name') }}
                            </a>
                        </div>
                        <div class="sb-x-view flex w-[90%]">
                            <div class="sb-content px-4 flex">
                                @foreach (Ladmin::navigation('navigation') as $item)
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <x-ladmin::nav-link :href="$item->route()" :active="$item->isActive()">
                                            {{ $item->label() }}
                                        </x-ladmin::nav-link>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Settings Dropdown -->
                    <div class="w-[10%] hidden sm:flex sm:items-center sm:ml-6">
                        <x-ladmin::dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-ladmin::dropdown-link :href="route(Ladmin::crud(config('ladmin.profile.show.name'))->routeName())">
                                    {{ __('Profile') }}
                                </x-ladmin::dropdown-link>

                                <!-- Authentication -->
                                <form method="POST"
                                    action="{{ route(Ladmin::crud(config('ladmin.auth.logout.name'))->routeName()) }}">
                                    @csrf

                                    <button
                                        class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </x-slot>
                        </x-ladmin::dropdown>
                    </div>

                    <!-- Hamburger -->
                    <div class="w-[10%] -mr-2 flex items-center sm:hidden">
                        <button id="admin-res-dropdown-trigger" @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </x-slot>
    <x-slot name="content">
        @isset($content)
            {{ $content }}
        @endisset
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-layouts-ladmin>
