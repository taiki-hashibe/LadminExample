<x-layouts-auth>
    <x-slot name="content">
        <div class="w-100 bg-light">
            <div class="container px-4">
                <table class="table bg-white">
                    <thead>
                        <tr class="border">
                            @foreach ($columns as $column)
                                <th class="px-1">{{ $column->getName() }}</th>
                            @endforeach
                            <th class="px-1"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr>
                                @foreach ($columns as $column)
                                    <td class="px-1">{{ $item->{$column->getName()} }}</td>
                                @endforeach
                                <td class="px-1">
                                    @dump($item->getKeyName())
                                    <a href=""></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
