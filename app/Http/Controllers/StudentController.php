<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\File;
use App\Models\Major;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search =$request->input('search');
        $majors = Major::get();
        $filter = $request->input('filter');
        $data = Student::with(['major']);
        // if ($search){
        //     //select * from student where name like '%$seacrh%'
        //     $data->where('name', 'like', "%$search%")
        //     ->orWhere('address', 'like', "%$search%")
        //     ->where('majors_id', '=', "$filter");
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
        $data =$data->paginate(15);
        return view('pages.student.list',compact('data'),compact('majors'),[
            'judul'=> "list Student"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student =new Student();
        $majors = Major::get();
        return view('pages.student.form', [
            'student' => $student,
            'majors' => $majors,
            'judul' =>"Create Form Student"
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
        $data =$request->all();
        $image = $request->file('image');
        if ($image){
            $data['image']= $image->store('image/student', 'public');
        }
        Student::create($data);
        return redirect()->route('student.index')->with('notif', 'berhasil diinsert');;

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
        $majors = Major::get();
        return view('pages.student.form', [
            'student' => $student,
            'majors' => $majors,
            'judul' =>"Edit Form Student"]);
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
        $image = $request->file('image');
        // CEK APAKAH USER MENGUPLOAD FILE
        if ($image) {
            // cek apakah file lama ada didalam folder?
            $exists = File::exists(storage_path('app/public/').$student->image);
            if ($exists) {
                // delete file lama tersebut
                File::delete(storage_path('app/public/').$student->image);
            }
            // upload file baru
            $data['image'] = $image->store('images/student', 'public');
        }
        $student ->update($data);
        return redirect()->route('student.index')->with('notif', 'berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $exists = File::exists(storage_path('app/public/').$student->image);
        if ($exists) {
            // delete file lama tersebut
            File::delete(storage_path('app/public/').$student->image);
        }
        $student->delete();
        return redirect()->route('student.index')->with('notif', 'berhasil di delete');
    }
}
