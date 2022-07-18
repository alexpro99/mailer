<x-jet-modal wire:model="viewModalToggle" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="w-full bg-slate-800 h-10 mt-0">
            <div class="ml-1 inline-flex w-full">
                <h1 class="text-white text-xl">View mail</h1>
                <button type="button" wire:click.prevent='$toggle("viewModalToggle")'
                    class="text-white float-right mr-3 ml-auto">x</button>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="bg-green-500 rounded-md">
                {{ session('message') }}
            </div>
        @endif
        <div class="p-2 m-3">
            <form class="grid grid-cols-1">
                <div class="m-1 w-full">
                    <x-jet-label for="topic" value="{{ __('Topic:') }}" />
                    <x-jet-input id="topic" wire:model='topic' type="text" disabled class="mt-1 block w-full" />
                    <x-jet-input-error for="topic" class="mt-2" />
                </div>
                <div class="m-1 w-full">
                    <x-jet-label for="destiny" value="{{ __('To:') }}" />
                    <x-jet-input id="destiny" wire:model='destiny' type="email" disabled
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="destiny" class="mt-2" />
                </div>
                <div class="m-1 w-full">
                    <x-jet-label for="body" value="{{ __('Body:') }}" />
                    <textarea id="body" wire:model='body' rows="8" disabled
                        class="block px-0 w-full text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                        placeholder="Write your email..." required></textarea>
                    <x-jet-input-error for="body" class="mt-2" />
                </div>

            </form>
        </div>

        <div class="mt-3 inline-flex ml-4 float-left mr-2 mb-3">
            <div class="" wire:loading>
                loading...
            </div>
        </div>
        <div class="mt-3 inline-flex ml-4 float-right mr-2 mb-3">
            <x-jet-button wire:click="$toggle('viewModalToggle')" class="bg-red-500 m-3" wire:loading.attr="disabled">
                Cancel
            </x-jet-button>

            @can('isUser')

                @if ($mailState != 'stored')
                    <x-jet-button wire:click="store" class="bg-gray-500 m-3" wire:loading.attr="disabled">
                        Save
                    </x-jet-button>
                @endif

                @if ($mailState == 'stored')
                    <x-jet-button class="m-3 bg-blue-600" wire:click="sendSaved" wire:loading.attr="disabled">
                        Send
                    </x-jet-button>
                @endif
            @endcan
        </div>
    </div>


</x-jet-modal>
