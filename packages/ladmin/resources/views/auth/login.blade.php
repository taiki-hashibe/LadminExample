<x-layouts-guest>
    <x-slot name="content">
        <form method="POST" action="{{ route(Ladmin::login()->getRouteName()) }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700">{{ __('email') }}</label>
                <input name="email"
                    class="block mt-1 px-2 py-3 w-full border-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @error('email')
                    <p class="text-sm text-red-600 space-y-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Password') }}</label>
                <input name="password"
                    class="block mt-1 px-2 py-3 w-full border-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @error('password')
                    <p class="text-sm text-red-600 space-y-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('login') }}
                </button>
            </div>
        </form>
    </x-slot>
</x-layouts-guest>
