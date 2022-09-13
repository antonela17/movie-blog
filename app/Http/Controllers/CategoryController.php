<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;
use Illuminate\Support\Str;

class CategoryController
{
    public function show($slug)
    {
        $content = Categories::where('slug', $slug)->get()->toArray();
        if ($content) {
            $content = $content[0];
            $movies = Movie::query()->select([
                'movies.title',
                'movies.image',
                'movies.slug',
                'movies.categoryId',
                'movies.content',
                'categories.category',
                'categories.slug as category_slug'
            ])
                ->join('categories', 'categories.id', '=', 'movies.categoryId')
                ->where('categories.slug','=',$slug)
                ->orderBy('movies.id')
                ->paginate(6);

            $categories = Categories::all()->toArray();
            $title = Str::title($slug);

            return view('category')->with(compact('movies','title', 'categories'));
        }

        return abort(404);
    }
}
