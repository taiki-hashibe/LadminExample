<x-layouts-auth>
    <x-slot name="content">
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ __(Ladmin::crud()->label()) }}
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @foreach ($fields as $field)
                            {{ $field->getView(Ladmin::currentItem()) }}
                        @endforeach
                        <div class="flex justify-end px-0 md:px-4">
                            @if (Ladmin::crud()->isEditable())
                                <a class="text-white p-2 bg-blue-400 rounded-sm @if (Ladmin::crud()->isDeletable()) me-4 @endif"
                                    href="{{ route(
                                        Ladmin::crud()->editor()->RouteName(),
                                        [
                                            'primaryKey' => Ladmin::currentItemKey(),
                                        ],
                                    ) }}">{{ __('edit') }}</a>
                            @endif
                            @if (Ladmin::crud()->isDeletable())
                                <x-ladmin::danger-button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-item-delete')">{{ __('delete') }}</x-ladmin::danger-button>
                                <x-ladmin::modal name="confirm-item-delete">
                                    <form method="post"
                                        action="{{ route(
                                            Ladmin::crud()->destroy()->RouteName(),
                                            [
                                                'primaryKey' => Ladmin::currentItemKey(),
                                            ],
                                        ) }}"
                                        class="p-6">
                                        @csrf

                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __('Are you sure you want to delete?') }}
                                        </p>


                                        <div class="mt-6 flex justify-end">
                                            <x-ladmin::secondary-button x-on:click="$dispatch('close')">
                                                {{ __('cancel') }}
                                            </x-ladmin::secondary-button>

                                            <x-ladmin::danger-button class="ml-3">
                                                {{ __('delete') }}
                                            </x-ladmin::danger-button>
                                        </div>
                                    </form>
                                </x-ladmin::modal>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
