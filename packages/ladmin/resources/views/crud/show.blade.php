<x-layouts-auth>
    <x-slot name="content">
        <div class="container px-4">
            <table>
                <thead>
                    <tr class="border">
                        @foreach ($columns as $column)
                            <th class="px-1">{{ $column->getName() }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>

                    @foreach ($items as $item)
                        <tr>
                            @foreach ($columns as $column)
                                <td>{{ $item->{$column->getName()} }}</td>
                            @endforeach
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </x-slot>
</x-layouts-auth>
