<x-layouts-auth>
    <x-slot name="content">
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ Ladmin::crud()->getLabel() }}
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 mb-6 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form
                        action="{{ route(Ladmin::crud()->getUpdateRouteName(), [
                            'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                        ]) }}"
                        method="post">
                        @csrf
                        @foreach ($fields as $field)
                            {{ $field->getView($item) }}
                        @endforeach

                        <div class="flex justify-end">
                            @if (Ladmin::crud()->isUpdatable())
                                <button
                                    class="text-white p-2 bg-blue-400 rounded-sm @if (Ladmin::crud()->isDeletable()) me-4 @endif"
                                    href="{{ route(Ladmin::crud()->getUpdateRouteName(), [
                                        'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                    ]) }}">{{ __('save') }}</button>
                            @endif
                            @if (Ladmin::crud()->isDeletable())
                                <span>TODO</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
