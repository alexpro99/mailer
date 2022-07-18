<div>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <div class="col-span-6 sm:col-span-3 inline-flex">
                    <x-jet-label id="filter_label" for='filter' class="col-span-1 m-1 text-lg mt-1" value='Filter' />

                    <x-jet-input id="filter" type="text" class="m-1 block col-span-3"
                        placeholder="log name, description..." wire:model='filter' />
                </div>
                <table class="table-fixed w-full">
                    <thead class="bg-slate-400 w-full table-header-group">
                        <tr class="table-row">
                            <th class="w-full">No.</th>
                            <th class="w-full">Log Name</th>
                            <th class="w-full">Description</th>
                            <th class="w-full">Event</th>
                            <th class="w-full">Model</th>
                            <th class="w-full">Causer name</th>
                            <th class="w-full">Causer email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($activities->count())

                            @foreach ($activities as $activity)
                                <tr class="text-center table-row mt-2 hover:bg-slate-300 ">
                                    <td class="">{{ $loop->iteration }}</td>
                                    <td class="">{{ $activity->log_name }}</td>
                                    <td class="">{{ $activity->description }}</td>
                                    <td class="">{{ $activity->event }}</td>
                                    <td class="">{{ $activity->subject_type }}</td>
                                    <td class="">{{ $activity->causer->name }}</td>
                                    <td class="">{{ $activity->causer->email }}</td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center text-red-600" colspan="4">There are not activity :(</td>
                            </tr>
                        @endif

                    </tbody>


                    <tfoot class="">
                        @if ($activities->count())
                            <tr>
                                <th colspan="1">
                                    <select wire:model='inputs' class="select-text" placeholder="seleccione">
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="250">250</option>
                                    </select>
                                </th>
                                <th colspan="5">{{ $activity_log->links() }}</th>
                            </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
        </div>
    </div>




</div>
