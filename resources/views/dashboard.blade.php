<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <h1 class="text-2xl m-4">Welcome {{Auth::user()->name}}</h1>

                <div class="grid grid-cols-3 m-5">
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="name" value="{{ __('Name:') }}" />
                        <x-jet-label for="name" value="{{ Auth::user()->name }}" />
                    </div>
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="email" value="{{ __('Email:') }}" />
                        <x-jet-label for="email" value="{{ Auth::user()->email }}" />
                    </div>
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="cedula" value="{{ __('Cedula:') }}" />
                        <x-jet-label for="cedula" value="{{ Auth::user()->cedula }}" />
                    </div>
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="city" value="{{ __('City:') }}" />
                        <x-jet-label for="city" value="{{ Auth::user()->city }}" />
                    </div>
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="city_code" value="{{ __('City Code:') }}" />
                        <x-jet-label for="city_code" value="{{ Auth::user()->city_code }}" />
                    </div>
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="birth_date" value="{{ __('Birth Date:') }}" />
                        <x-jet-label for="birth_date" value="{{ Auth::user()->birth_date }}" />
                    </div>
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="age" value="{{ __('Age:') }}" />
                        <x-jet-label for="age" value="{{ Auth::user()->age() }}" />
                    </div>
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="phone_number" value="{{ __('Phone:') }}" />
                        <x-jet-label for="phone_number" value="{{ Auth::user()->phone_number }}" />
                    </div>
                    <div class="m-1 inline-flex space-x-2 mt-4">
                        <x-jet-label for="role" value="{{ __('Role:') }}" />
                        <x-jet-label for="role" value="{{ Auth::user()->role }}" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
