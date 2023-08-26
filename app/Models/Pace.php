<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pace extends Model
{
    use HasFactory;
    protected $table = 'pace';
    protected $fillable = [
        'code',
        'course',
        'pacenumber',
        'term',
        'grad',
        'qte',
        'userid',
        'purchase',
        'lica',
    ];
}
