<x-layouts-guest>
    <x-slot name="content">
        <div class="container-fluid">
            <div class="row">
                <main role="main" class="col-12 pt-3 px-4 bg-white">
                    <h2 class="fs-5 mb-3">{{ __('login') }}</h2>
                    <form action="{{ route(Ladmin::login()->getRouteName()) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email">
                                {{ __('email') }}
                            </label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text"
                                id="{{ 'email' }}" name="{{ 'email' }}"
                                value="{{ old('email') ? old('email') : '' }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">
                                {{ __('password') }}
                            </label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                id="{{ 'password' }}" name="{{ 'password' }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary w-100">{{ __('submit') }}</button>
                    </form>
                </main>
            </div>
        </div>
    </x-slot>
</x-layouts-guest>
