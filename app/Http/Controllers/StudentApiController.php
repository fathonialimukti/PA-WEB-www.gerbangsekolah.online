<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Assignment;
use App\Models\AssignmentFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;

class StudentApiController extends Controller
{
    private $response;
    public function getTeachers()
    {
        $collection = new Collection([]);
        foreach (auth()->user()->student->grade->teachers as $teacher)
        {
            $temp['id'] = $teacher->id;
            $temp['name'] = $teacher->user->name;
            $temp['email'] = $teacher->user->email;
            $temp['profile_picture'] = $teacher->user->profile_picture;
            $collection->push($temp);
        }

        $this->response = $collection;

        return response()->json($this->response,200);
    }

    public function getAssignment()
    {
        $this->response = auth()->user()->student->grade->assignments;
        return response()->json($this->response,200);
    }

    public function getAssignmentFiles()
    {
        $collection = new Collection([]);
        foreach (auth()->user()->student->assignment as $AssignmentFile)
        {
            $temp['id'] = $AssignmentFile->id;
            $temp['student_name'] = $AssignmentFile->student->user->name;
            $temp['score'] = $AssignmentFile->score;
            $temp['note'] = $AssignmentFile->note;
            $temp['file'] = $AssignmentFile->file;
            $temp['assignment_id'] = $AssignmentFile->assignment->id;
            $collection->push($temp);
        }

        $this->response = $collection;

        return response()->json($this->response,200);
    }

    public function submitAssignment(Request $request)
    {
        $request->validate([
            'assignmentId' => 'required|int',
            'note'          => 'nullable|string|max:255',
            'file'          => 'required|max:10000|mimes:pdf' //max 10Mb add mimes:doc,docx for extension type and must be pdf
        ]);

        $AssignmentFile = AssignmentFile::where([['assignment_id', $request->assignmentId], ['student_id', auth()->user()->student->id]])->firstOrFail();
        File::delete('assignment/' . $AssignmentFile->file);

        $filename       = auth()->user()->name . '-' . Assignment::findOrFail($request->assignmentId)->title . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('assignment'), $filename);

        $AssignmentFile->update([
            'note'      => $request->note,
            'file'      => $filename
        ]);

        return response()->json('success',200);
    }
}
