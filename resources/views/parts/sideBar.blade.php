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
            <li class="active nav-item"><a class="d-flex align-items-center" href="{{ route('dashboard') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Tableau de board</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps</span><i data-feather="more-horizontal"></i></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('articles.index') }}">
                <i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Email">Articles</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('services.index') }}">
                <i data-feather="gift"></i><span class="menu-title text-truncate" data-i18n="Email">Services</span></a>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('clients.index') }}">
                <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Email">Clients</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Opérations</span><i data-feather="more-horizontal"></i></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span
                        class="menu-title text-truncate" data-i18n="Page Layouts">Facturation</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('services.invoices.index') }}"><i
                                data-feather="circle"></i><span class="menu-item" data-i18n="Collapsed Menu">Services</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('articles.invoices.index') }}"><i data-feather="circle"></i><span
                                class="menu-item" data-i18n="Layout Boxed">Articles</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>