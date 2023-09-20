<x-layouts-auth>

    <x-slot name="content">
        <form method="post" action="{{ LadminRoute::profile()->update()->url }}" class="mt-6 space-y-6">
            @csrf

            <div class="mb-2">
                <x-ladmin::text-input label="{{ __('Name') }}" name="name" type="text" :value="old('name', $user->name)" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mb-2">
                <x-ladmin::text-input label="{{ __('Email') }}" id="email" name="email" type="email"
                    class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            </div>

            <div class="flex items-center gap-4">
                <x-ladmin::primary-button>{{ __('Save') }}</x-ladmin::primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>

        <form method="post" action="{{ Ladmin::route(config('ladmin.profile.update-password.name')) }}">
            @csrf

            <div class="mb-2">
                <x-ladmin::text-input label="{{ __('Current Password') }}" id="current_password" name="current_password"
                    type="password" class="mt-1 block w-full" autocomplete="current-password" />
            </div>

            <div class="mb-2">
                <x-ladmin::text-input label="{{ __('New Password') }}" id="password" name="password" type="password"
                    class="mt-1 block w-full" autocomplete="new-password" />
            </div>

            <div class="mb-2">
                <x-ladmin::text-input label="{{ __('Confirm Password') }}" id="password_confirmation"
                    name="password_confirmation" type="password" class="mt-1 block w-full"
                    autocomplete="new-password" />
            </div>

            <div class="flex items-center gap-4">
                <x-ladmin::primary-button>{{ __('Save') }}</x-ladmin::primary-button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>

        <form method="post" action="{{ Ladmin::route(config('ladmin.profile.destroy.name')) }}" class="p-6">
            @csrf
            <button>{{ __('Delete Account') }}</button>
            </div>
        </form>
    </x-slot>
</x-layouts-auth>
