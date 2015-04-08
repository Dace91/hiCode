<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;
use Illuminate\Http\Request;

use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $students = Student::paginate(5);

        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest $request
     * @return Response
     * @internal param $StudentRequest
     *
     */
    public function store(StudentRequest $request)
    {
       // dd($request->all());
        Student::create($request->all());

        return redirect()->to('student')->with('message', 'ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $student = Student::find($id);

        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(StudentRequest $request, $id)
    {

        Student::find($id)->update($request->all());

        return redirect()->to('student')->with('message', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $id = (int)$id;
        Student::destroy($id);

        return redirect()->to('student')->with('message', 'delete ok');
    }

}
