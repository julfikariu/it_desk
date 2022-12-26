<ul class="sidebar-nav">
    <!-- NAV ITEM -->
    <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
        <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="material-icons">dashboard</i><span class="link-text">{{__('Dashboard')}}</span></a>
    </li>




    <!-- NAV DIVIDER -->
    <li class="nav-divider"></li>



    <li class="nav-item {{ (request()->is('admin/contact')) ? 'active' : '' }}">
        <a href="{{route('admin.contact')}}" class="nav-link"><i class="material-icons">chat</i>
            <span class="link-text">{{__('Contact')}}
            </span>
        </a>
    </li>

    <li class="nav-item has-dropdown
        {{ (request()->is('admin/registered-users'
                        , 'admin/create-admin'
                        , 'admin/create-user'
                        )) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="nav-link">
            <i class="material-icons">add_box</i>
            <span class="link-text">User</span>
            <span class="badge badge-md"><i class="material-icons fs-12pt">chevron_right</i></span>
        </a>
        <ul class="dropdown-list">
            <li>
                <a href="{{route('admin.registered-users')}}" class="nav-link"> <i class="material-icons">chevron_right</i>
                    <span class="link-text">{{__('Registered Users')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.create-admin')}}" class="nav-link"> <i class="material-icons">chevron_right</i>
                    <span class="link-text">{{__('Create Admin')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.create-user')}}" class="nav-link"> <i class="material-icons">chevron_right</i>
                    <span class="link-text">{{__('Create User')}}</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-dropdown
        {{ (request()->is('help-desk/category*'
                        , 'help-desk/sub-category*'
                        , 'admin/knowledge*'
                        )) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="nav-link">
            <i class="material-icons">assessment</i>
            <span class="link-text">Help Desk</span>
            <span class="badge badge-md"><i class="material-icons fs-12pt">chevron_right</i></span>
        </a>
        <ul class="dropdown-list" {{ (request()->is('help-desk/category*'
                        , 'help-desk/sub-category*'
                        , 'admin/knowledge*'
                        )) ? 'style=display:block' : '' }}>
            <li>
                <a href="{{route('admin.categories')}}" class="nav-link"> <i class="material-icons">chevron_right</i>
                    <span class="link-text">{{__('Categories ')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.sub-categories')}}" class="nav-link"> <i class="material-icons">chevron_right</i>
                    <span class="link-text">{{__('Sub Categories')}}</span>
                </a>
            </li>
             <li>
                <a href="{{route('admin.knowledge')}}" class="nav-link"> <i class="material-icons">chevron_right</i>
                    <span class="link-text">{{__('Knowledge')}}</span>
                </a>
            </li>
           
        </ul>
    </li>
    <li class="nav-item {{ (request()->is('admin/faq*')) ? 'active' : '' }}">
        <a href="{{route('admin.faq.index')}}" class="nav-link"><i class="material-icons">question_answer</i>
            <span class="link-text">{{__('FAQ')}}
            </span>
        </a>
    </li>
    <li class="nav-item {{ (request()->is('admin/ticket*')) ? 'active' : '' }}">
        <a href="{{route('admin.tickets.index')}}" class="nav-link"><i class="material-icons">credit_card</i>
            <span class="link-text">{{__('Tickets')}}
            </span>
        </a>
    </li>
