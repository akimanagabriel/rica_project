<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionSet extends Model
{
    use HasFactory;

    protected $table = "promotionset";

    protected $fillable = [
        "stid",
        "setnumber",
        "grade",
        "year",
        "cdate",
        "ctime",
        "status",
        "tid",
    ];
}
