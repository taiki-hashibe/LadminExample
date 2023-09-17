<x-layouts-auth>
    <x-slot name="content">
        <div class="container-fluid">
            <div class="row">
                @include('ladmin::layouts.sidebar')

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-white">
                    <h2 class="fs-5 mb-3">{{ Ladmin::crud()->getLabel() }}</h2>
                    <div class="card p-4 shadow-sm">
                        @foreach (Ladmin::crud()->getColumnNames() as $column)
                            <div class="row py-2">
                                <div class="col-12 col-md-2">
                                    <span class="fw-bold">{{ $column }}</span>
                                </div>
                                <div class="col-12 col-md-10">
                                    {{ $item->{$column} }}
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-end">
                            @if (Ladmin::crud()->isEditable())
                                <a class="btn btn-sm btn-primary @if (Ladmin::crud()->isDeletable()) me-2 @endif"
                                    href="{{ route(Ladmin::crud()->getEditorRouteName(), [
                                        'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                    ]) }}">{{ __('edit') }}</a>
                            @endif
                            @if (Ladmin::crud()->isDeletable())
                                <form
                                    action="{{ route(Ladmin::crud()->getDestroyRouteName(), [
                                        'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                    ]) }}"
                                    method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-danger"
                                        href="{{ route(Ladmin::crud()->getDestroyRouteName(), [
                                            'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                        ]) }}">{{ __('delete') }}</button>
                                </form>
                            @endif
                        </div>

                    </div>
                </main>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
