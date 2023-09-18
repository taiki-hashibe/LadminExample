<x-layouts-auth>
    <x-slot name="content">
        <div class="container-fluid">
            <div class="row">
                @include('ladmin::layouts.sidebar')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-white">
                    <h2 class="fs-5 mb-3">{{ Ladmin::crud()->getLabel() }}</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr class="px-2">
                                    @foreach (Ladmin::crud()->getColumnNamesForShow() as $item)
                                        <th class="px-2">{{ $item }}</th>
                                    @endforeach
                                    @if (Ladmin::crud()->isDetailable())
                                        <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr class="px-2">
                                        @foreach ($fields as $field)
                                            {{ $field->getView($item) }}
                                        @endforeach
                                        @if (Ladmin::crud()->isDetailable())
                                            <td>
                                                <a href="{{ route(Ladmin::crud()->getDetailRouteName(), [
                                                    'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                                ]) }}"
                                                    class="btn btn-sm btn-primary">{{ __('detail') }}</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
