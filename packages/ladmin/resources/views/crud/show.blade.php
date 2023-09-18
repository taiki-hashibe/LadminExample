<x-layouts-auth>
    <x-slot name="content">
        <div class="container-fluid">
            <div class="row">
                @include('ladmin::layouts.sidebar')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-white">
                    <h2 class="fs-5 mb-3">{{ Ladmin::crud()->getLabel() }}</h2>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr class="px-2">
                                    @foreach ($fields as $field)
                                        <th class="px-2">{{ $field->getName() }}</th>
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
                                        @if (Ladmin::crud()->isDetailable() || Ladmin::crud()->isEditable() || Ladmin::crud()->isDeletable())
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-decoration-none text-secondary"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        @if (Ladmin::crud()->isDetailable())
                                                            <li>
                                                                <a href="{{ route(Ladmin::crud()->getDetailRouteName(), [
                                                                    'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                                                ]) }}"
                                                                    class="dropdown-item text-decoration-none">{{ __('detail') }}</a>
                                                            </li>
                                                        @endif
                                                        @if (Ladmin::crud()->isEditable())
                                                            <li>
                                                                <a href="{{ route(Ladmin::crud()->getEditorRouteName(), [
                                                                    'primaryKey' => $item->{Ladmin::crud()->getPrimaryKey()},
                                                                ]) }}"
                                                                    class="dropdown-item text-decoration-none">{{ __('edit') }}</a>
                                                            </li>
                                                        @endif
                                                        @if (Ladmin::crud()->isDeletable())
                                                            <li>
                                                                <a class="dropdown-item text-decoration-none"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete-modal-{{ $item->{Ladmin::crud()->getPrimaryKey()} }}">{{ __('delete') }}</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                    @if (Ladmin::crud()->isDeletable())
                                        <div class="modal fade"
                                            id="delete-modal-{{ $item->{Ladmin::crud()->getPrimaryKey()} }}"
                                            tabindex="-1"
                                            aria-labelledby="delete-modal-label-{{ $item->{Ladmin::crud()->getPrimaryKey()} }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-modal-label-{{ $item->{Ladmin::crud()->getPrimaryKey()} }}">
                                                            Delete</h5>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
