<x-layouts-guest>
    <x-slot name="content">
        <div class="w-full flex justify-center px-8">
            <form class="mt-8 px-6 py-8 mb-6 bg-white shadow-sm w-full md:w-2/5 rounded" method="POST"
                action="{{ route(Ladmin::login()->getRouteName()) }}">
                @csrf

                <div class="mb-8">
                    <label for="email" class="block font-medium text-sm text-gray-700">{{ __('email') }}</label>
                    <input name="email" type="text"
                        class="block mt-1 px-2 py-2 w-full border focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm border-gray-300 @error('email') border-red-600 @enderror">
                    @error('email')
                        <p class="text-sm text-red-600 space-y-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Password') }}</label>
                    <input name="password" type="password"
                        class="block mt-1 px-2 py-2 w-full border focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm border-gray-300 @error('email') border-red-600 @enderror">
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
        </div>
    </x-slot>
</x-layouts-guest>
