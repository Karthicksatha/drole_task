<?php

namespace App\Jobs;

use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProcessStudentImport implements ShouldQueue
{
    use Queueable;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {

        $import = new StudentsImport();

        Excel::import($import, Storage::path($this->filePath));

        if (!empty($import->errors)) {
            \Log::error('Excel Import Errors', $import->errors);
        }
    }
}
