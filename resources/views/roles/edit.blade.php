<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Roles Update') }}
            </h2>
            <a href="{{route('roles.index')}}" class="bg-slate-700 text-md rounded-md px-3 py-3 text-white hover:bg-blue-400">List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route('roles.update',$role->id)}}" method="POST">
                        @csrf
                        <div>
                            <label for="" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input value="{{old('name',$role->name)}}" name="name" placeholder="Enter Role name" type="text" class="form-control border-gray-300 shadow-sm w-1/2 rounded-lg text-black text-lg" autocomplete="off">
                                @error('name')
                                <p class="text-red-500 font-medium">{{$message}}</p>    
                                @enderror
                            </div>
                            <div class="grid grid-cols-4 mb-3">
                                    @if($permissions->count() > 0)
                                        @foreach($permissions as $permission)
                                        <div class="mt-4">
                                            <input {{($hasPermissions->contains($permission->name)) ? 'checked' : ''}} type="checkbox" name="permission[]" value="{{$permission->name}}" id="permission-{{$permission->id}}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" >
                                            <label for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                        </div>
                                        @endforeach
                                    @endif
                            </div>
                            <button class="bg-amber-300 rounded-md px-5 py-3 text-black text-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>