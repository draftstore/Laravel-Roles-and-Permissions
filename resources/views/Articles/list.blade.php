<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-3">
                    {{ __('Articles') }}
                </h2>
                {{-- @can('create articles') --}}
                <a href="{{route('articles.create')}}" class="bg-slate-700 text-md rounded-md px-3 py-3 text-white hover:bg-blue-400">Create</a>
                {{-- @endcan --}}
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
                        <th class="px-6 py-3 text-center text-white">Author Name</th>
                        <th class="px-6 py-3 text-center text-white">Article Title</th>
                        <th class="px-6 py-3 text-center text-white">Article Text</th>
                        <th class="px-6 py-3 text-center text-white">Article Created</th></th>
                        <th class="px-6 py-3 text-center text-white ">Permission Control</th>
                    </tr>
                </thead>
                <tbody class="text-white uppercase bg-gray-50 dark:bg-gray-700 dark:text-white-400 border-b">
                    @if($articles->isnotEmpty())
                        @foreach($articles as $key=>$article)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-3 text-center">{{$key+1}}</td>
                        <td class="px-6 py-3 text-center "> {{$article->author}}</td>
                        <td class="px-6 py-3 text-center "> {!!Illuminate\Support\Str::limit($article->title,20)!!}</td>
                        <td class="px-6 py-3 text-center "> {!!Illuminate\Support\Str::limit($article->text,10)!!}</td>
                        <td class="px-6 py-3 text-center">{{$article->created_at->toFormattedDateString()}}</td>
                        <td class="px-6 py-3 text-center">
                            {{-- @can('edit articles') --}}
                            <a href="{{route('articles.edit',$article->id)}}" class="flex justify-center">
                                <img alt="Edit Article" src="{{asset('assets/image/edit button.svg')}}" class="bg-slate-900 text-sm rounded-md px-3 py-3 text-white hover:bg-slate-800">
                            </a>
                            {{-- @endcan --}}
                            {{-- @can('delete articles') --}}
                            <form action="{{route('articles.destroy',$article->id)}}" method="POST" class="">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="text-sm rounded-md text-white btn-delete flex justify-end jungle">
                                    <img alt="Delete Article" src="{{asset('assets/image/delete.svg')}}" class="bg-red-400 text-sm rounded-md px-3 py-3  text-white hover:bg-red-400">
                                </a>
                            </form>
                            {{-- @endcan --}}
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-3">
               
            </div>
        </div>
    </div>

</x-app-layout>