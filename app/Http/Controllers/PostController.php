<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\Survey;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    // show note list
    public function show_list(Note $note){
        return view('notes/list_notes') -> with(['notes' => $note->getPaginateDESC(3)]);
    }
    
    // show a note details
    public function show(Note $note){
        // get surveys with the same tag as note
        $surveys = Survey::where('tag', $note->tag)->get();
        return view('notes/show') -> with(['note' => $note, 'surveys' => $surveys]);
    }
    
    // jump to create page
    public function create(Note $note){
        return view('notes/create') -> with(['notes' => $note]);
    }
    
    // save input datas from the create page into a table
    public function store(PostRequest $request, Note $note){
        $input = $request['event'];
        $id = Auth::id();
        $note -> fill($input) -> fill(['creator'=>$id, 'updater'=>$id])-> save();
        
        #send LINE message
        $url = url('notes/'.$note->id);
        $this->sendLINEMessage($url.' was created.');
        
        return redirect('/notes/' . $note->id);
    }
    
    // edit existing notes
    public function edit(int $note_id, Note $notes){
        $note = $notes->find($note_id);
        return view('notes/edit')-> with(['notes'=>$notes, 'note'=>$note]);
    }
    
    // update table datas with inputs from edit page
    public function update(PostRequest $request, Note $note){
        $input_data = $request['event'];
        $note->fill($input_data)->save();
        
        # send LINE messsage
        $url = url('notes/'.$note->id);
        $this->sendLINEMessage($url.' was updated.');
        
        return redirect('notes/'.$note->id);
    }
    
    public function sendLINEMessage(string $text){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('services.line.access_token'));
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('services.line.channel_secret')]);
        
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
        return $bot->broadcast($textMessageBuilder);
    }
    
    
    // jump login page if a user didn't log in
    public function __construct(){
        $this->middleware('auth');
    }
}
