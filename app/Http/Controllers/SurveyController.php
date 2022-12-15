<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Http\Requests\SurveyRequest;

class SurveyController extends Controller
{   
    // show survey list
    public function show_list(Survey $survey){
        return view('survey/list') -> with(['surveys' => $survey->getPaginateDESC(3)]);
    }
    
    // create new page with embedded Google Form 
    public function create(Survey $survey){
        return view('survey/create');
    }
    
    // store inputs to 'surveys' table
    public function store(SurveyRequest $request, Survey $survey){
        $input = $request['survey'];
        $input['url'] = str_replace('?usp=sf_link', '?embedded=true', $input['url']);
        $survey -> fill($input) -> save();
        return redirect('/survey/'.$survey->id);
    }
    
    // show a page with embedded Google Form
    public function show(Survey $survey){
        return view('survey/show') -> with(['survey' => $survey]);
    }
}
