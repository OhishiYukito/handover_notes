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
            <title>Create Handover_Note</title>
            <!-- Fonts -->
            <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        </head>
        
        <!-- contents_body -->
        <body>
            <script src="../../js/get_select.js"></script>
            <h1 class="text-3xl text-center m-8">ノートの編集</h1>
            <div class="relative">
                <!-- input format -->
                <form action="/notes/{{$note->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-evenly">
                        <!-- input: select event_year -->
                        <p>年度:&emsp;
                            <input type="text" list="event_year" name="event[event_year]" placeholder="入力または選択" autocomplete="off" value="{{ $note->event_year }}">
                                <datalist id="event_year">
                                    <!-- create options from [notes]table -->
                                    @foreach($notes->getElements("event_year") as $element)
                                        <option value={{$element->event_year}}>
                                    @endforeach
                                </datalist>
                            </input>
                        </p>
                        
                        <!-- input: select event_name -->
                        <p>イベント名:&emsp;
                            <input type="text" list="event_name" name="event[event_name]" placeholder="入力または選択" autocomplete="off" value="{{ $note->event_name }}">
                                <datalist id="event_name">
                                    <!-- create options from [notes]table -->
                                    @foreach($notes->getElements("event_name") as $element)
                                        <option value={{$element->event_name}}>
                                    @endforeach
                                </datalist>
                            </input>
                        </p>
                        <p>タグ:&emsp;
                            <input type="text" list="event_tag" name="event[tag]" placeholder="入力または選択" autocomplete="off" value="{{ $note->tag }}">
                                <datalist id="event_tag">
                                    <!-- create options from [notes]table -->
                                    @foreach($notes->getElements("tag") as $element)
                                        <option value={{$element->tag}}>
                                    @endforeach
                                </datalist>
                            </input>
                        </p>
                    </div>  
                    
                    <!-- error messages -->
                    <div class="ml-8">
                        <p style="color:red">{{ $errors->first('event.event_year') }}</p>
                        <p style="color:red">{{ $errors->first('event.event_name') }}</p>
                        <p style="color:red">{{ $errors->first('event.tag') }}</p>
                    </div>
                    
                    <!-- note title -->
                    <input class="ml-8 mt-8" type="text" name="event[title]" size=100 placeholder="タイトルを入力" autocomplete="off" value="{{ $note->title }}"></input>
                    <p class="ml-8 mb-8" style="color:red">{{ $errors->first('event.title') }}</p>
                    
                    <!-- note text -->
                    <textarea class="ml-8 mr-8 mb-4" cols=100 rows=15 name="event[text]" placeholder="本文を入力">{{ $note->text }}</textarea>
                    <p class="ml-8" style="color:red">{{ $errors->first('event.text') }}</p>
                    
                    <!-- save button -->
                    <input class="absolute right-10 mt-4" type="submit" value="保存"></input>
                    
                </form>
            </div>
        </body>
    </html>
    
</x-app-layout>