<x-jet-modal wire:model="editModalToggle" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="w-full bg-slate-800 h-10 mt-0">
            <div class="ml-1 inline-flex w-full">
                <h1 class="text-white text-xl">Edit user</h1>
                <button type="button" wire:click.prevent='$toggle("editModalToggle")'
                    class="text-white float-right mr-3 ml-auto">x</button>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="p-2 m-3">
            <form class="grid grid-cols-3">

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
                    <x-jet-label for="city_code" value="{{ __('City Code') }}" />
                    <x-jet-input id="city_code" type="text" class="mt-1 block w-full" wire:model='city_code' />
                    <x-jet-input-error for="city_code" class="mt-2" />
                </div>
                <div class="m-1">
                    <x-jet-label for="role"  value="{{ __('Role') }}" />
                    <select id="role" type="text" class="border-solid rounded-md border-gray-200 mt-1 block w-full" wire:model='role'>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>
                    <x-jet-input-error for="role" class="mt-2" />
                </div>

            </form>
        </div>

        <div class="mt-3 inline-flex ml-4 float-left mr-2 mb-3">
            <div class="" wire:loading>
                loading...
            </div>
        </div>
        <div class="mt-3 inline-flex ml-4 float-right mr-2 mb-3">
            <x-jet-button wire:click="$toggle('editModalToggle')" wire:loading.attr="disabled">
                Close
            </x-jet-button>

            <x-jet-button class="ml-2 bg-yellow-400" wire:click="edit" wire:loading.attr="disabled">
                Edit
            </x-jet-button>
        </div>
    </div>


    </x-jet-confirmation-modal>
