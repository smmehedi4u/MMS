<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- tailwind cli --}}
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

    {{-- alpine js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite('resources/css/app.css')


</head>

<body>
    {{-- HEADER PART --}}
    <header class="text-gray-600 body-font bg-gray-100 shadow-md">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <!-- Logo -->
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2"
                    class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl font-semibold">Tempousing</span>
            </a>

            <!-- Navigation -->
            <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 w-30 h-10 rounded-md hover:text-gray-900 transition inline-flex items-center justify-center border border-gray-400 {{ request()->routeIs('admin.dashboard') ? 'bg-green-500 text-white' : ' ' }}">Dashboard</a>
                <a href="{{ route('task.getall') }}" class="bg-gray-300 w-20 h-10 rounded-md hover:text-gray-900 transition inline-flex items-center justify-center border border-gray-400 {{ request()->routeIs('task.getall') ? 'bg-green-500 text-white' : ' ' }}">
                    Task
                </a>
                <a href="{{ route('deposit.getall') }}" class="bg-gray-300 w-20 h-10 rounded-md hover:text-gray-900 transition inline-flex items-center justify-center border border-gray-400 {{ request()->routeIs('deposit.getall') ? 'bg-green-500 text-white' : ' ' }}">Deposit</a>
                <a href="#" class="bg-gray-300 w-20 h-10 rounded-md hover:text-gray-900 transition inline-flex items-center justify-center border border-gray-400">Fourth</a>
            </nav>

            <!-- User Dropdown -->
            <div class="relative hidden sm:flex sm:items-center sm:ms-6" x-data="{ open: false }">
                <!-- Dropdown Button -->
                <button @click="open = !open"
                    class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-200 focus:outline-none transition">
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <svg class="ml-2 h-5 w-5 transition-transform duration-200"
                        :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown Content -->
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-30 w-48 bg-white rounded-md shadow-md z-50 border border-gray-200" x-cloak>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>

    @stack('javascript')


</body>

</html>
