<?php

namespace App\Http\Controllers;

use App\Event;
use App\Record;
use App\Student;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use JavaScript;


class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::withTrashed()->get();

        JavaScript::put([
            'events' => $events
        ]);
        return view('admin.records.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'matric_number' => 'required',
            'event' => 'required'
        ]);

        $event = new Event;
        $student = new Student;
        $record =  new Record;
        $data = [];
        $data['event_id'] = $request->event;

        try {
            $student = $student->where('matric_number',$request->matric_number)->orWhere('temp_number', $request->matric_number)->get();

            if ($student->isEmpty()) {
                return apiFailure('That student does not exist',[],1);
            }
            $data['student_id'] = $student[0]->id;
            $student->load('program.department');
            $record_exist = $record->where('event_id',$request->event)
                            ->where('student_id',$data['student_id'])
                            ->first();
            if ($record_exist === null) {
                $record->create($data);
                $records =  $record->where('event_id',$request->event)
                                    ->get();
                $records = $records->load(['student' => function ($query){
                    $query->withTrashed()->with('program.department');
                }]);

                return apiSuccess('Event created succesfully',$records,[]);
            }

            return apiFailure('That student has already been added to the list',[],1);
        }catch(QueryException $e){
            return apiFailure($e->getMessage(),[],1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'event' => 'required'
        ]);

        $record =  new Record;

        try {
            $records =  $record->where('event_id',$request->event)
                ->get();
            $records = $records->load(['student' => function ($query){
                $query->withTrashed()->with('program.department');
            }]);

            return apiSuccess('Records gotten succesfully',$records,[]);

        }catch(QueryException $e){
            return apiFailure($e->getMessage(),[],1);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}
