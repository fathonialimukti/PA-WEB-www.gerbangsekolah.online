<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Assignment;
use App\Models\AssignmentFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;

class TeacherAPIController extends Controller
{
    private $response;
    public function updateVirtualClassroom(Request $request)
    {
        $class = Grade::findOrFail($request->id);

        $class->update([
            'virtual_classroom' => $request->virtual_classroom
        ]);
        $this->response['message']  = 'success';
        return response()->json($this->response,200);
    }

    public function getAssignment()
    {
        $this->response = auth()->user()->teacher->assignments;
        return response()->json($this->response,200);
    }

    public function createAssignment(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255|unique:assignments,title',
        ]);

        $grade = Grade::findOrFail($request->gradeId);

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

        $this->response['message']  = 'success';
        return response()->json($this->response,200);
    }

    public function deleteAssignment(Request $request)
    {
        $assignment = Assignment::findOrFail($request->id);
        foreach($assignment->files as $AssignmentFile)
        {
            File::delete('assignment/'.$AssignmentFile->file);
            $AssignmentFile->delete();
        }
        $assignment->delete();

        $this->response['message']  = 'success';

        return response()->json($this->response,200);
    }

    public function getAssignmentFile($id)
    {
        $assignment = Assignment::findOrFail($id);

        $collection = new Collection([]);
        foreach ($assignment->files as $item) {
            $temp   =   $item;
            $temp['student_name'] = $item->student->user->name;
            $collection->push($temp);
        }

        $this->response = $collection;
        return response()->json($this->response,200);
    }
}
