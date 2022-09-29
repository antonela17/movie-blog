@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus pattern="([A-Z])[a-z]+"
                                       title="Name must start with only one uppercase, shouldn't contain numbers and should have at least 4 characters"
                                       minlength="4" maxlength="50"
                                       placeholder="Ema" required="">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" autocomplete="name" autofocus pattern="([A-Z])[a-z]+"
                                       title="Surname must start with only one uppercase, shouldn't contain numbers and should have at least 4 characters"
                                       minlength="4" maxlength="50"
                                       placeholder="Smith" required="">

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus placeholder="esmith"
                                       pattern="^[A-Za-z0-9_-]*$+"
                                       title="Name must start with only one uppercase and should have at least 4 characters"
                                       minlength="4" maxlength="50">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{--                        <div class="row mb-3">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role(choose):</label>--}}

{{--                                <select class="form-control" name="role" id="role">--}}
{{--                                    <option value="" selected disabled> Plase select :</option>--}}
{{--                                    <option value="1">Admin</option>--}}
{{--                                    <option value="2">Mesues</option>--}}
{{--                                    <option value="3">Student</option>--}}
{{--                                </select>--}}
{{--                                <input id="roleId" type="number" class="form-control @error('roleId') is-invalid @enderror" name="roleId" value="{{ old('roleId') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('roleId')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email"   pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Email must contain letters, one @ and at least one ."
                                       placeholder="email@example.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="******************"
                                       pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$"
                                       title="Password must contain one uppercase, one lowercase, one number, one special character and have at least 8 characters"required="">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
                                       id="password-confirm" placeholder="******************">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
