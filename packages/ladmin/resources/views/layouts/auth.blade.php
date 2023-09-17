<x-layouts-ladmin>
    <x-slot name="header">
        <header class="w-100 border-bottom px-3 py-3 bg-white">
            <div class="d-flex justify-content-between">
                <a href="#_">{{ config('app.name') }}</a>
                <nav>

                </nav>
                <div></div>
            </div>
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
