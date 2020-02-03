{{-- <style>
    /* .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    } */
</style> --}}

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <b>ZAM Lab Solutions</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            @if (Route::has('login'))
                <div class="top-right links">
                    @if(Request::path() !== "/")
                        <a class="nav-item dropdown nav-link" style="color: rgba(0,0,0,0.5)">
                            @auth
                                @if(Auth::user()->hasRole('admin'))
                                    Admin
                                @elseif(Auth::user()->hasRole('inspector'))
                                    Inspector
                                @else
                                    Student
                                @endif
                                View
                            @endif
                        </a>
                    @else

                    @endauth
                </div>
        @endif

        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto links">
                @if(Request::path() !== "/")
                    <a class="mt-2" href="{{ url('/') }}">Home</a>
                @endif
            <!-- Authentication Links -->
                @guest
                    <a class="mt-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="mt-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    @if(Request::path() !== "home")
                        <a class="mt-2" href="{{ url('/home') }}">Dashboard</a>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
