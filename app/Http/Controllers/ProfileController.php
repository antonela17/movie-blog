<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
    {
        $categories = Categories::all()->toArray();
        return view('profile.show')->with(compact('categories'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::query()->where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'surname'=>'required|strings|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|unique:users|max:255',
        ]);



        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'profile_picture' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $desination_path = 'public/usersProfilePicture';
            $image_name = $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->storeAs($desination_path, $image_name);
            try {
                $user->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'username' => $request->username,
                    'email' => $request->email,
                    "profile_picture" => $request->file('profile_picture')->getClientOriginalName()
                ]);

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->with('error', 'An error occurred while processing your data. Please try again later!');
            }
        }
        else {
            try {
                $user->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'username' => $request->username,
                    'email' => $request->email,
                ]);

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->with('error', 'An error occurred while processing your data. Please try again later!');
            }
        }


        return redirect()->back()->with('success', 'Your database was updated successfully!');
    }

}
