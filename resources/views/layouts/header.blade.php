@section('header')
 <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="/home" class="scrollto"><p></p></a></h1>
       
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          @guest
          <li class="menu-active"><a class="log lg" href="{{ route('login') }}">{{ __('Login') }}</a></li>
          <li><a class="log re" href="{{ route('register') }}">{{ __('Register') }}</a></li>
          <li><a class="log po" href="/policy">Privacy  Policy </a></li>
          <li><a class="log he" href="/help">Help</a></li>
          @else
          
          <li><a class="log dr" href="/drop_points">Drop Of Points</a></li>
     {{--       <li><a class="log gr" href="/groups">Groups</a></li> --}}
          <li><a class="log po" href="/policy"> Privacy Policy</a></li>
          <li><a class="log he" href="/help">Help</a></li>
          <li class=" menu-active"> 
            <a class="log lg " href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>

          </li>
                                   
          @endguest
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
@endsection