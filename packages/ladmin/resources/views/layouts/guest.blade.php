<x-layouts-ladmin>
    <x-slot name="header">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-start h-16">
                    <div class="flex w-[90%]">
                        <div class="shrink-0 flex items-center bt-white sticky left-0 w-[10%]">
                            <a href="{{ route('admin.dashboard') }}">
                                {{ config('app.name') }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </x-slot>
    <x-slot name="content">
        @isset($content)
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $content }}
            </div>
        @endisset
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-layouts-ladmin>
