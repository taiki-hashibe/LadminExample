<x-layouts-auth>
    <x-slot name="content">
        <div class="container-fluid">
            <div class="row">
                @include('ladmin::layouts.sidebar')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-white">
                    <h2 class="fs-5 mb-3">{{ __('profile') }}</h2>
                </main>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
