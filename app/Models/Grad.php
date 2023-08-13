<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grad extends Model
{
    use HasFactory;

    protected $fillable = [
        'grad',
        'lownumber',
        'upnumber',
        'lcstatus',
    ];
}
