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
            <title>Handover Notes</title>
            <!-- Fonts -->
            <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        </head>
        
        <!-- contents_body -->
        <body>
            <h1 class='text-3xl text-center m-8'>Note list</h1>
            <div>
                @foreach($notes as $note)
                    <h2 class='text-xl ml-4 mb-4 border-t-4'>
                        <a href="/show/{{$note->id}}">
                            {{ $note->event_year }} {{ $note->event_name }}
                        </a>
                    </h2>
                    <p class='body ml-4 mb-8 border-b-4 truncate'>{{ $note->title }}</p>
                @endforeach
                <div class='paginate_links'>
                    {{ $notes->links() }}
                </div>
            </div>
        </body>
    </html>
    
</x-app-layout>