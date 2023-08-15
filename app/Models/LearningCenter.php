<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningCenter extends Model
{
    use HasFactory;

    protected $table = "leaningcenter";
    protected $fillable = [
        'cid', 
        'graid', 
        'cdate'
    ];
}
