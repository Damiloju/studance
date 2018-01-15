<?php

namespace App\Http\Controllers;

use App\Event;
use App\Record;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'event' => 'required',
            'session' => 'required',
            'semester' => 'required',
        ]);

        $event = new Event;

        try {
            $event->create($request->all());
            $events =  Event::all();
            return apiSuccess('Event created succesfully',$events,[]);
        }catch(Exception $e){
            return apiFailure($e->getMessage(),[],1);
        }
    }

    public function delete (Event $event)
    {
        try {
            $event->delete();
            $events =  Event::all();
            return apiSuccess('Event deleted succesfully',$events,[]);
        }catch(Exception $e){
            return apiFailure($e->getMessage(),[],1);
        }

    }

    public function index (Event $event)
    {
        try {
            $event = $event->id;
            $record =  new Record;
            $records =  $record->where('event_id',$event)->get();
            $records = $records->load('student.program.department');

            return apiSuccess('Records created succesfully',$records,[]);
        }catch(Exception $e){
            return apiFailure($e->getMessage(),[],1);
        }
    }
}
