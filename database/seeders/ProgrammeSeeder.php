<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Programme;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Programme::insert([
            ['name' => 'BSc Computer Science', 'department_id' => 1],
            ['name' => 'MSc Computer Science', 'department_id' => 1],
            ['name' => 'BE Mechanical', 'department_id' => 2],
            ['name' => 'BE Civil', 'department_id' => 3],
        ]);
    }
}
