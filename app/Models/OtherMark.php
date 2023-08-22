<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherMark extends Model
{
    use HasFactory;

    protected $table = "othermarks";

    protected $fillable = [
        "stid",
        "course",
        "gradeid",
        "marks",
        "term",
        "status",
        "userid",
    ];
}
