<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Permissions Create') }}
            </h2>
            <a href="{{route('permissions.index')}}" class="bg-slate-700 text-md rounded-md px-3 py-3 text-white hover:bg-blue-400">List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route('permissions.store')}}" method="POST">
                        @csrf
                        <div>
                            <label for="" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input value="{{old('name')}}" name="name" placeholder="Enter permission name" type="text" class="form-control border-gray-300 shadow-sm w-1/2 rounded-lg text-black text-lg" autocomplete="off">
                                @error('name')
                                <p class="text-red-500 font-medium">{{$message}}</p>    
                                @enderror
                            </div>
                            <button class="bg-amber-300 rounded-md px-5 py-3 text-black text-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>