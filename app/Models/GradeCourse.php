<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeCourse extends Model
{
    use HasFactory;

    protected $table = "gradecourse";
    protected $fillable = [
        'gid','cid'
    ];
}
