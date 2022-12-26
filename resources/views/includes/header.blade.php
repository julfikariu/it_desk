<header>
    <nav class="navbar navbar-expand-lg container">
        <a class="navbar-brand" href="{{route('/')}}"><img src="{{ asset(setting('app.basic.logo','frontend/images/logo-example.png')) }}" alt="LOGO"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('/')}}"><i class="fa fa-home" aria-hidden="true"></i>Home </a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>Pages
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @php
                            $mp = 0;
                        @endphp
                        @foreach($menuPages as $menuPage)
                            @php
                                $mp++;
                            @endphp
                            <a class="dropdown-item" href="{{ route('view.any-page', $menuPage->slug) }}">{{ $menuPage->title }}</a>
                            @if($mp != $menuPages->count())
                                <div class="dropdown-divider"></div>
                            @endif
                        @endforeach
                        <a href="{{ route('help-center')}}" class="dropdown-item"> Help Center</a>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('view-contact') }}">
                        <i class="fa fa-comment" aria-hidden="true"></i>  Contact
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faqs.show') }}">
                        <i class="fa fa-question" aria-hidden="true"></i>  Faqs
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('open-ticket') }}">
                        <i class="fa fa-ticket rotate_45" aria-hidden="true"></i>  Open Ticket
                    </a>
                </li>

                @if (Route::has('login'))
                @auth
                <li class="nav-item dropdown">
                    @if (Auth::user()->profile_photo_url)
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="rounded mr-1 float-left" src="{{ asset('upload/frontend/profile/'.Auth::user()->profile_photo_path) }}"
                            alt="{{ Auth::user()->name }}" width="25" height="25" />
                    </a>
                    @else
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}
                    </a>

                    @endif
                    <!-- Account Management -->

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ Auth::user()->user_type == 'ADM'?route('admin.dashboard'):route('dashboard') }}" class="dropdown-item">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        {{--<a href="{{ Auth::user()->user_type == 'ADM'?route('admin.change.password'):route('create-knowledge.show')}}" class="dropdown-item">Create Knowledge</a>
                        <div class="dropdown-divider"></div>--}}
                        <a href="{{ Auth::user()->user_type == 'ADM'?route('admin.change.password'):route('user.change.password')}}" class="dropdown-item">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </a>
                        </form>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="btn btn-outline-light my-sm-0" href="{{ route('login') }}">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Login / Create Account
                    </a>
                </li>
                @endauth
                @endif
            </ul>



        </div>
    </nav>
</header>
