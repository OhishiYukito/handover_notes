<!DOCTYPE html>

<x-app-layout>
    <!-- header -->
    <x-slot name="header">
        　<a href="/survey">{{__('Back to list')}}</a>
    </x-slot>

    <!-- contents -->
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!-- contents_head -->
        <head>
            <meta charset="utf-8">
            <title>Show GoogleForm</title>
            <!-- Fonts -->
            <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        </head>
        
        <!-- contents_body -->
        <body>
            <h1 class='text-3xl text-center m-8'>{{ $survey->title }}</h1>
            
            <!-- Embed Google Form in here -->
            <iframe src="{{ $survey->url }}" width="100%" height="70%" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
            
            <!-- back to list button -->
            <div class='w-full h-8 relative'>
                <a class='absolute right-10 border-4' href='/survey'>一覧に戻る</a>
            </div>
            
        </body>
    </html>
    
</x-app-layout>