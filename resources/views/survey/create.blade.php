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
            <title>Create Survey_page</title>
            <!-- Fonts -->
            <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        </head>
        
        <!-- contents_body -->
        <body>
            <script src="../../js/get_select.js"></script>
            <h1 class="text-3xl text-center m-8">GoogleFormを埋め込む</h1>
            <div class="relative">
                <!-- input format -->
                <form action="/survey" method="POST">
                    @csrf
                    <!-- input: Google Form URL -->
                    <div class="m-8">
                        <p>URL:</p>
                        <input class="w-full" type="text" name="survey[url]" placeholder="GoogleFormのURLを入力" autocomplete="off" value="{{ old('survey.url') }}"></input>
                        <p style="color:red">{{ $errors->first('survey.url') }}</p>
                    </div>
                    
                    <!-- input: Survey title -->
                    <div class="m-8">
                        <p>タイトル:</p>
                        <input class="w-full" type="text" name="survey[title]" placeholder="タイトルを入力" autocomplete="off" value="{{ old('survey.title') }}"/>
                    </div>
                    
                    <!-- input: Survey tag -->
                    <div class="m-8">
                        <p>タグ:</p>
                        <input class="w-full" type="text" name="survey[tag]" placeholder="対応するノートと共通するタグを入力" autocomplete="off" value="{{ old('survey.tag') }}"/>
                    </div>
                    
                    <input class="absolute right-10 mt-4 border-8" type="submit" value="作成"></input>
                    
                </form>
            </div>
        </body>
    </html>
    
</x-app-layout>