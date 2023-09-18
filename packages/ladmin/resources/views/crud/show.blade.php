<x-layouts-auth>
    <x-slot name="content">
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ Ladmin::crud()->getLabel() }}
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-ladmin::table>
                    <x-ladmin::thead>
                        <tr>
                            @foreach ($fields as $field)
                                <x-ladmin::th>
                                    {{ $field->getName() }}
                                </x-ladmin::th>
                            @endforeach
                            @if (Ladmin::crud()->isDetailable())
                                <x-ladmin::th></x-ladmin::th>
                            @endif
                        </tr>
                    </x-ladmin::thead>
                    <x-ladmin::tbody>
                        @foreach ($items as $item)
                            <tr>
                                @foreach ($fields as $field)
                                    {{ $field->getView($item) }}
                                @endforeach
                                @if (Ladmin::crud()->isDetailable() || Ladmin::crud()->isEditable() || Ladmin::crud()->isDeletable())
                                    <x-ladmin::td>
                                        <a class="text-white p-2 bg-blue-400 rounded-sm"
                                            href="{{ route(Ladmin::crud()->getDetailRouteName(), [
                                                'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                            ]) }}"
                                            class="dropdown-item text-decoration-none">{{ __('detail') }}</a>
                                    </x-ladmin::td>
                                @endif
                            </tr>
                        @endforeach
                    </x-ladmin::tbody>
                </x-ladmin::table>
                {{ $items->links() }}
            </div>
        </div>
        <script>
            const viewElms = document.querySelectorAll('.sb-x-view');
            viewElms.forEach((e) => {
                const c = e.querySelector(".sb-content");
                if (c) {
                    new ScrollBooster({
                        viewport: e,
                        content: c,
                        scrollMode: 'transform',
                        direction: 'horizontal'
                    });
                }
            })
        </script>
    </x-slot>
</x-layouts-auth>
