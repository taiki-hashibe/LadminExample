<x-layouts-auth>
    <x-slot name="content">
        <div class="container-fluid">
            <div class="row">
                @include('ladmin::layouts.sidebar')

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-white">
                    <h2 class="fs-5 mb-3">{{ Ladmin::crud()->getLabel() }}</h2>
                    <div class="card p-4 shadow-sm">
                        @foreach ($fields as $field)
                            {{ $field->getView($item) }}
                        @endforeach

                        <div class="d-flex justify-content-end">
                            @if (Ladmin::crud()->isEditable())
                                <a class="btn btn-sm btn-primary @if (Ladmin::crud()->isDeletable()) me-2 @endif"
                                    href="{{ route(Ladmin::crud()->getEditorRouteName(), [
                                        'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                    ]) }}">{{ __('edit') }}</a>
                            @endif
                            @if (Ladmin::crud()->isDeletable())
                                <a class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete-modal">{{ __('delete') }}</a>
                                <div class="modal fade" id="delete-modal" tabindex="-1"
                                    aria-labelledby="delete-modal-label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete-modal-label">Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </main>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
