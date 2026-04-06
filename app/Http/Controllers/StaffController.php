<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Staff;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('staff.index', compact('departments'));
    }

    public function data()
    {

        $staff = Staff::with('department');

        return DataTables::of($staff)

            ->addColumn('department', function ($row) {

                return $row->department->name;
            })

            ->make(true);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',

            'email' => 'required|email',

            'department_id' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Staff::create($request->all());

        return response()->json([
            'success' => 'Staff created successfully'
        ]);
    }
}
