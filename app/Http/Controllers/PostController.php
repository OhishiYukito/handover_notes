<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class PostController extends Controller
{
    // show note list
    public function show_list(Note $note){
        return view('notes/list_notes') -> with(['notes' => $note->getPaginateDESC(3)]);
    }
    
    public function show(Note $note){
        return view('notes/show') -> with(['note' => $note]);
    }
    
}
