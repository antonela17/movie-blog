@extends('layouts.layout')

@section('content')
    <div class="breadcrumbs d-flex align-items-center"
         style="background-image: url({{asset('assets/img/breadcrumbs-bg.jpg')}});">
        <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

            <h2>Add a New Movie</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li><a href="/home/movies">Movie</a></li>
                <li>Create Movie</li>
            </ol>

        </div>
    </div>
    <section id="get-started" class="get-started section-bgr">
        <div class="container">
            @if(session()->has('success'))
                <div class="sent-message">{{session('success')}}</div>
            @endif

            <div class="col-lg-5 d-flex align-items-center" >
                <form action="{{route('movie.create')}}" method="POST">
                    @csrf
                    <h3>Add a New Movie!</h3>
                    <div class="row gy-3">

                        <div class="col-md-12">
                            <label>Title: </label> <input type="text" name="title" class="form-control" placeholder="title" required>
                        </div>

                        <div class="col-md-12">
                            <label>Image Url: </label> <input type="text" name="image" class="form-control" placeholder="Imager Url" required>
                        </div>

                        <div class="col-md-12">
                            <label>Category: </label>  <input type="number" name="category" class="form-control" value="" required>
                        </div>

                        <div class="col-md-12">
                            <label>Content: </label> <textarea class="form-control" name="contentText" rows="6" value=""
                                      required></textarea>
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
