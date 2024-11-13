<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-3">
                    {{ __('Activity Logs') }}
                </h2>
            </div>
    </x-slot>
    <style>
        a.text-sm.rounded-md.text-white.btn-delete.flex.justify-end.jungle{
            margin-top: -52px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <table class="w-full">
                <thead class="bg-slate-700">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-center text-white">Articles List</th>
                        <th class="px-6 py-3 text-center text-white">Activity User</th>
                        <th class="px-6 py-3 text-center text-white">Table Name</th>
                        <th class="px-6 py-3 text-center text-white">Action</th>
                        <th class="px-6 py-3 text-center text-white">Changes</th>
                        <th class="px-6 py-3 text-center text-white">Date</th>
                    </tr>
                </thead>
                <tbody class="text-white uppercase bg-gray-50 dark:bg-gray-700 dark:text-white-400 border-b">
                    @if($logs->isnotEmpty())
                    @foreach($logs as $key=>$log)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-3 text-center">{{$key+1}}</td>
                        <td class="px-6 py-3 text-center "> {{ $log->user->name }} </td>
                        <td class="px-6 py-3 text-center">{{ $log->table_name }}</td>
                        <td class="px-6 py-3 text-center">{{ $log->action}}</td>
                        <td class="px-6 py-3 text-center">
                            @if(is_array($log->changed_columns) && !empty($log->changed_columns))
                            @foreach($log->changed_columns as $column => $changes)
                                Column changed - <strong> {{ $column }} </strong>: <br>
                                Old value -  <strong> {{ $changes['old'] ?? 'N/A' }} </strong> <br>
                                New value - <strong> {{ $changes['new'] ?? 'N/A' }} </strong>  <br>
                            @endforeach
                        @else
                            No changes recorded
                        @endif
                        </td>
                        <td class="px-6 py-3 text-center">{{ $log->created_at }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>