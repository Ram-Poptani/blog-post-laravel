<!-- Navigation Area
===================================== -->
<nav class="navbar navbar-pasific navbar-mp megamenu navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="/">
                <img src="{{ asset('assets/img/logo/logo-default.png') }}" alt="logo">
                Pen-It
            </a>
        </div>

        <div class="navbar-collapse collapse navbar-main-collapse">
            <ul class="nav navbar-nav">
                {{-- <li>
                    <a href="" data-toggle="dropdown" class="dropdown-toggle color-light">Home </a>
                </li>--}}
                @auth
                    <li>
                        <a href="{{ route('home') }}" class="color-light">Home </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="color-light"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="color-light">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}" class="color-light">Register</a>
                        </li>
                    @endif
                @endauth
            </ul>

        </div>
    </div>
</nav>