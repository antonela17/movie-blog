@extends('layouts.layout')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs d-flex align-items-center"
             style="background-image: url({{asset('assets/img/breadcrumbs-bg.jpg')}});">
            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>{{$title}}</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>{{$title}}</li>
                </ol>

        </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 posts-list">


                    @foreach($movies as $movie)
                        <div class="col-xl-4 col-md-6">
                            <div class="post-item position-relative h-100">

                                <div class="post-img position-relative overflow-hidden">
                                    <img src={{$movie['image']}}  alt="" width="600" height="300">
                                </div>

                                <div class="post-content d-flex flex-column">

                                    <h3 class="post-title">{{$movie['title']}}</h3>

                                    <div class="meta d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-folder2"></i> <span
                                                class="ps-2">{{$movie['category']}}</span>
                                        </div>
                                    </div>

                                    <p>
                                        {{substr($movie['content'],0,150).'...'}}
                                    </p>
                                    <a href='/home/{{$movie['slug']}}'
                                       class="readmore stretched-link"><span>Read More</span><i
                                            class="bi bi-arrow-right"></i></a>

                                </div>

                            </div>
                        </div><!-- End post list item -->
                    @endforeach

                    {!! $movies->links() !!}

                </div><!-- End blog posts list -->


                {{--            <div class="blog-pagination">--}}
                {{--                <ul class="justify-content-center">--}}
                {{--                    <li><a href="#">1</a></li>--}}
                {{--                    <li class="active"><a href="#">2</a></li>--}}
                {{--                    <li><a href="#">3</a></li>--}}
                {{--                </ul>--}}
                {{--            </div><!-- End blog pagination -->--}}

            </div>
        </section><!-- End Blog Section -->
    </main>
@endsection
