<x-layouts-auth>
    <x-slot name="content">
        <form
            action="{{ route(Ladmin::getUpdateRouteName(), [
                'primaryKey' => Ladmin::currentItem()->{Ladmin::currentQuery()->primaryKey},
            ]) }}">
            @csrf
            @foreach ($fields as $field)
                {{ $field->render(Ladmin::currentItem()) }}
            @endforeach
        </form>
    </x-slot>
</x-layouts-auth>
