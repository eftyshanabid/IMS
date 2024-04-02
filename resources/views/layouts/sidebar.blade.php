<div class="leftside-menu">

    <!-- Logo Light -->
    <a href="{{ url('/') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="logo" height="40">
        </span>
        <span class="logo-sm">
            <img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="small logo" height="40">
        </span>
    </a>

    <!-- Logo Dark -->
    <a href="{{ url('/') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="dark logo" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="small logo" height="50">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button type="button" class="btn button-sm-hover p-0" data-bs-toggle="tooltip" data-bs-placement="right"
            title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </button>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="#">
                <img src="{{ url('backend') }}/assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                     class="rounded-circle shadow-sm">
                <span
                    class="leftbar-user-name">{{ isset(auth()->user()->name) ? auth()->user()->name : 'Jhon Dew' }}</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">{{translate('NAVIGATION')}}</li>

            @forelse($menus as $key => $menu)
                @canany(json_decode($menu->slug, true))
                    @php
                        $activeSubmenuNumber = count($menu->activeSubMenu);
                        $firstLiActiveClass = '';
                        if (Request()->path() == $menu->url) {
                            $firstLiActiveClass = 'active';
                        }
                    @endphp

                    <li class="side-nav-item">
                        @php
                            $url = url($menu->url);
                            if ($activeSubmenuNumber > 0) {
                                $url = '#' . \Str::slug($menu->name . $menu->id);
                            }
                        @endphp

                        <a @if ($activeSubmenuNumber > 0) data-bs-toggle="collapse" aria-expanded="false"
                           aria-controls="{{ $url }}" @endif
                           href="{{ $url }}" class="side-nav-link"
                           target="{{ $menu->open_new_tab == \App\Models\Menu\Menu::OPEN_NEW_TAB ? '_blank' : '' }}">
                            <i class="{{ $menu->icon_class }}"></i>
                            <span> {{ translate($menu->name) }} </span>
                            @if ($activeSubmenuNumber > 0)
                                <span class="menu-arrow"></span>
                            @endif
                        </a>

                        @if ($activeSubmenuNumber > 0)
                            <div class="collapse" id="{{ \Str::slug($menu->name . $menu->id) }}">
                                <ul class="side-nav-second-level">
                                    @foreach ($menu->activeSubMenu as $subMenu)
                                        @canany(json_decode($subMenu->slug, true))
                                            <li><a href="{{ url($subMenu->url) }}"
                                                   target="{{ $subMenu->open_new_tab == \App\Models\Menu\SubMenu::OPEN_NEW_TAB ? '_blank' : '' }}">
                                                    @if ($subMenu->icon_class)
                                                        <i class="{{ $subMenu->icon_class }}"></i>
                                                    @endif {{ translate($subMenu->name) }}
                                                </a>
                                            </li>
                                        @endcanany
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </li>
                @endcanany
            @empty
                <li class="side-nav-title side-nav-item">{{translate('No Menu Data Found')}}</li>
            @endforelse
        </ul>
        <!--- End Sidemenu -->
        <div class="clearfix"></div>
    </div>
</div>
