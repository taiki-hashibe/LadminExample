<x-layouts-ladmin>
    <x-slot name="header">
        {{ Ladmin::getNavigation('navigation')->render() }}
    </x-slot>
    <x-slot name="content">
        @isset($content)
            {{ $content }}
        @endisset
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-layouts-ladmin>
