<div>
    

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-span-6 sm:col-span-4 inline-flex">
                    <x-jet-label id="filter_label" for='filter' class="col-span-1 m-1 text-lg mt-1" value='Filter' />
                    <x-jet-input id="filter" type="text" class="m-1 block col-span-3"
                        placeholder="name, email, phone, cedula" wire:model='filter' />
                </div>

                <div class="col-span-6 sm:col-span-4 inline-flex float-right">
                    <x-jet-button class="m-2 col-span-2" wire:click="$toggle('createModalToggle')"> Create
                    </x-jet-button>
                    <x-jet-button class="m-2 col-span-2 bg-yellow-400"> Edit </x-jet-button>
                </div>

                {{-- incluyendo el modal --}}
                @include('livewire.crud-users.create')

                <table class="table-fixed w-full">
                    <thead class="bg-slate-400 w-full table-header-group">
                        <tr class="table-row">
                            @foreach ($columns as $item)
                                <th class="w-full" wire:click='sort("{{ $item }}")'>{{ $item }}
                                    @if ($sortColumn == $item)
                                        <i>{{ $sortDirection == 'asc' ? 'A' : 'D' }}</i>
                                    @endif

                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center table-row {{ $selectedUser == $user->id ? 'bg-gray-300' : '' }}"
                                wire:click='selectUser("{{ $user->id }}")'>
                                @foreach ($columns as $col)
                                    <td class="w-full table-cell p-2 truncate">
                                        @if ($col == 'age')
                                            {{ $user->age() }}
                                        @else
                                            {{ $user->$col }}
                                        @endif
                                @endforeach
                                </td>
                            </tr>
                        @endforeach


                    </tbody>


                    <tfoot class="">
                        <tr>
                            <th colspan="1">
                                <select wire:model='inputs' class="select-text" placeholder="seleccione">
                                    <option value="10">10</option>
                                    <option value="10">50</option>
                                    <option value="100">100</option>
                                    <option value="150">250</option>
                                </select>
                            </th>
                            <th colspan="5">{{ $users->links() }}</th>
                        </tr>
                    </tfoot>
                </table>


            </div>
        </div>
    </div>
</div>
