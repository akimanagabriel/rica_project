<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'regnumber', 
        'dob', 
        'name', 
        'fname', 
        'fphone', 
        'ophone',
        'mname', 
        'gender', 
        'address',
        'status', 
        'userid', 
        'cdate',
        'province', 
        'district', 
        'sector',
        'cell', 
        'village', 
        'comment',
        'grade', 
        'year', 
        'photo'
    ];
}
