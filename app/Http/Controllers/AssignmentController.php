<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Assignment;
use App\Models\AssignmentFile;
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
            AssignmentFile::create([
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        foreach($assignment->files as $AssignmentFile)
        {
            File::delete('assignment/'.$AssignmentFile->file);
            $AssignmentFile->delete();
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
        $AssignmentFile = AssignmentFile::findOrFail($id);
        return view('student.assignment.submit', compact('AssignmentFile'));
    }

    public function submitAssignment(Request $request, $id)
    {
        $request->validate([
            'note'      => 'nullable|string|max:255',
            'file'      => 'required|max:10000|mimes:pdf'//max 10Mb add mimes:doc,docx for extension type and must be pdf
        ]);

        $AssignmentFile = AssignmentFile::where([['assignment_id',$id],['student_id',auth()->user()->student->id]])->firstOrFail();
        File::delete('assignment/'.$AssignmentFile->file);
        $file           = auth()->user()->name.'-'.Assignment::findOrFail($id)->title.'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('assignment'), $file);

        $AssignmentFile->update([
            'note'      => $request->note,
            'file'      => $file
        ]);

        return redirect()->route('assignment.student');
    }

    public function downloadFile($file)
    {
        return response()->download(public_path('assignment/'.$file));
    }

    public function score($id, Request $request)
    {
        $request->validate([
            'score' => 'required|numeric|max:100'
        ]);
        AssignmentFile::findOrFail($id)->update([
            'score' => $request->score
        ]);
        return redirect()->back();
    }
}
