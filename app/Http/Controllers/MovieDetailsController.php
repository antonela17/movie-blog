<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieDetailsController
{
    public function show($slug)
    {
        $content = Movie::where('slug', $slug)->get()->toArray();
        if ($content) {
            $content = $content[0];
            $categories = Categories::all()->toArray();
            $allMovies = Movie::query()->where('id','!=',$content['id'])->get()->random(5);

            return view('movie-details')->with(compact('content','categories','allMovies'));
        }

        return abort(404);
    }

}
