@extends('layouts.layout')
<style>
    body {
        background: rgb(99, 39, 120)
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }
</style>

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs d-flex align-items-center"
             style="background-image: url({{asset('assets/img/breadcrumbs-bg.jpg')}});">
            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">
                <h2>Profile</h2>
                <ol>
                    <li><a href="index">Home</a></li>
                    <li>Profile</li>
                </ol>

            </div>
        </div><!-- End Breadcrumbs -->

        <form action="{{route('profile.edit',Auth::user()->id)}}" method="POST"
              class="container rounded bg-white mt-5 mb-5" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                            class="rounded-circle mt-5" width="150px"
                            src="{{\Illuminate\Support\Facades\Storage::url('usersProfilePicture/'.Auth::user()->profile_picture)}}">
                        <span class="font-weight-bold">{{Auth::user()->name}}</span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><label class="labels">Name</label><input type="text"
                                                                                            name="name"
                                                                                            class="form-control"
                                                                                            value="{{Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Surname</label><input type="text"
                                                                                               name="surname"
                                                                                               class="form-control"
                                                                                               value="{{Auth::user()->surname}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Username</label><input type="text"
                                                                                                name="username"
                                                                                                class="form-control"
                                                                                                value="{{Auth::user()->username}}"
                                ></div>
                            <div class="col-md-12"><label class="labels">Email</label><input type="text"
                                                                                             name="email"
                                                                                             class="form-control"
                                                                                             value="{{Auth::user()->email}}"
                                                                                             value=""></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Edit Profile Picture</span></div>
                        <br>
                        <div class="col-md-12"><input type="file" name="profile_picture" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                </div>
            </div>
        </form>
    </main>
@endsection
