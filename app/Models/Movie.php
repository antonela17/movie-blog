<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'movies';

    protected $fillable = ['id','title','image','slug','categoryId','content','video'];

}
