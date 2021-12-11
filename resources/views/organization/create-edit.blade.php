<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($organization) ? __('Edit ').$organization->name : __('Create New Organization') }}
        </h2>
    </x-slot>

    <div class="max-w-screen-md mx-auto p-5">
        <x-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ isset($organization) ? route('organization.update', $organization) : route('organization.store') }}" enctype="multipart/form-data">
            @csrf
            @isset($organization)
                @method('put')
            @endisset

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="isset($organization) ? $organization->name : old('name')" required autofocus />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="isset($organization) ? $organization->phone :old('phone')" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="isset($organization) ? $organization->email :old('email')" required />
            </div>

            <!-- Website -->
            <div class="mt-4">
                <x-label for="website" :value="__('Website')" />

                <x-input id="website" class="block mt-1 w-full" type="text" name="website" :value="isset($organization) ? $organization->website :old('website')" />
            </div>

            <!-- Logo -->
            <div class="mt-4">
                <x-label for="logo" :value="__('Logo')" />

                <x-input id="logo" class="block mt-1 w-full" type="file" name="logo" :value="old('logo')" />    
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>