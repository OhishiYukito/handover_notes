<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    // show note list
    public function show_list(Note $note){
        return view('notes/list_notes') -> with(['notes' => $note->getPaginateDESC(3)]);
    }
    
    public function show(Note $note){
        return view('notes/show') -> with(['note' => $note]);
    }
    
    public function create(Note $note){
        return view('notes/create') -> with(['notes' => $note]);
    }
    
    public function store(PostRequest $request, Note $note){
        $input = $request['event'];
        $id = Auth::id();
        $note -> fill($input) -> fill(['creator'=>$id, 'updater'=>$id])-> save();
        return redirect('/notes/' . $note->id);
    }
    
    public function edit(Note $note){
        return view('notes/edit') -> with(['note'=>$note]);
    }
    
    
}
