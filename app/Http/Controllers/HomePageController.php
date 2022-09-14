<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;
use Illuminate\Support\Str;

class HomePageController
{
    public function show()
    {
        $categories = Categories::all()->toArray();

        return view('index')->with(compact('categories'));
    }
}
