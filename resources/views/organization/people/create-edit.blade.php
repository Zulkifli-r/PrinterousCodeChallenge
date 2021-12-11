<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($person) ? __('Edit ').$person->name : __('Create New Person For ').$organization->name }}
        </h2>
    </x-slot>   

    <div class="max-w-screen-md mx-auto p-5">
        <x-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ isset($person) ? route('organization.people.update', [$organization, $person]) : route('organization.people.store', $organization) }}" enctype="multipart/form-data">
            @csrf
            @isset($person)
                @method('put')
            @endisset

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="isset($person) ? $person->name : old('name')" required autofocus />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="isset($person) ? $person->phone : old('phone')" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="isset($person) ? $person->email :old('email')" required />
            </div>

            <!-- Avatar -->
            <div class="mt-4">
                <x-label for="avatar" :value="__('Avatar')" />

                <x-input id="avatar" class="block mt-1 w-full" type="file" name="avatar" :value="old('avatar')" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>