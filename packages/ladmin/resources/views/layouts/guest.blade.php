<x-layouts-ladmin>
    <x-slot name="header">
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap px-2">
            <span class="navbar-brand col-sm-3 col-md-2 mr-0">{{ config('app.name') }}</span>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    {{-- <a class="nav-link" href="#">Sign out</a> --}}
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
