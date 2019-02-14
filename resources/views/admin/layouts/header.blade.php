@section('header')
 <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="/admin/home" class="scrollto"><p></p></a></h1>
       
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          @guest
          <li class="menu-active"><a class="log lg" href="{{ route('admin.logout') }}">{{ __('Login') }}</a></li>
          <li><a class="log po" href="/policy">Privacy  Policy </a></li>
          <li><a class="log he" href="/help">Help</a></li>
          @else
          
          <li><a class="log dr" href="{{URL::asset('admin/all-drop-points')}}">All Drop-Points </a></li>
           <li><a class="log my" href="{{URL::asset('admin/my-drop-points')}}">My Drop Of Points</a></li>
          <li><a class="log gr" href="{{URL::asset('admin/groups')}}">Groups</a></li>
          <li><a class="log po" href="/policy"> Privacy Policy</a></li>
          <li><a class="log he" href="/help">Help</a></li>
          <li class=" menu-active"> 
            <a class="log lg " href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
           <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
            </form>

          </li>
                                   
          @endguest
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
@endsection