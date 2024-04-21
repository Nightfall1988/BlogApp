<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="font-sans antialiased">

<div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('list') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            {{ __('BlogApp') }}
                        </a>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700">
                            {{ __('Login') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-gray-500 hover:text-gray-700">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @else
                        <div class="relative">
                            <button type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline" id="user-menu" aria-label="User menu" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <span class="text-gray-700 font-semibold">{{ Auth::user()->name }}</span>
                            </button>
                
                            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg hidden" id="user-dropdown">
                                <div class="py-1 bg-white rounded-md shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Logout') }}</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
                
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-4 flex justify-center">
        @yield('content')
    </main>
</div>

<!-- Scripts -->

<script src="{{ asset('build/assets/app.js') }}" defer></script>
<script>
    document.getElementById('user-menu').addEventListener('click', function() {
        var dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('hidden');
    });
</script>

</body>
</html>
