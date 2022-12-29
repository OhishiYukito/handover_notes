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
                  <!-- use FullCallender -->
                  @vite(['resources/css/app.css', 'resources/js/app.js'])
            </head>
            
            <!-- contents_body -->
            <body>
                  <div id='calendar'></div>
            </body>
      </html>
    
</x-app-layout>