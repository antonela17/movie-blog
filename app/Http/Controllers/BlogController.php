<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;
use Illuminate\Http\Request;

class BlogController
{
    public function show()
    {
//    $movies = Movie::paginate(6);
//    $movies = $movies['data'];

        $movies = Movie::query()->select([
            'movies.title',
            'movies.image',
            'movies.slug',
            'movies.content',
            'movies.categoryId',
            'categories.category',
            'categories.slug as category_slug'
        ])
            ->join('categories', 'categories.id', '=', 'movies.categoryId')
            ->orderBy('movies.id')
            ->paginate(6);

        $categories = Categories::all()->toArray();


        return view('movies')->with(compact('movies','categories'));
    }
}
