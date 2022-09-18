<?php

namespace App\Http\Controllers;


use App\Models\Categories;
use App\Models\Content;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class readDataFromJson
{
    public function readData(Request $request)
    {
        $string = file_get_contents("C:\Users\Ela\Downloads\MovieBlogJson.json");
        $json_file = json_decode($string, true);

        $content = new Content();


        foreach ($json_file as $data) {
            $title = $data['title'][0];
            $paragraf = $data['data'];
            $allContent = "";
            foreach ($paragraf as $p) {
                $allContent = $allContent . $p;
            }
//            $image = $data['img'];
            $movie = new Movie();
//            $number = rand(1,6);
            $titleFormated = str_replace(' | Review', '', $title);
            $slug = Str::slug($titleFormated);
            $element = Movie::query()->where('title', $title)->update(['slug' => $slug]);
//            if ($element) {
//                $paragraf = $data['data'];
            $i = 1;
//                foreach ($paragraf as $item){
//                    $movieId = $element[0]['id'];
//                    $content = new Content();
//                    $content->movieId = $movieId;
//                    $content->content = $item;
//                    $content->order = $i;
//                    $content->save();
//                    $i = $i + 1;
//                }
//
//            }
//            $movie->title = $title;
//            $movie->image = $image;
        }
    }

    public function test()
    {
        $movies = Movie::all();

        $videos = ['aBadMomsChristmas.mp4',
            "aDogsWayHome.mp4",
            "aFantasticWoman.mp4",
            "aNightmareOnElmStreet.mp4",
            "aPrayerBeforeDown.mp4",
            "aQuietPlace.mp4",
            "theHitmansBodyguard.mp4"];

        foreach ($movies as $movie){
            $number = rand(0,6);

            try {
              Movie::query()->where('id', $movie->id)->update(['video' => $videos[$number]]);
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'An error occurred while processing your data. Please try again later!');
            }
        }
    }

}
