<!DOCTYPE html>

<x-app-layout>
    <!-- header -->
    <x-slot name="header">
        　<a href="/notes">{{__('Back to list')}}</a>
    </x-slot>

    <!-- contents -->
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!-- contents_head -->
        <head>
            <meta charset="utf-8">
            <title>Show Handover_Note</title>
            <!-- Fonts -->
            <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        </head>
        
        <!-- contents_body -->
        <body>
            <h1 class='text-3xl text-center m-8'>{{ $note->title }}</h1>
            <div class='w-full h-8 relative'>
                <!-- edit button -->
                <a class='absolute right-10 border-4' href='/notes/{{$note->id}}/edit'>編集する</a>
            </div>
            <div class='relative mt-8'>
                <h2 class='text-base text-right mb-4 border-t-4'>{{ $note->event_name }}</h2>
                <h2 class='text-base text-right mb-4'>{{ $note->event_year }}</h2>
                
                <p class='body ml-4 mb-8 border-t-4 border-b-4'>{{ $note->text }}</p>
                
            </div>
        </body>
    </html>
    
</x-app-layout>