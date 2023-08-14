<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">


                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <!-- user profile -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect"
                        id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/images/users/avatar-2.jpg')}}" alt="Avatar">
                        <span class="d-none d-xl-inline-block ml-1">{{auth()->user()->username}}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{{route('profile')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                        @can('view-settings')
                        <a class="dropdown-item d-block" href="{{route('settings')}}"><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                        @endcan
                        <div class="dropdown-item text-danger">
                            <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="btn" type="submit"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</button>
                            </form>
                        </div>

                    </div>
                </div>
                @can('view-settings')
                <div class="dropdown d-inline-block">
                    <a href="{{route('settings')}}">
                        <button type="button" class="btn header-item noti-icon  waves-effect">
                            <i class="mdi mdi-settings-outline"></i>
                        </button>
                    </a>
                </div>
                @endcan
            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{!empty(AppSettings::get('logo')) ? asset('storage/'.AppSettings::get('logo')): asset('assets/images/logo-sm.png')}}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{!empty(AppSettings::get('logo')) ? asset('storage/'.AppSettings::get('logo')): asset('assets/images/logo-dark.png')}}" alt="" height="17">
                        </span>
                    </a>

                    <a href="" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{!empty(AppSettings::get('logo')) ? asset('storage/'.AppSettings::get('logo')): asset('assets/images/logo-sm.png')}}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{!empty(AppSettings::get('logo')) ? asset('storage/'.AppSettings::get('logo')): asset('assets/images/logo-light.png')}}" alt="" height="19">
                        </span>
                    </a>
                </div>

                <button type="button"
                    class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>


            </div>

        </div>
    </div>
</header>
