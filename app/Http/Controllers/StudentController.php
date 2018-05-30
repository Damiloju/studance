<?php

namespace App\Http\Controllers;

use App\Student;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use JavaScript;
use Mockery\Exception;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    private $filepath;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generateBarcode()
    {
        $students =  Student::all();

        return view('admin.students.barcode',compact('students'));
    }

    public function generatePDF(PDF $pdf)
    {
        $students =  Student::with('program.department')->get();
        return $pdf = $pdf->loadView('admin.students.codes', compact('students'))->stream();
    }


    public function index()
    {
        $students =  Student::all();
        $students->load('program.department');
        JavaScript::put([
        'students' => $students
        ]);
        return view('admin.students.home');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required',
            'photo' => 'required|image64:jpeg,jpg',
            'matric_number' => 'required',
            'program_id'=> 'required'
        ]);
        if ($validator->fails()) {
            return apiFailure($validator->errors(),[],1);
        }

        $student = new Student;

        $imageData = $request['photo'];
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        $this->filepath = storage_path('app/public/students/').$fileName;
        Image::make($imageData)->save($this->filepath);
        $data['name'] = $request->name;
        $data['photo'] = $this->filepath;
        $data['matric_number'] = $request->matric_number;
        $data['program_id'] = $request->program_id;
        $data['level'] = $request->level;

        try {
            $student->create($data);
            $students =  Student::all();
            $students->load('program.department');
            return apiSuccess('Student created succesfully',$students,[]);
        }catch(Exception $e){
            return apiFailure($e->getMessage(),[],1);
        }
    }

    public function storeStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required',
            'photo' => 'required|image64:jpeg,jpg',
            'matric_number' => 'required',
            'program_id'=> 'required'
        ]);
        if ($validator->fails()) {
            return apiFailure($validator->errors(),[],1);
        }

        $student = new Student;

        $imageData = $request['photo'];
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        $this->filepath = storage_path('app/public/students/').$fileName;
        Image::make($imageData)->save($this->filepath);
        $data['name'] = $request->name;
        $data['photo'] = $this->filepath;
        $data['matric_number'] = $request->matric_number;
        $data['program_id'] = $request->program_id;
        $data['level'] = $request->level;

        try {
            $student->create($data);
            return apiSuccess('Registration successful',[]);
        }catch(Exception $e){
            return apiFailure($e->getMessage(),[],1);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
