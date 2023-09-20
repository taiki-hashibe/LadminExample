<x-layouts-auth>

    <x-slot name="content">
        <form method="post" action="{{ Ladmin::route()->profile()->update()->url }}" class="mt-6 space-y-6">
            @csrf

            @include('ladmin::fields.edit.default', [
                'label' => 'username',
                'name' => 'name',
            ])

            @include('ladmin::fields.edit.default', [
                'label' => 'email',
                'name' => 'email',
            ])

            <button>{{ __('Save') }}</button>
        </form>
        <hr>
        <form method="post" action="{{ Ladmin::route()->profile()->passwordChange()->url }}">
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
        <hr>
        <form method="post" action="{{ Ladmin::route()->profile()->destroy()->url }}">
            @csrf
            <button>{{ __('Delete Account') }}</button>
            </div>
        </form>
    </x-slot>
</x-layouts-auth>
