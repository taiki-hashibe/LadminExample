<x-layouts-ladmin>
    <x-slot name="header">
        <header class="w-100 border-bottom py-4 bg-white">
            <div class="container d-flex justify-content-between">
                <a href="#_">{{ config('app.name') }}</a>
                <nav>
                    @foreach ($headerNavigation as $item)
                        <a href="{{ $item->getRoute() }}">
                            <span>{{ $item->getLabel() }}</span>
                        </a>
                    @endforeach
                </nav>
                <div></div>
            </div>
        </header>
        <div class="w-100 shadow-sm py-3 mb-3 bg-white">
            <div class="container">
                <h2 class="fs-5">// item label //</h2>
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        @isset($content)
            {{ $content }}
        @endisset
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-layouts-ladmin>
