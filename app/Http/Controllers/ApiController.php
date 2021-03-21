<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class ApiController extends Controller
{
    public function teacher(){
        return response()->json(Teacher::all(),200);
    }
}
