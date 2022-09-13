<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');
        if ($search) {
            $movies = Movie::query()->select([
                'movies.title',
                'movies.image',
                'movies.slug',
                'movies.content',
                'movies.categoryId',
                'categories.category',
                'categories.slug as category_slug'
            ]) ->join('categories', 'categories.id', '=', 'movies.categoryId')
                ->orderBy('movies.id')
                ->where('title', 'LIKE', "%{$search}%")
                ->paginate(6);


            if ($movies) {
                $categories = Categories::all()->toArray();
                return view('movies')->with(compact('movies', 'categories',));
            } else return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
