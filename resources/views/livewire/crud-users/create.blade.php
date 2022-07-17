<x-jet-modal wire:model="createModalToggle">
    <div class="modal-dialog" role="document">
        <div class="">
            <div class="w-full bg-slate-800 h-10 mt-0">
                <div class="text-white text-xl ml-1">
                    <h1>Create user</h1>
                </div>
                <div class="">

                </div>

            </div>
            <form>

            </form>
        </div>

        <div class="footer">
            <x-jet-button wire:click="$toggle('createModalToggle')" wire:loading.attr="disabled">
                Close
            </x-jet-button>

            <x-jet-button class="ml-2 bg-blue-600" wire:click="store" wire:loading.attr="disabled">
                Save
            </x-jet-button>
        </div>
    </div>


    </x-jet-confirmation-modal>
