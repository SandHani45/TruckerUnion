
@extends('master')

@include('layouts.header')

@include('layouts.footer')

@section('style')

<style type="text/css">
.header-fixed .nav-menu .log {
    padding: 8px 10px 7px 14px;
    text-decoration: none;
    display: inline-block;
    color: #fff;
    font-family: "Montserrat", sans-serif;
    font-weight: 400;
    font-size: 14px;
    outline: none;
}
  .nav-menu .log {
    padding: 8px 10px 7px 14px;
    text-decoration: none;
    display: inline-block;
    color: #fff;
    font-family: "Montserrat", sans-serif;
    font-weight: 400;
    font-size: 14px;
    outline: none;
}
.nav-menu .menu-active .log{
  border: 1px solid;
  font-weight: 900;
}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color:none;
    outline: 0;
    box-shadow: none;
}
</style>
@endsection

@section('main-content')

<!--==========================
    Intro Section
  ============================-->
<section id="intro">
    <div class="container">
        <div class="row pd-top-15">
            <div class="col-sm-12 mt-0">
                <div class="col-sm-4 float-right ">
                        <div class="login-header">
                            <h6 class=" mb-3 mt-3 text-center"><a class="text-white" href="">Already a member ? <b>{{ __('Login') }}</b></a></h6>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="form-signin pd-10">
                        @csrf

                            <div class="form-group row">
            
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <img class="login-icon" src="{{URL::asset('img/e-mail.svg')}}" alt="" >
                                    </span>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail ID">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="input-group">
                                    <span class="input-group-addon">
                                         <img class="login-icon" src="{{URL::asset('img/password.svg')}}" alt="" >
                                    </span>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                         <!--    <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                     <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                               <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                     <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary bg-card">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">

                                   <h6 class="mt-5 mb-3 text-dark text-center">New User ? <a class="text-dark" href="{{url('/register')}}"><b> Register here</b></a></h6>
                                </div>
                            </div>
                    </form>
                  
                </div>
            </div>
        </div>
    </div>
</section>

<!-- #intro -->

<main id="main">
    <section> 
        <div class="container"> 
            <div class="row"> 
                <div class="col-sm-5"> 
                    <div class="about mt-5"> 
                     <p> ABOUT US </p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <p class="mt-5 line-height"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diamnonummy nibh euismodtincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quisnostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illumdolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit
                    praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                    </p>
                </div>
            </div>
        </div>
    </section> 
</main>

@endsection 