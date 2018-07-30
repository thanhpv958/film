 <!-- navbar -->
 <nav class="navbar navbar-expand-lg navbar-dark" id="NavPage">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="img/logo.png" alt="">
            <h1>CYBERFILM</h1>
        </a>
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item page active">
                    <a class="nav-link" href="{{url('/')}}">{{ __('home.home') }}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item page">
                    <a class="nav-link" href="{{ url('/#CinemaPage') }}">{{ __('home.calendars') }}</a>
                </li>

                <li class="nav-item page">
                    <a class="nav-link" href="{{ url('theaters') }}">{{ __('home.price') }}</a>
                </li>
                <li class="nav-item page">
                    <a class="nav-link" href="{{ url('news') }}">{{ __('home.news') }}</a>
                </li>
                <li class="nav-item page">
                    <a class="nav-link promotion" href="{{ url('promotions') }}">{{ __('home.promotion') }}</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item page dropdown">
                        <a class="nav-link dropdown" href="#" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                            <span class="new-notify dot"></span>
                        </a>
                        <ul class="dropdown-menu notifications">
                            @if (isset($happy))
                                <li class="notify">
                                    <a href="{{ url('user', Auth::user()->id) }}" class="notification-item text-dark">
                                        - {{ __('home.newNotify') }}
                                    </a>
                                </li>
                            @endif
                            <li class="notify">
                                <a href="{{ route('user', Auth::user()->id) }}" class="text-dark">- {{ __('home.profile') }}</a>
                            </li>
                            <li class="notify">
                                <a class="promotion text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       - {{ __('home.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @if (Auth::user()->role != 3)
                        <li class="nav-item user">
                            <a class="nav-link" href="{{url('admin')}}"> {{ __('home.admin') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item user">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-user-circle"></i> {{ __('home.login') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- container -->
</nav>
<!-- navbar -->
