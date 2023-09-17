<x-layouts-auth>
    <x-slot name="content">
        <div class="row gx-0">
            <div class="col-2">
                <div class="w-100 h-100 bg-white shadow px-3 pt-4">
                    <h2 class="fs-5">{{ $crud->getLabel() }}</h2>
                    {{-- @foreach ($headerNavigation as $item)
                        <div>
                            <a href="{{ $item->getRoute() }}">
                                <span>{{ $item->getLabel() }}</span>
                            </a>
                        </div>
                    @endforeach --}}
                </div>
            </div>
            <div class="col-10">
                <div class="w-100 mt-4">
                    <div class="px-4">
                        <div class="card p-4 overflow-scroll">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        @foreach ($columns as $column)
                                            <th class="px-2">{{ $column->getName() }}</th>
                                        @endforeach
                                        <th class="px-2"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($items as $item)
                                        <tr>
                                            @foreach ($columns as $column)
                                                <x-ladmin::theme.default.show.column>{{ $item->{$column->getName()} }}</x-ladmin::theme.default.show.column>
                                            @endforeach
                                            <td class="px-1">
                                                <a href="{{ route($crud->getDetailRouteName(), [
                                                    'id' => $item->{$item->getKeyName()},
                                                ]) }}"
                                                    class="btn btn-sm btn-primary">
                                                    {{ __('detail') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
