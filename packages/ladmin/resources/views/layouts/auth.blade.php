<x-layouts-ladmin>
    <x-slot name="header">
        <header class="bg-white">
            <nav class="flex mx-auto py-3">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{ config('app.name') }}</a>
                <div class="dropdown">
                    <a class="dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                        @if (Ladmin::hasProfile())
                            <li><a class="dropdown-item text-white"
                                    href="{{ route(Ladmin::profile()->getRouteName()) }}">{{ __('profile') }}</a></li>
                        @endif
                        <li>
                            <form class="dropdown-item" action="{{ route(Ladmin::logout()->getRouteName()) }}"
                                method="post">
                                @csrf
                                <button class="bg-transparent text-white border-0 px-0">{{ __('logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </x-slot>
    <x-slot name="content">
        @isset($content)
            {{ $content }}
        @endisset
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-layouts-ladmin>
