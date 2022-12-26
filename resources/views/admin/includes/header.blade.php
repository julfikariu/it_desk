<div id="wrapper-header">
    <!-- NAVABR -->
    <nav class="navbar navbar-expand navbar-dark navbar-danger bg-dark">
        <!-- NAVABR NAV - LEFT -->
        <ul class="navbar-nav">
            <!-- NAV ITEM - SIDEBARTOGGLE -->
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" data-toggle="class" data-target="#wrapper" toggle-class="toggled">
                    <i data-toggle="switch" data-iconFirst="menu" data-iconSecond="close" class="material-icons">menu</i>
                </a>
            </li>
        </ul>

        <!-- NAVABR NAV - RIGHT -->
        <ul class="navbar-nav ml-auto">
            <!-- NAV ITEM - LANG -->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle no-caret" href="http://example.com" id="messages" data-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons ">mail_outline</i>
                    <span class="badge badge-md">{{ $contacts->count() }}</span>
                </a>

                <div class="dropdown-menu">

                    <div class="dropdown-header py-2">
                        <h6 class="dropdown-title">message</h6>
                        <a href="javascript:void(0);" class="dropdown-link ml-auto"><i class="material-icons">more_horiz</i></a>
                    </div>

                    <div class="dropdown-block p-0 style-scroll maxh-303px">
                        <div class="box-message">
                            <ul class="message-list">
                                @foreach ($contacts as $contact)
                                <li class="message-item">
                                    <div class="">
                                        <i class="material-icons h1">
                                            account_circle
                                        </i>
                                    </div>
                                    <div class="message-content">
                                        <a href="{{route('admin.view-contact', $contact->id)}}" class="message-link">{{ $contact->f_name }}</a>
                                        <p class="message-text">{{ $contact->subject }}</p>
                                        {{-- <span class="message-time">1 mn ago</span> --}}
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <div class="dropdown-footer py-2 justify-content-center">
                        <a class="dropdown-link" href="{{ route('admin.contact') }}"><i class="material-icons">more_horiz</i></a>
                    </div>
                </div>
            </li>
            <!-- NAV ITEM - NOTIFICATIONS -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle no-caret" href="javascript:void(0);" id="notifications" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="material-icons">notifications_none</i>
                    <span class="badge badge-md">5</span>
                </a>

                <div class="dropdown-menu">

                    <div class="dropdown-header py-2">
                        <h6 class="dropdown-title">notification</h6>
                        <a href="javascript:void(0);" class="dropdown-link ml-auto"><i class="material-icons">more_horiz</i></a>
                    </div>

                    <div class="dropdown-block p-0 style-scroll maxh-303px">
                        <div class="box-notification">
                            <ul class="notification-list">
                                {{-- first all the files --}}

                                <li class="notification-item">
                                    <div class="notification-icon bg-primary"><i class="material-icons">text_fields</i></div>
                                    <div class="notification-content">
                                        <a href="javascript:void(0)" class="notification-link">{{ __('New Secret Text')}}</a>
                                        <p class="notification-text">more</p>
                                    </div>
                                    <div class="notification-time">1 mn ago</div>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="dropdown-footer py-2 justify-content-center">
                        <a class="dropdown-link" href="{{ route('/') }}"><i class="material-icons">more_horiz</i></a>
                    </div>
                </div>
            </li>
            <!-- NAV ITEM - PARAMETRES -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle no-caret d-flex align-items-center" href="javascript:void(0)" id="settings" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="{{ $admin_user->profile_photo_path ? asset('upload/backend/profile/'.$admin_user->profile_photo_path) : asset('upload/backend/mail_blank_avatar.jpg') }}"
                        class="rounded-circle " width="32px" />
                    <span class="d-sm-inline-block d-none pl-2 pr-1">{{ $admin_user->name }}</span>
                    <i class="d-sm-inline-block d-none material-icons icon-xs">keyboard_arrow_down</i>
                </a>
                <div class="dropdown-menu maxh-120px">
                    <a class="dropdown-item" href="{{ route('admin.change.password')}}"><i class="material-icons">settings</i> settings</a>
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="material-icons">person</i> {{ __('Profile') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons">power_settings_new</i> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>

    </nav>
</div>

<div class="navbar-search">
    <input type="text" class="form-control-search" id="send_message" placeholder="Write Something ..." />
    <a href="javascript:void(0);" data-toggle="class" data-target=".navbar-search" toggle-class="open" class="text-dark"><i class="material-icons">close</i></a>
</div>