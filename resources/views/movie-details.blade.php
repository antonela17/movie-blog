@extends('layouts.layout')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs d-flex align-items-center"
             style="background: midnightblue">
            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">


                <h2>Movie Details</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="/home/movies">Movies Blog</a> </li>
                    <li>Movie Details</li>
                </ol>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Details Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-5">

                    <div class="col-lg-8">

                        <article class="blog-details">

                            <div class="post-img">
                                <img src={{$content['image']}} alt="" class="img-fluid" >
                            </div>

                            <h2 class="title">{{$content['title']}}</h2>

                            {{--                            <div class="meta-top">--}}
                            {{--                                <ul>--}}
                            {{--                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a--}}
                            {{--                                            href="blog-details.html">John Doe</a></li>--}}
                            {{--                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a--}}
                            {{--                                            href="blog-details.html">--}}
                            {{--                                            <time datetime="2020-01-01">Jan 1, 2022</time>--}}
                            {{--                                        </a></li>--}}
                            {{--                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a--}}
                            {{--                                            href="blog-details.html">12 Comments</a></li>--}}
                            {{--                                </ul>--}}
                            {{--                            </div><!-- End meta top -->--}}

                            <div class="content">
                                <p>
                                    {{$content['content']}}
                                </p>
                            </div><!-- End post content -->

                            <div class="meta-bottom">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="#">Business</a></li>
                                </ul>

                                <i class="bi bi-tags"></i>
                                <ul class="tags">
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Tips</a></li>
                                    <li><a href="#">Marketing</a></li>
                                </ul>
                            </div><!-- End meta bottom -->

                        </article><!-- End blog post -->


                        <div class="comments">

                            <h4 class="comments-count">{{sizeof($comments)}} Comments</h4>
                            <div class="my-3">
                                @if(session()->has('error'))
                                    <div class="error-message">{{ session('error') }}</div>
                                @endif
                                @if(session()->has('success'))
                                    <div class="sent-message">{{session('success')}}</div>
                                @endif
                            </div>

                        @foreach($comments as $comment)

                                <div id="comment-1" class="comment">
                                    <div class="d-flex">
                                        <div class="comment-img"><img
                                                src="{{\Illuminate\Support\Facades\Storage::url('usersProfilePicture/'.$comment['profile_picture'])}}"
                                                alt=""></div>
                                        <div>
                                            <h5>{{$comment['name']}}  {{$comment['surname']}}
                                            </h5>
                                            <time datetime="{{$comment['date']}}">{{$comment['date']}}</time>
                                            <p>
                                                {{$comment['comment']}}
                                            </p>
                                        </div>
                                    </div>

                                    @if(Auth::user()->roleId == 1 || Auth::user()->id == $comment['userId'])

                                    <form action="{{route('comment.delete', $comment['id'])}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Sure Want Delete?')">Delete
                                        </button>
                                    </form>
                                    <br>
                                    @endif
                                </div><!-- End comment #1 -->

                            @endforeach


                            <div class="reply-form">

                                <h4>Leave a Comment</h4>
                                <form action="{{route('comment.add',$content['id'])}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col form-group">
                                        <textarea name="comment" class="form-control"
                                                  placeholder="Your Comment*" minlength="5"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>

                                </form>

                            </div>

                        </div><!-- End blog comments -->

                    </div>


                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="sidebar-item categories">
                                <h3 class="sidebar-title">Categories</h3>
                                <ul class="mt-3">
                                    @foreach($categories as $category)
                                        <li><a href='/home/movies/{{$category['slug']}}'>{{$category['category']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar categories-->

                            <div class="sidebar-item recent-posts">
                                <h3 class="sidebar-title">Recent Posts</h3>

                                <div class="mt-3">

                                    @foreach($allMovies as $movie)

                                        <div class="post-item mt-3">
                                            <img src={{$movie['image']}} alt="">
                                            <div>
                                                <h4><a href={{$movie['slug']}}>{{$movie['title']}}</a></h4>
                                            </div>
                                        </div><!-- End recent post item-->

                                    @endforeach


                                </div>

                            </div><!-- End sidebar recent posts-->
                            @if(\Illuminate\Support\Facades\Storage::url('/movies/'.$content['video']))
                                <div class="sidebar-item tags">
                                    <h3 class="sidebar-title">Trailer</h3>
                                    <video height="300px" width="350px" controls>
                                        <source
                                            src="{{\Illuminate\Support\Facades\Storage::url('movies/'.$content['video'])}}"
                                            type="video/mp4"/>
                                    </video>
                                </div><!-- End sidebar tags-->
                            @endif
                        </div><!-- End Blog Sidebar -->

                    </div>
                </div>
            </div>
        </section><!-- End Blog Details Section -->
    </main>
@endsection
