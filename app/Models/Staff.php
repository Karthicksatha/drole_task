<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
     protected $fillable = [
        'name',
        'email',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
