<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Role assign to users') }}
            </h2>
            <a href="{{route('users.index')}}" class="bg-slate-700 text-md rounded-md px-3 py-3 text-white hover:bg-blue-400">List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route('users.update',$user->id)}}" method="POST">
                        @csrf
                        <div>
                            <label for="" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input value="{{old('name',$user->name)}}" name="name" placeholder="Enter user name" type="text" class="form-control border-gray-300 shadow-sm w-1/2 rounded-lg text-black text-lg" autocomplete="off">
                                @error('name')
                                <p class="text-red-500 font-medium">{{$message}}</p>    
                                @enderror
                            </div>
                            <label for="" class="text-lg font-medium">Email</label>
                            <div class="my-3">
                                <input value="{{old('email',$user->email)}}" name="email" placeholder="Enter user's emai" type="email" class="form-control border-gray-300 shadow-sm w-1/2 rounded-lg text-black text-lg" autocomplete="off">
                                @error('email')
                                <p class="text-red-500 font-medium">{{$message}}</p>    
                                @enderror
                            </div>
                            <div class="grid grid-cols-4 mb-3">
                                    @if($roles->count() > 0)
                                        @foreach($roles as $role)
                                        <div class="mt-4">
                                            <input {{$hasRoles->contains($role->id) ? 'checked' : ''}} type="checkbox" name="role[]" value="{{$role->name}}" id="role-{{$role->id}}}" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 rounded" >
                                            <label for="role-{{$role->id}}">{{$role->name}}</label>
                                        </div>
                                        @endforeach
                                    @endif
                            </div>
                            <button class="bg-amber-300 rounded-md px-5 py-3 text-black text-lg"> Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>