<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaceRequest extends Model
{
    use HasFactory;

    protected $table = 'pecerequest';
    protected $fillable = [
        "tid",
        "stid",
        "paceid",
        "pacenumber",
        "status",
        "redate",
        "retime",
        "appdate",
        "apptime",
        "deldate",
        "deltime",
        "comment",
        "roracomment",
        "admin",
        "term",
        "gradeid",
        "setnumber",
        "rora",
        "marks",
        "year",
        "setstatus",
        "gradestatus",
        "courseid",
        "pacetype"
    ];
}
