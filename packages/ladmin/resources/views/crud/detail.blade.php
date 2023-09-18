<x-layouts-auth>
    <x-slot name="content">
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ Ladmin::crud()->getLabel() }}
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @foreach ($fields as $field)
                            {{ $field->getView($item) }}
                        @endforeach
                        <div class="flex justify-end px-0 md:px-4">
                            @if (Ladmin::crud()->isEditable())
                                <a class="text-white p-2 bg-blue-400 rounded-sm @if (Ladmin::crud()->isDeletable()) me-4 @endif"
                                    href="{{ route(Ladmin::crud()->getEditorRouteName(), [
                                        'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                    ]) }}">{{ __('edit') }}</a>
                            @endif
                            @if (Ladmin::crud()->isDeletable())
                                <span>TODO</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
