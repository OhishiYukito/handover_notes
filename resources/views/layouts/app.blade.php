<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="flex">
                    <!-- Side bar [left] -->
                    <div class="h-screen w-1/6">
                        <div class="border h-full">
                            <!-- Side bar title -->
                            <div class="flex items-center justify-center">
                                <p class="text-2xl mt-4">side bar</p>
                            </div>
                            <!-- links -->
                            <nav class="mt-9">
                                <div>
                                    <a href="">
                                        <p class="text-xl text-center">link_01</p>
                                    </a>
                                </div>
                                <div>
                                    <a href="">
                                        <p class="text-xl text-center">link_02</p>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- contents [middle] -->
                    <div class="border grow">
                        {{ $slot }}
                    </div>
                    <!-- Side bar [right] -->
                    <div class="h-screen w-1/6">
                        <div class="border h-full">
                            <!-- Side bar title -->
                            <div class="flex items-center justify-center">
                                <p class="text-2xl mt-4">side bar Right</p>
                            </div>
                            <!-- links -->
                            <nav class="mt-9">
                                <div>
                                    <a href="">
                                        <p class="text-xl text-center">link_01</p>
                                    </a>
                                </div>
                                <div>
                                    <a href="">
                                        <p class="text-xl text-center">link_02</p>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
