<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = 'Cari';
        $classes = Grade::withCount('students')->orderBy('class_name', 'asc')->paginate(20);

        return view('admin.classes.index', compact('classes', 'search'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $classes = Grade::withCount('students')->orderBy('class_name', 'asc')->where('class_name', 'LIKE', '%'.$search.'%')->paginate(10);
        return view('admin.classes.index', compact('classes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::latest()->get();
        return view('admin.classes.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name'        => 'required|string|max:255|unique:grades',
            'class_description' => 'nullable|string|max:255',
            'virtual_classroom' => 'nullable|string|max:2083'
        ]);

        Grade::create([
            'class_name'        => $request->class_name,
            'class_description' => $request->class_description,
            'virtual_classroom' => $request->virtual_classroom
        ])->teachers()->attach($request->selectedteachers);

        Alert::toast('Berhasil menambahkan '.$request->class_name,'success');
        return redirect()->route('grade.index');
    }

    public function show(Grade $grade)
    {
        return view('admin.classes.show',compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = Teacher::latest()->get();
        $grade = Grade::findOrFail($id);

        return view('admin.classes.edit', compact('grade','teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name'        => 'required|string|max:255|unique:grades,class_name,'.$id,
            'class_description' => 'nullable|string|max:255',
            'virtual_classroom' => 'nullable|string|max:2083'
        ]);

        $class = Grade::findOrFail($id);

        $class->update([
            'class_name'        => $request->class_name,
            'class_description' => $request->class_description,
            'virtual_classroom' => $request->virtual_classroom
        ]);

        $class->teachers()->sync($request->selectedteachers);

        Alert::toast('Perubahan terhadap '.$class->class_name.' berhasil','success');
        return redirect()->route('grade.index');
    }

    public function updateVirtualClassroom(Request $request, $id)
    {
        $request->validate([
            'virtual_classroom' => 'required|string|max:2083'
        ]);
        $class = Grade::findOrFail($id);

        $class->update([
            'virtual_classroom' => $request->virtual_classroom
        ]);

        Alert::toast('Perubahan terhadap '.$class->class_name.' berhasil','success');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        Alert::toast($grade->class_name.' berhasil dihapus','success');
        $grade->delete();

        return back();
    }
}
