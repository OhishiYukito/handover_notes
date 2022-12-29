<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Calendar;

class CalendarController extends Controller
{
    // show calendar
    public function show(){
        return view('calendar/calendar');
    }
    
    // add a new event
    public function scheduleAdd(Request $request)
    {
        // validation
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'event_name' => 'required|max:32',
        ]);

        // registration process
        $calendar = new Calendar;
        // change to date, and time unit ( [ms] -> [s] )
        $calendar->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $calendar->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $calendar->event_name = $request->input('event_name');
        $calendar->save();
        
        #send LINE message
        $this->sendLINEMessage("New event '".$calendar->event_name."' was added.\nperiod:".$calendar->start_date." ~ ".$calendar->end_date);
        
        return $calendar->id;
    }
    
    // get events info from database
    public function scheduleGet(Request $request)
    {
        // validation
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer'
        ]);

        // get the displayed calendar period
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);

        // get events info
        return Calendar::query()
            ->select(
                // match FullCalendar's format
                'start_date as start',
                'end_date as end',
                'event_name as title',
                'id as id'
            )
            // only get data for the same period as a calendar
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date)
            ->get();
    }
    
    // edit events date
    // add a new event
    public function scheduleEditPeriod(Request $request, Calendar $calendar)
    {
        // validation
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'event_id' => 'required|integer',
        ]);

        // registration process
        $calendar = $calendar
                    ->where('id', '=', $request->input('event_id'))
                    ->get()[0];
        // change to date, and time unit ( [ms] -> [s] )
        $calendar->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $calendar->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $calendar->save();
        
        $this->sendLINEMessage("Event '".$calendar->event_name."' was rescheduled.\nperiod:".$calendar->start_date." ~ ".$calendar->end_date);
        
        return;
    }
    
    public function scheduleDelete(Request $request, Calendar $calendar)
    {
        //dd($request);
        $request->validate([
            'event_id' =>'required|integer',
        ]);
 
        $calendar = $calendar
                    ->where('id', '=', $request->input('event_id'))
                    ->get()[0];
                    
        //dd($calendar);
        $calendar->delete();
        
        $this->sendLINEMessage("Event '".$calendar->event_name."' was canceled.\nperiod:".$calendar->start_date." ~ ".$calendar->end_date);
        
        return;
    }
    
    // send LINEMessage function
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
