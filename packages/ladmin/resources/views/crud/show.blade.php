<x-layouts-auth>
    <x-slot name="content">
        <div class="container px-4">
            @dump(Ladmin::get())
            <table>
                <thead>
                    <tr class="border">
                        @foreach ($columns as $column)
                            <th class="px-1">{{ $column->getName() }}</th>
                        @endforeach
                        <th></th>
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
                    <tr><a href=""></a></tr>
                </tbody>
            </table>
        </div>
    </x-slot>
</x-layouts-auth>
