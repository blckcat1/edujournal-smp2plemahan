<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karya extends Model
{
    protected $fillable = [
        'title',
        'category',
        'author',
        'class',
        'likes',
        'excerpt',
        'content',
        'pdf_path',
    ];
}
