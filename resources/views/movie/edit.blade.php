@extends('layouts.layout')

@section('content')
    <div class="breadcrumbs d-flex align-items-center"
         style="background: midnightblue">
        <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

            <h2>Edit Page</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li><a href="/home/movies">Movie</a></li>
                <li>Edit</li>
            </ol>

        </div>
    </div>
    <section id="get-started" class="get-started section-bgr">
        <div class="container">
            @if(session()->has('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif
            @if(session()->has('success'))
                <div class="sent-message">{{session('success')}}</div>
            @endif
            <div class="col-lg-5 d-flex align-items-center" >
                <form action="{{route('movie.edit',$movie['id'])}}" method="POST">
                    @csrf
                    <h3>Edit movie "{{$movie['title']}}"</h3>
                    <div class="row gy-3">

                        <div class="col-md-12">
                            <input type="text" name="title" class="form-control" value="{{$movie['title']}}" minlength="2">
                        </div>

                        <div class="col-md-12">
                            <input type="text" name="image" class="form-control" value="{{$movie['image']}}" minlength="10">
                        </div>

                        <div class="col-md-12">
                            <input type="text" name="video" class="form-control" value="{{$movie['video']}}">
                        </div>

                        <div class="col-md-12">
                            <input type="number" name="category" class="form-control" value="{{$movie['categoryId']}}" min="1" max="6" >
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="contentText" rows="6" value="{{$movie['content']}}" minlength="100" maxlength="14900">{{$movie['content']}}</textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Edit Movie</button>
                        </div>

                    </div>
                </form>
            </div><!-- End Quote Form -->
        </div>
    </section>
@endsection
