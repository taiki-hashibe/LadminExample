<x-layouts-ladmin>
    <x-slot name="header">
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap px-2">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{ config('app.name') }}</a>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <form action="{{ route(Ladmin::logout()->getRouteName()) }}" method="post">
                        @csrf
                        <button class="nav-link bg-transparent border-0">Sign out</button>
                    </form>
                </li>
            </ul>
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
