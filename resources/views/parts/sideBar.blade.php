<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"
                    href="../../../starter-kit/ltr/vertical-menu-template/"><span class="brand-logo">
                        <img src="{{ asset('app-assets/images/logo/logo.png') }}" width="350" alt="logo">
                        <!-- <h2 class="brand-text text-primary ml-1">ELG<b class="text-dark">S</b></h2> -->
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if ($menus)
            @foreach ($menus as $menu)
            @if (isset($menu->url) && !isset($menu->group))
            <li class="{{ $menu->is_active ? 'active' : ''}} nav-item"><a class="d-flex align-items-center" href="{{ route($menu->url) }}"><i
                        data-feather="{{ $menu->icon }}"></i><span class="menu-title text-truncate" data-i18n="Home">{{ $menu->title }}</span></a>
            </li>
            @endif
            @endforeach
            @endif

            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Opérations</span><i data-feather="more-horizontal"></i></li>
            @if ($menus)
            @foreach ($menus as $menu)
            @if (isset($menu->group) && $menu->group === 'operations')
            @if (!isset($menu->url))
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="{{ $menu->icon }}"></i><span
                        class="menu-title text-truncate" data-i18n="Page Layouts">{{ $menu->title }}</span></a>
                <ul class="menu-content">
                    @if($menu->submenu)
                    @foreach ($menu->submenu as $submenu)
                    <li class="{{ $submenu->is_active ? 'active' : ''}}">
                        <a class="d-flex align-items-center" href="{{ route($submenu->url) }}">
                            <i data-feather="circle"></i><span class="menu-item" data-i18n="Collapsed Menu">{{ $submenu->title }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </li>
            @else
            <li class="{{ $menu->is_active ? 'active' : ''}} nav-item"><a class="d-flex align-items-center" href="{{ route($menu->url) }}"><i
                        data-feather="{{ $menu->icon }}"></i><span class="menu-title text-truncate" data-i18n="Home">{{ $menu->title }}</span></a>
            </li>
            @endif
            @endif
            @endforeach
            @endif
            @role(['admin', 'manager'])
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps</span><i data-feather="more-horizontal"></i></li>
            @endrole
            @if ($menus)
                @foreach ($menus as $menu)
                    @if (isset($menu->roles))
                        @role ($menu->roles)
                            @if (isset($menu->group) && $menu->group === 'apps')
                                @if (!isset($menu->url))
                                    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="{{ $menu->icon }}"></i><span
                                                class="menu-title text-truncate" data-i18n="Page Layouts">{{ $menu->title }}</span></a>
                                        <ul class="menu-content">
                                            @if($menu->submenu)
                                            @foreach ($menu->submenu as $submenu)
                                            <li class="{{ $submenu->is_active ? 'active' : ''}}">
                                                <a class="d-flex align-items-center" href="{{ route($submenu->url) }}">
                                                    <i data-feather="circle"></i><span class="menu-item" data-i18n="Collapsed Menu">{{ $submenu->title }}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                @else
                                    <li class="{{ $menu->is_active ? 'active' : ''}} nav-item"><a class="d-flex align-items-center" href="{{ route($menu->url) }}"><i
                                                data-feather="{{ $menu->icon }}"></i><span class="menu-title text-truncate" data-i18n="Home">{{ $menu->title }}</span></a>
                                    </li>
                                @endif
                             @endif
                         @endrole
                    @else
                        @if (isset($menu->group) && $menu->group === 'apps')
                             @if (!isset($menu->url))
                                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="{{ $menu->icon }}"></i><span
                                            class="menu-title text-truncate" data-i18n="Page Layouts">{{ $menu->title }}</span></a>
                                    <ul class="menu-content">
                                        @if($menu->submenu)
                                        @foreach ($menu->submenu as $submenu)
                                        <li class="{{ $submenu->is_active ? 'active' : ''}}">
                                            <a class="d-flex align-items-center" href="{{ route($submenu->url) }}">
                                                <i data-feather="circle"></i><span class="menu-item" data-i18n="Collapsed Menu">{{ $submenu->title }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </li>
                            @else
                                <li class="{{ $menu->is_active ? 'active' : ''}} nav-item"><a class="d-flex align-items-center" href="{{ route($menu->url) }}"><i
                                            data-feather="{{ $menu->icon }}"></i><span class="menu-title text-truncate" data-i18n="Home">{{ $menu->title }}</span></a>
                                </li>
                            @endif
                        @endif
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>