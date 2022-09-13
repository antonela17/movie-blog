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


        return view('blog')->with(compact('movies','categories'));
    }

    public function search(Request $request) {
        // Get the search value from the request
        $search = $request->input('search');
        if ($search) {
            // Search in the title and body columns from the posts table
            $content = Movie::query()
                ->where('title', 'LIKE', "%{$search}%")
                ->get()->toArray();
            if ($content) {
                $content = $content[0];
                $categories = Categories::all()->toArray();
                $allMovies = Movie::query()->where('id','!=',$content['id'])->get()->random(5);

                return view('blog-details')->with(compact('content','categories','allMovies'));
            }
            else return redirect()->back();
        }

        else{
            return redirect()->back();
        }

    }
}
