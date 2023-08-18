<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignGradeTeacher extends Model
{
    use HasFactory;

    protected $table =  "assign_grade_teachers";

    protected $fillable = [
        "centerId",
        "teacherId",
        "userId",
        "status",
        "sdnumber",
    ];
}
