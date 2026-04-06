<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Student;
use App\Models\Programme;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Jobs\ProcessStudentImport;

class StudentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('students.index', compact('departments'));
    }

    public function data()
    {
        $students = Student::with(['department', 'programme']);

        return DataTables::of($students)

            ->addColumn('department', function ($row) {
                return $row->department->name;
            })

            ->addColumn('programme', function ($row) {
                return $row->programme->name;
            })

            ->addColumn('action', function ($row) {
                return '<button class="editBtn btn btn-sm btn-primary" data-id="' . $row->id . '">Edit</button>';
            })
            ->rawColumns(['action'])

            ->make(true);
    }

    public function getProgrammes($department_id)
    {
        return Programme::where('department_id', $department_id)->get();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'department_id' => 'required',
            'programme_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Student::create($request->all());

        return response()->json([
            'success' => 'Student created successfully'
        ]);
    }

    public function edit($id)
    {
        return Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'department_id' => 'required',
            'programme_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $student = Student::find($id);

        $student->update($request->all());

        return response()->json([
            'success' => 'Student updated successfully'
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');

        $path = $file->store('imports');

        ProcessStudentImport::dispatch($path);

        return response()->json([
            'success' => 'Excel import started. Data will be processed in background.'
        ]);
    }
}
