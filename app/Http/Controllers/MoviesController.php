<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function showEditPage($id) {
        $movie = Movie::query()->where('id',$id)->firstOrFail()->toArray();
        $categories = Categories::all()->toArray();

        return view('movie.edit')->with(compact('movie','categories'));
    }

    public function edit(Request $request,$id) {
        $movie = Movie::query()->where('id', $id)->firstOrFail();

//        $request->validate([
//            'title' => 'string|unique:movies|max:255',
//            'image'=>'string|max:255',
//            'content' => 'string|max:14900',
//            'video' => 'string|max:14900',
//        ]);

        try {
            $slug = Str::slug($movie->title);
            $video = $request->video;
            if (Storage::disk('local')->has('/public/movies/'.$video) && ($request->roleId > 0 || $request->roleId < 7)) {
                $movie->update([
                    'title' => $request->title,
                    'image' => $request->image,
                    'video' => $video,
                    'content' => $request->contentText,
                    'slug' => $slug,
                    "categoryId" => $request->category
                ]);
            }

            else
                return redirect()->back()->with("error","Data is not correct!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->input())
                ->with('error', 'An error occurred while processing your data. Please try again later!');
        }

        return redirect()->back()->with('success', 'Your database was updated successfully!');
    }

    public function destroy(Movie $movie,$id) {
        $movie = $movie::findOrFail($id);
        try {
            $movie->delete();

        }  catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while processing your data. Please try again later!');
        }

        return redirect()->back()->with("success","Movie deleted");
    }
    public function createMovie(Request $request) {
        $title = $request->title;
        $image = $request->image;
        $categoryId = $request->category;
        $content = $request->contentText;
        $slug = Str::slug($request->title);

        try {
            $movie = new Movie();
            $movie['title'] = $title;
            $movie['image'] = $image;
            $movie['slug'] = $slug;
            $movie['categoryId'] = $categoryId;
            $movie['content'] = $content;

            $movie->save();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while processing your data. Please try again later!');
        }
        return back()->with('success', 'Course Successfully Added');
    }

    public function showCreateMovie() {
        $categories = Categories::all()->toArray();

        return view('movie.create')->with(compact('categories'));
    }
}


