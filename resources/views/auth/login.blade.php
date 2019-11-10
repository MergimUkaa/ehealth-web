@extends('layouts.app')

@section('content')
    <div class="login-page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="form-holder">
                        <div class="title-holder">
                            <img src="{{ asset('images/logos/company-logo') }}" alt="Logo" width="40">
                            <span>We are
                                <strong>
                                    <span>e</span>
                                    HEALTH
                                </strong>
                            </span>
                        </div>
                        <p class="subtitle">Please login to you account</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="label-item">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="label-item">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                             </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-element">
                                {{ __('Login') }}
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-7">
                    {{--<video width="400" controls>--}}
                        {{--<source src="{{ asset('media/doctor-dancing.mp4') }}" type="video/mp4">--}}
                        {{--Your browser does not support HTML5 video.--}}
                    {{--</video>--}}
                    <img src="{{ asset('images/the_female_doctor_4x.jpg') }}" alt="Female Doctor">
                </div>
            </div>
        </div>
    </div>
@endsection
