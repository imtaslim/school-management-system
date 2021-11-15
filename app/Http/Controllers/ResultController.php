<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Http\Requests\ResultRequest;
use App\Models\StudentClass;
use PDF;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $data['results'] = Result::with("students")
        ->groupBy('student_id')
        ->selectRaw('sum(marks) as sum, student_id')
        ->orderByRaw('SUM(marks) DESC')
        ->get();
    $data['classes'] = StudentClass::all();

        return view('result.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['students'] = Student::pluck('name', 'id');
        $data['results'] = Subject::pluck('subjects', 'id');
        $data['classes'] = StudentClass::pluck('name', 'id');

        return view('result.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Request\ResultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultRequest $request)
    {
        // dd($request->all());
        $subject = Result::where('student_id', $request->student_id)
                    ->where('subject_id', $request->subject_id)
                    ->first();

        if($subject) {
            return redirect()->back()->withInput()->with("ERROR", __("Subject already exist"));
        }
        
        for ($i = 0; $i < count($request->subject_id); $i++) {
        $data = Result::create([
            'class_id' => $request->student_id,
            'subject_id' => $request->subject_id[$i],
            'marks' => $request->marks[$i],
            'student_id' => $request->student_id,
        ]);
        // dd($data);
    }
        if(empty($data)) {
            return redirect()->back()->withInput()->with("ERROR", __("Failed to Input"));
        }
        return redirect()->route('results.index')->with("SUCCESS", __("Form has been submitted successfully"));
    }

    
    public function classresult($id)
    {
        $results = Result::with("students")
            ->where('class_id', $id)
            ->groupBy('student_id')
            ->selectRaw('sum(marks) as sum, student_id')
            ->orderByRaw('SUM(marks) DESC')
            ->get();

        return response()->json($results);
    }

    public function getClassId($id) {

        $studentClass = Student::where('class_id', $id)->pluck('name','id');
        // dd($studentClass);

        // return json_encode($studentClass);
        return response()->json($studentClass);
    }

    public function pdfview($id)
    {
        $data['results'] = Result::where('student_id', $id)->get();
        $data['students'] = Student::where('id', $id)->first();

        $pdf = PDF::loadView('result.export', $data);
        return $pdf->download('result.pdf');

        return view('result.export', $data);
    }
}
