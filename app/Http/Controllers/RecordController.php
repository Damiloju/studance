<?php

namespace App\Http\Controllers;

use App\Event;
use App\Record;
use App\Student;
use Exception;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $student = $student->where('matric_number',$request->matric_number)->get();
            $data['student_id'] = $student[0]->id;
            $student->load('program.department');
            $record = $record->where('event_id',$request->event)->where('student_id',$data['student_id'])->first();
            if ($record === null) {
                $record->create($data);
                $records =  $record->where('event_id',$request->event)->get();
                $records = $records->load('student.program.department');

                return apiSuccess('Event created succesfully',$records,[]);
            }

            return apiFailure('That student has already been added to the list',[],1);

        }catch(Exception $e){
            return apiFailure($e->getMessage(),[],1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
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
