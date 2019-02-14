 
@extends('master')

@include('layouts.header')

@include('layouts.footer')

@section('style')
<style type="text/css">


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
.nav-menu  .re{
  border: 1px solid;
  font-weight: 900;
}

</style>
@endsection

@section('main-content')
<section id="intro">
    <div class="container">
        <div class="row pd-top-15">
            <div class="col-sm-12 mt-0">
                <div class="col-sm-4 float-right ">
                        <div class="login-header">
                            <h6 class=" mb-3 mt-3 text-center"><a class="text-white" href="">New User ? <b>{{ __(' Register Here') }}</b></a></h6>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="form-signin pd-10">
                        @csrf

                        <div class="form-group row">
                            <div class="input-group">
                                 <span class="input-group-addon">
                                    <img class="login-icon" src="{{URL::asset('img/name.svg')}}" alt="" >
                                </span>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} " name="name" value="{{ old('name') }}" required autofocus placeholder="Name">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group">
                                 <span class="input-group-addon"> 
                                    <img class="login-icon" src="{{URL::asset('img/e-mail.svg')}}" alt="" >
                                </span>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="E-mail ID">

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

                        <div class="form-group row">

                            <div class="input-group">
                                 <span class="input-group-addon">
                                    <img class="login-icon" src="{{URL::asset('img/confirm_password.svg')}}" alt="" >
                                </span>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Password Confirmation">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary bg-card">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                       <div class="form-group row ">
                                <div class="col-md-12">

                                   <h6 class=" mb-3 text-dark text-center">Already a member ? <a class="text-dark" href="{{url('/register')}}"><b>Login</b></a></h6>
                                </div>
                            </div>
                  
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