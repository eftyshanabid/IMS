<div class="navbar-custom topnav-navbar">
    <div class="container-fluid detached-nav">
        <!-- Topbar Logo -->
        <div class="logo-topbar">
            <!-- Logo light -->
            <a href="{{ url('dashboard') }}" class="logo-light">
                <span class="logo-lg">
                    <img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="logo" height="50">
                </span>
                <span class="logo-sm">
                    <img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="small logo" height="50">
                </span>
            </a>

            <!-- Logo Dark -->
            <a href="{{ url('dashboard') }}" class="logo-dark">
                <span class="logo-lg">
                    <img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="dark logo" height="50" style="width: 100%">
                </span>
                <span class="logo-sm">
                    <img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="small logo" height="50" style="width: 100%">
                </span>
            </a>
        </div>

        <!-- Sidebar Menu Toggle Button -->
        <button class="button-toggle-menu">
            <i class="mdi mdi-menu"></i>
        </button>

        <!-- Horizontal Menu Toggle Button -->
        <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <ul class="list-unstyled topbar-menu float-end mb-0">
            <li class="dropdown notification-list d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="ri-search-line noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..."
                               aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                @if(languages()->where('code', session()->get('language'))->count() > 0)
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img
                            src="https://flagsapi.com/{{ languages()->where('code', session()->get('language'))->first()->flag }}/flat/64.png"
                            alt="user-image" class="me-0 me-sm-1" height="12">
                        <span
                            class="align-middle d-none d-lg-inline-block">{{ translate(languages()->where('code', session()->get('language'))->first()->name) }}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
                    </a>
                @endif

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">
                    @if(languages()->where('code', '!=', session()->get('language'))->count() > 0)
                        @foreach(languages()->where('code', '!=', session()->get('language')) as $l)
                            <a href="{{ url('update-language/'.$l->code) }}" class="dropdown-item notify-item">
                                <img src="https://flagsapi.com/{{ $l->flag }}/flat/64.png" alt="user-image"
                                     class="me-1" height="12"> <span
                                    class="align-middle">{{ translate($l->name) }}</span>
                            </a>
                        @endforeach
                    @endif
                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="ri-notification-3-line noti-icon"></i>
                    <span class="noti-icon-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 font-16 fw-semibold"> {{translate('Notification')}}</h6>
                            </div>
                        </div>
                    </div>
                    @php
                        $logs = \DB::table('logs')->where('read_receipt','no')->orderBy('id', 'desc')->take(10)->get();
                    @endphp
                    @if(isset($logs[0]))
                        @foreach($logs as $log)
                            <a href="javascript:void(0)" onclick="Show($(this))" data-title="Read Logs"
                               data-src="{{route('notification.read', $log->id)}}"
                               class="dropdown-item text-dark notify-item border-top border-light py-2">
                                {{ substr($log->log, 0, 35) }}...
                            </a>
                        @endforeach
                    @endif
                    <a href="{{ route('admin.notification') }}"
                       class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                        {{translate('View All')}}
                    </a>
                </div>
            </li>

            <li class="notification-list d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="ri-settings-3-line noti-icon"></i>
                </a>
            </li>

            <li class="notification-list d-none d-sm-inline-block">
                <a class="nav-link" href="javascript:void(0)" id="light-dark-mode">
                    <i class="ri-moon-line noti-icon"></i>
                </a>
            </li>

            <li class="notification-list d-none d-md-inline-block">
                <a class="nav-link" href="#" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                   role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img
                            src="{{ url('/') }}/{{ isset(Auth::user()->avatar) ? Auth::user()->avatar : 'gmfaruk2021.png' }}"
                            alt="{{ isset(Auth::user()->name) ? Auth::user()->name : 'Jhon Dew' }}"
                            class="rounded-circle">
                    </span>
                    <span>
                        <span
                            class="account-user-name">{{ isset(Auth::user()->name) ? Auth::user()->name : 'Jhon Dew' }}</span>
                        <span
                            class="account-position">{{isset(Auth::user()->roles[0]->name)?Auth::user()->roles[0]->name:'Admin'}}</span>
                    </span>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{translate('Welcome')}} !</h6>
                    </div>
                    <!-- item-->
                    <a href="{{ route('my.account') }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span>{{translate('My Account')}}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item"
                           onclick="event.preventDefault();
                    this.closest('form').submit();">
                            <i class="mdi mdi-logout me-1"></i>
                            <span>{{translate('Logout')}}</span>
                        </a>
                    </form>
                </div>
            </li>
        </ul>

    </div>
</div>

<!-- ========== Left Sidebar Start ========== -->
@include('layouts.sidebar')
