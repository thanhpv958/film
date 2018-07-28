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
                    <li class="nav-item page">
                        <a class="nav-link promotion" href="{{ route('user', Auth::user()->id) }}"><i class="fas fa-user-circle"></i> {{Auth::user()->name}}</a>
                    </li>
                    <li class="nav-item page">
                        <a class="nav-link promotion" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('home.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
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
                    <li class="nav-item user">
                        <a class="nav-link" href="{{ url('/auth/facebook') }}">
                            <i class="fab fa-facebook-f"></i> FACEBOOK LOGIN</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- container -->
</nav>
<!-- navbar -->
