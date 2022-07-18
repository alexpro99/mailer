<div class="">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailer') }}
        </h2>
    </x-slot>

    <div class="py-12 w-full h-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 inline-flex space-x-5">

            <aside class="w-64 float-left m-4 p-1" aria-label="Sidebar">
                <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                    <ul class="space-y-2">

                        <li>
                            <a wire:click='$set("mailState", "sended")'
                                class="flex items-center p-2 text-base font-normal {{ $mailState == 'sended' ? 'bg-slate-300' : '' }} text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

                                <span class="flex-1 ml-3 whitespace-nowrap">Sended</span>
                                <span
                                    class="inline-flex justify-center items-center p-3 ml-3 w-3 h-3 text-sm font-medium text-blue-600 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-200">{{ $cantSended }}</span>
                            </a>
                        </li>
                        <li>
                            <a wire:click='$set("mailState", "not sended")'
                                class="flex items-center p-2 text-base font-normal {{ $mailState == 'not sended' ? 'bg-slate-300' : '' }} text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

                                <span class="flex-1 ml-3 whitespace-nowrap">Pendent</span>
                                <span
                                    class="inline-flex justify-center items-center p-3 ml-3 w-3 h-3 text-sm font-medium text-blue-600 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-200">{{ $cantNotSended }}</span>
                            </a>
                        </li>
                        @can('isUser')
                            <li>
                                <a wire:click='$set("mailState", "stored")'
                                    class="flex items-center p-2 text-base {{ $mailState == 'stored' ? 'bg-slate-300' : '' }} font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

                                    <span class="flex-1 ml-3 whitespace-nowrap">Saved</span>
                                    <span
                                        class="inline-flex justify-center items-center p-3 ml-3 w-3 h-3 text-sm font-medium text-blue-600 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-200">{{ $cantStored }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>

                </div>
            </aside>
            @include('livewire.crud-emails.create')
            @include('livewire.crud-emails.view')
            @include('livewire.crud-emails.edit')
            <main class="w-full m-4 mr-0 h-full float-right bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <div class="col-span-6 sm:col-span-3 inline-flex">
                    <x-jet-label id="filter_label" for='filter' class="col-span-1 m-1 text-lg mt-1" value='Filter' />

                    <x-jet-input id="filter" type="text" class="m-1 block col-span-3" placeholder="destiny"
                        wire:model='filter' />
                </div>
                <div class="col-span-6 sm:col-span-4 inline-flex float-right">
                    @if (session()->has('message'))
                        <div class="bg-green-300 rounded-md p-1 m-2 h-7">
                            {{ session('message') }}
                        </div>
                    @endif
                    @can('isUser')
                        <x-jet-button class="m-2 col-span-2" wire:click="showCreate"> Create </x-jet-button>
                    @endcan

                </div>

                <table class="table-fixed w-full">
                    <thead class="bg-slate-400 w-full table-header-group">
                        <tr class="table-row">
                            <th class="w-full">No.</th>
                            <th class="w-full">Topic</th>
                            <th class="w-full">Destinatary</th>
                            <th class="w-full">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($emails->count())

                            @foreach ($emails as $email)
                                <tr wire:click='setSelectMail("{{ $email->id }}")'
                                    class="text-center table-row mt-2 hover:bg-slate-300 {{ $selectedMail == $email->id ? 'bg-purple-300' : '' }}">
                                    <td class="">{{ $loop->iteration }}</td>
                                    <td class="">{{ $email->topic }}</td>
                                    <td class="">{{ $email->destiny }}</td>
                                    <td class="inline-flex">
                                        <x-jet-button class="m-2 col-span-2 w-1/3 p-2 bg-blue-500 hover:bg-blue-300"
                                            wire:click="view('{{ $email->id }}')"> View </x-jet-button>
                                        <x-jet-button class="m-2 col-span-2 w-1/3 p-2 bg-red-500 hover:bg-red-300"
                                            wire:click="delete('{{ $email->id }}')"> Del </x-jet-button>
                                        @can('isUser')
                                            @if ($mailState == 'stored')
                                                <x-jet-button
                                                    class="m-2 col-span-2 w-1/4 p-2 bg-yellow-500 hover:bg-yellow-300"
                                                    wire:click="editView('{{ $email->id }}')"> Edit </x-jet-button>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center text-red-600" colspan="4">There are not emails :(</td>
                            </tr>
                        @endif

                    </tbody>


                    <tfoot class="">
                        @if ($emails->count())
                            <tr>
                                <th colspan="1">
                                    <select wire:model='inputs' class="select-text" placeholder="seleccione">
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="250">250</option>
                                    </select>
                                </th>
                                <th colspan="5">{{ $emails->links() }}</th>
                            </tr>
                        @endif
                    </tfoot>
                </table>
            </main>
        </div>
    </div>

</div>
