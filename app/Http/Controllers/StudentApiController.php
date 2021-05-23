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
}
