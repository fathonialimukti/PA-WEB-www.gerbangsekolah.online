<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Assignment;
use App\Models\Assignment_file;
use App\Models\Student;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $teacher = Teacher::findOrFail(auth()->user()->teacher->id);
        return view('teacher.assignment.index',compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $grade = Grade::findOrFail($id);

        return view('teacher.assignment.create', compact('grade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'title'         => 'required|string|max:255|unique:assignments,title',
            'description'   => 'nullable|string|max:255',
        ]);

        $grade = Grade::findOrFail($id);

        $assignment = Assignment::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'teacher_id'    => auth()->user()->teacher->id,
            'grade_id'      => $grade->id,
        ]);

        foreach($grade->students as $student){
            Assignment_file::create([
                'assignment_id' => $assignment->id,
                'student_id'    => $student->id,
            ]);
        }

        return redirect()->route('assignment-manager.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('teacher.assignment.edit', compact());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('teacher.assignment.show', compact('assignment'));
    }

    public function update_virtual_classroom(Request $request, $id)
    {
        $request->validate([
            'virtual_classroom' => 'required|string|max:2083'
        ]);

        $class = Grade::findOrFail($id);

        $class->update([
            'virtual_classroom' => $request->virtual_classroom
        ]);

        return redirect()->route('assignment-manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        foreach($assignment->files as $assignment_file)
        {
            File::delete('assignment/'.$assignment_file->file);
            $assignment_file->delete();
        }
        $assignment->delete();

        return back()->with('success','Assignment deleted successfully');
    }


    // Student

    public function student()
    {
        $student = Student::findOrFail(auth()->user()->student->id);
        return view('student.assignment.index',compact('student'));
    }

    public function submit($id)
    {
        $assignment_file = Assignment_file::findOrFail($id);
        return view('student.assignment.submit', compact('assignment_file'));
    }

    public function store_assignment(Request $request, $assignment_id, $assignment_title)
    {
        $request->validate([
            'note'      => 'nullable|string|max:255',
            'file'      => 'required|max:10000'//max 10Mb add mimes:doc,docx for extension type
        ]);

        $assignment_file = Assignment_file::where([['assignment_id',$assignment_id],['student_id',auth()->user()->student->id]]);
        $file           = auth()->user()->name.'-'.$assignment_title.'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('assignment'), $file);

        $assignment_file->update([
            'note'      => $request->note,
            'file'      => $file
        ]);

        return redirect()->route('assignment.student');
    }

    public function download_file($file)
    {
        return response()->download(public_path('assignment/'.$file));
    }

    public function score($id, Request $request)
    {

        $request->validate([
            'score' => 'required|numeric|max:100'
        ]);
        Assignment_file::findOrFail($id)->update([
            'score' => $request->score
        ]);
        return redirect()->back();
    }
}
