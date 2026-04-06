<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

class StudentsImport implements ToCollection
{

    public $errors = [];

    public function collection(Collection $rows)
    {

        foreach ($rows as $index => $row) {

            if ($index == 0) continue; 

            $data = [
                'name' => $row[0],
                'email' => $row[1],
                'department_id' => $row[2],
                'programme_id' => $row[3],
            ];

            $validator = Validator::make($data,[

                'name' => 'required',
                'email' => 'required|email',
                'department_id' => 'required|exists:departments,id',
                'programme_id' => 'required|exists:programmes,id'

            ]);

            if($validator->fails())
            {
                $this->errors[] = [
                    'row' => $index + 1,
                    'errors' => $validator->errors()->all()
                ];

                continue;
            }

            Student::create($data);
        }

    }

}