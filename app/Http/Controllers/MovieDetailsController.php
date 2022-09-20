<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieDetailsController
{
    public function show($slug)
    {
        $content = Movie::where('slug', $slug)->get()->toArray();
        if ($content) {
            $content = $content[0];
            $categories = Categories::all()->toArray();
            $allMovies = Movie::query()->where('id', '!=', $content['id'])->get()->random(5);

            $movieId = $content['id'];
            $comments = Comment::query()->select(['comments.id',
                'comments.userId',
                'comments.movieId',
                'comments.comment',
                'users.name',
                'users.surname'
            ])->join('users', 'users.id', '=', 'comments.userId')->where('movieId', '=', $movieId)->get()->toArray();

            return view('movie-details')->with(compact('content', 'categories', 'allMovies', 'comments'));
        } else
            return abort(404);
    }

    public function addComment(Request $request, $movieId)
    {
        $request->validate(['comment'=>'required|string|max:1000']);
        try {
            $comment = new Comment();
            $comment['comment'] = request()->comment;
            $comment['userId'] = Auth::user()->id;
            $comment['movieId'] = $movieId;


            $comment->save();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while processing your data. Please try again later!');
        }
        return back()->with('success', 'Course Successfully Added');
    }

}
