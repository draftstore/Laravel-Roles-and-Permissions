<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="text-center my-4">
            <span class="text-center font-bold text-white">Or</span>
            <div class="w-3/5 mx-auto mt-4">
                <a href="{{route('auth.google')}}" class="focus:ring-2 focus:ring-indigo-800 focus:ring-offset-4 dark:focus:ring-offset-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g fill-rule="evenodd"><path fill="#deebf5" d="M48 64H16A16 16 0 0 1 0 48V16A16 16 0 0 1 16 0h32a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16" opacity="1" data-original="#deebf5" class=""></path><path fill="#f0faff" d="M30 18h18A9 9 0 0 0 48.92.046C48.614.029 48.311 0 48 0H16A16 16 0 0 0 0 16v32a30 30 0 0 1 30-30" opacity="1" data-original="#f0faff" class=""></path><path fill="#cddceb" d="M48 32a16 16 0 1 0 16 16V16a16 16 0 0 1-16 16" opacity="1" data-original="#cddceb" class=""></path></g><path fill="#1e78ff" d="M52 32.469c0-.779-.036-1.561-.109-2.338a1.996 1.996 0 0 0-1.988-1.804c-3.575-.004-11.718-.004-15.5-.004a2 2 0 0 0-2 2v3.857a2 2 0 0 0 2 2h9.02a9.44 9.44 0 0 1-4.078 6.2v.002a5.096 5.096 0 0 0 5.096 5.096h1.479C49.781 43.925 52 38.677 52 32.469z" opacity="1" data-original="#1e78ff" class=""></path><path fill="#00b450" d="M32.403 52.404a19.528 19.528 0 0 0 13.524-4.926l-6.574-5.098a12.375 12.375 0 0 1-18.398-6.47h-1.531a5.255 5.255 0 0 0-5.254 5.254v.002a20.409 20.409 0 0 0 18.233 11.238z" opacity="1" data-original="#00b450"></path><path fill="#ffb400" d="M20.948 35.91a12.214 12.214 0 0 1 0-7.811v-.002a5.255 5.255 0 0 0-5.254-5.254H14.17a20.427 20.427 0 0 0 0 18.323z" opacity="1" data-original="#ffb400"></path><path fill="#e60014" d="M32.403 19.672a11.106 11.106 0 0 1 6.509 1.982 1.966 1.966 0 0 0 2.548-.2c.915-.868 2.118-2.071 3.066-3.019a2 2 0 0 0-.192-2.998 19.794 19.794 0 0 0-11.931-3.839A20.4 20.4 0 0 0 14.17 22.843l6.778 5.256a12.202 12.202 0 0 1 11.455-8.427z" opacity="1" data-original="#e60014" class=""></path></g></svg>
                </a>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
