<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    {{-- TODO action --}}
    <form method="post" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-2">
            <ladmin::input-label for="name" :value="__('Name')" />
            <ladmin::text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user - > name)" required autofocus autocomplete="name" />
            <ladmin::input-error class="mt-2" :messages="$errors - > get('name')" />
        </div>

        <div class="mb-2">
            <ladmin::input-label for="email" :value="__('Email')" />
            <ladmin::text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user - > email)" required autocomplete="username" />
            <ladmin::input-error class="mt-2" :messages="$errors - > get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <ladmin::primary-button>{{ __('Save') }}</ladmin::primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
