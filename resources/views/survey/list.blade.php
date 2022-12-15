<!DOCTYPE html>

<x-app-layout>
    <!-- header -->
    <x-slot name="header">
        　{{__('This is a header')}}
    </x-slot>

    <!-- contents -->
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!-- contents_head -->
        <head>
            <meta charset="utf-8">
            <title>Google Forms</title>
            <!-- Fonts -->
            <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        </head>
        
        <!-- contents_body -->
        <body>
            <h1 class='text-3xl text-center m-8'>Google Form list</h1>
            <div class='w-full h-8 relative'>
                <a class='absolute right-10 border-4' href="/survey/create">新しいGoogleFormを埋め込む</a>
            </div>
            <div class='mt-8'>
                @foreach($surveys as $survey)
                    <h2 class='text-xl ml-4 mb-4 border-t-4'>
                        <a href="/survey/{{$survey->id}}">
                            {{ $survey->title }}
                        </a>
                    </h2>
                @endforeach
                <div class='paginate_links'>
                    {{ $surveys->links() }}
                </div>
            </div>
        </body>
    </html>
    
</x-app-layout>