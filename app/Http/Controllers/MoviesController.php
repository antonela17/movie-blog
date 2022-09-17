<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController
{
    public function show()
    {
        $movies = Movie::query()->select([
            'movies.id',
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

    public function destroy(Movie $movie,$id) {
        $movie = $movie::findOrFail($id);
        $movie->delete();
        return redirect()->back()->with("success","Movie deleted");
    }
}
