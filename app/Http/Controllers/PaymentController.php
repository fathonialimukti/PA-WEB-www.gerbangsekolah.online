<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('accounting.index', compact('student'));
    }
}
