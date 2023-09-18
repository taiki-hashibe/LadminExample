<x-layouts-auth>

    <x-slot name="content">
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ Ladmin::crud()->getLabel() }}
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 mb-6 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('ladmin::profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 mb-6 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('ladmin::profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 mb-6 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('ladmin::profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts-auth>
