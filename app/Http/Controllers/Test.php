<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');
        $data = Student::with(['major']);

        // if ($search) {
        //     $data->where('name', 'like', "%$search%")
        //         ->orWhere('address', 'like', "%$search%")
        //         ->where('majors_id', '=', "$filter");
        // }

        if ($search) {
            $data->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%");
            });
        }

        if ($filter) {
            $data->where(function ($query) use ($filter) {
                $query->where('major_id', '=', $filter);
            });
        }

        $data = $data->paginate(10);
        return view('pages.student.list', compact('data'), [
            'judul' => "List Student",
            'majors' => Major::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = new Student();
        $majors = Major::all();

        return view('pages.student.form', [
            'student' => $student,
            'judul' => "Create Form Student",
            'majors' => $majors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        // dd($request->all());
        $data = $request->all();
        Student::create($data);
        return redirect()->route('student.index')->with('notif', 'Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $majors = Major::all();

        return view('pages.student.form', [
            'student' => $student,
            'judul' => "Edit Form Student",
            'majors' => $majors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->all();
        $student->update($data);

        return redirect()->route('student.index')->with('notif', 'Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('student.index')->with('notif', 'Data Berhasil di Delete');
    }
}
