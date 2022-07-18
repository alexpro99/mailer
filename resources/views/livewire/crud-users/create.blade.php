<x-jet-modal wire:model="createModalToggle" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="w-full bg-slate-800 h-10 mt-0">
            <div class="ml-1 inline-flex w-full">
                <h1 class="text-white text-xl">Create user</h1>
                <button type="button" wire:click.prevent='$toggle("createModalToggle")'
                    class="text-white float-right mr-3 ml-auto">x</button>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="bg-green-500 rounded-md">
                {{ session('message') }}
            </div>
        @endif
        <div class="p-2 m-3">
            <form class="grid grid-cols-3">
                <div class="m-1">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" type="email" wire:model='email' class="mt-1 block w-full" />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" wire:model='name' type="text" class="mt-1 block w-full" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="identificator" value="{{ __('Identificator') }}" />
                    <x-jet-input id="identificator" wire:model='identificator' type="text"
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="identificator" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model='password' />
                    <x-jet-input-error for="password" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required wire:model='password_confirmation' />
                    <x-jet-input-error for="password_confirmation" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="cedula" value="{{ __('Cedula') }}" />
                    <x-jet-input id="cedula" type="text" class="mt-1 block w-full" required wire:model='cedula' />
                    <x-jet-input-error for="cedula" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="phone_number" value="{{ __('Phone Number') }}" />
                    <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model='phone_number' />
                    <x-jet-input-error for="phone_number" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="birth_date" value="{{ __('Birth Date') }}" />
                    <x-jet-input id="birth_date" type="date" class="mt-1 block w-full" wire:model='birth_date' />
                    <x-jet-input-error for="birth_date" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="countries" value="{{ __('Country') }}" />
                    <select class="border-solid rounded-md border-gray-200 mt-1 block w-full" name="countries"
                        wire:model='country' id="countries" wire:init='redyToLoadCountries'>
                        <option value="">Select a country</option>
                        @foreach ($countries as $item)
                            @php
                                $item = (array) $item;
                            @endphp
                            <option value="{{ $item['country_name'] }}">{{ $item['country_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="m-1">
                    <x-jet-label for="state" value="{{ __('State') }}" />
                    <select class="border-solid rounded-md border-gray-200 mt-1 block w-full" name="state"
                        wire:model='state' id="state">
                        <option value="">Select a country</option>
                        @foreach ($states as $item)
                            @php
                                $item = (array) $item;
                            @endphp
                            <option value="{{ $item['state_name'] }}">{{ $item['state_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="m-1">
                    <x-jet-label for="cities" value="{{ __('City') }}" />
                    <select class="border-solid rounded-md border-gray-200 mt-1 block w-full" name="cities"
                        wire:model='city' id="cities">
                        <option value="">Select a country</option>
                        @foreach ($cities as $item)
                            @php
                                $item = (array) $item;
                            @endphp
                            <option value="{{ $item['city_name'] }}">{{ $item['city_name'] }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="city" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="city_code" wire:model='city_code' value="{{ __('City Code') }}" />
                    <x-jet-input id="city_code" type="text" class="mt-1 block w-full" wire:model='city_code' />
                    <x-jet-input-error for="city_code" class="mt-2" />
                </div>

            </form>
        </div>

        <div class="mt-3 inline-flex ml-4 float-left mr-2 mb-3">
            <div class="" wire:loading>
                loading...
            </div>
        </div>
        <div class="mt-3 inline-flex ml-4 float-right mr-2 mb-3">
            <x-jet-button wire:click="$toggle('createModalToggle')" wire:loading.attr="disabled">
                Close
            </x-jet-button>

            <x-jet-button class="ml-2 bg-blue-600" wire:click="store" wire:loading.attr="disabled">
                Save
            </x-jet-button>
        </div>
    </div>


    </x-jet-modal>
