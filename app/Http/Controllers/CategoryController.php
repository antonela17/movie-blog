<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;

class CategoryController
{
    public function show($slug)
    {
        $content = Categories::where('slug', $slug)->get()->toArray();
        if ($content) {
            $content = $content[0];
            $categories = Movie::query()->select([
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

            return view('category')->with(compact('categories','slug'));
        }

        return abort(404);
    }
}
