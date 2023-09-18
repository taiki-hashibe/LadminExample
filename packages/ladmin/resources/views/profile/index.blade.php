<x-layouts-auth>

    <x-slot name="content">
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ __('profile') }}
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 mb-6 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Profile Information') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __("Update your account's profile information and email address.") }}
                                </p>
                            </header>
                            <form method="post" action="{{ Ladmin::route(config('ladmin.profile.update.name')) }}"
                                class="mt-6 space-y-6">
                                @csrf

                                <div class="mb-2">
                                    <x-ladmin::text-input label="{{ __('Name') }}" name="name" type="text"
                                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                </div>

                                <div class="mb-2">
                                    <x-ladmin::text-input label="{{ __('Email') }}" id="email" name="email"
                                        type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required
                                        autocomplete="username" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-ladmin::primary-button>{{ __('Save') }}</x-ladmin::primary-button>

                                    @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="p-4 mb-6 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Update Password') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                </p>
                            </header>

                            <form method="post"
                                action="{{ Ladmin::route(config('ladmin.profile.update-password.name')) }}"
                                class="mt-6 space-y-6">
                                @csrf

                                <div class="mb-2">
                                    <x-ladmin::text-input label="{{ __('Current Password') }}" id="current_password"
                                        name="current_password" type="password" class="mt-1 block w-full"
                                        autocomplete="current-password" />
                                </div>

                                <div class="mb-2">
                                    <x-ladmin::text-input label="{{ __('New Password') }}" id="password"
                                        name="password" type="password" class="mt-1 block w-full"
                                        autocomplete="new-password" />
                                </div>

                                <div class="mb-2">
                                    <x-ladmin::text-input label="{{ __('Confirm Password') }}"
                                        id="password_confirmation" name="password_confirmation" type="password"
                                        class="mt-1 block w-full" autocomplete="new-password" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-ladmin::primary-button>{{ __('Save') }}</x-ladmin::primary-button>

                                    @if (session('status') === 'password-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </section>

                    </div>
                </div>

                <div class="p-4 mb-6 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section class="space-y-6">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Delete Account') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                </p>
                            </header>

                            <x-ladmin::danger-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-ladmin::danger-button>

                            <x-ladmin::modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post"
                                    action="{{ Ladmin::route(config('ladmin.profile.destroy.name')) }}" class="p-6">
                                    @csrf

                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Are you sure you want to delete your account?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>

                                    <div class="mt-6 mb-2">
                                        <x-ladmin::text-input label="{{ __('Password') }}" id="password"
                                            name="password" type="password" class="mt-1 block w-3/4"
                                            placeholder="{{ __('Password') }}" />

                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <x-ladmin::secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-ladmin::secondary-button>

                                        <x-ladmin::danger-button class="ml-3">
                                            {{ __('Delete Account') }}
                                        </x-ladmin::danger-button>
                                    </div>
                                </form>
                            </x-ladmin::modal>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
