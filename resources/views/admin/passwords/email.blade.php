 
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

  #header .scrollto p
  {
        background: url('../../img/icon_blue.svg') repeat 0 0;
        /* z-index: 9999999999999999999; */
        height: 73px;
        width: 150px;
    }
      #header.header-fixed  .scrollto p
      {
        background: url('../../img/icon.svg') repeat 0 0;
          /* z-index: 9999999999999999999; */
        height: 73px;
        width: 150px;
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
                            <h6 class=" mb-3 mt-3 text-center"><a class="text-white" href="">{{ __('Reset Password') }}</a></h6>
                        </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Id" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
