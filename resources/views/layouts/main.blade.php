@php 
    $route = request()->route()->getName();
@endphp
<!DOCTYPE html>
<!--
Template Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/vuexy_admin
Renew Support: https://1.envato.market/vuexy_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="PIXINVENT">
    <title>Elgrace - Gestion</title>
    <!-- <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-quill-editor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-todo.css') }}"> -->
    @if ($route === 'articles.invoices.create' || 
        $route === 'articles.invoices.edit' || 
        $route === 'articles.invoices.show' ||
        $route === 'services.invoices.create' || 
        $route === 'services.invoices.edit' || 
        $route === 'services.invoices.show' ||
        $route === 'final-invoices.details'
       )
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}">
    @endif

    @if (
        $route === 'services.invoices.index' || 
        $route === 'articles.invoices.index'
        )
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
    @endif

    @if ($route === 'articles.invoices.print' || $route === 'final-invoices.print')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-print.css') }}">
    <style>
        @media print { 
            body {
                background-image: url('{{ asset("app-assets//images/seal/color.png")}}');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            }
        }
    </style>
    @endif

    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern {{$route === 'articles.invoices.print' ? 'blank-page' : '' }}  navbar-floating footer-static  dark-layout" data-open="click" data-menu="vertical-menu-modern" data-col="{{$route === 'articles.invoices.print' ? 'blank-page' : '' }}">

    <!-- BEGIN: Header-->
    @if ($route !== 'articles.invoices.print' && $route !== 'final-invoices.print')
    <x-app.nav></x-app.nav>
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    
    @include('parts.sideBar')
    @endif
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            @if ($route !== 'articles.invoices.print' && $route !== 'final-invoices.print')
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <!-- <h2 class="content-header-title float-left mb-0">Home</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Index
                                    </li>
                                </ol>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="mr-1" data-feather="file-text"></i><span class="align-middle">Location vente</span></a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="file"></i><span class="align-middle">Licences</span></a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="refresh-cw"></i><span class="align-middle">Cleaning</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            </div>
            <div class="content-body">
               {{ $slot }}
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    
    @if ($route !== 'articles.invoices.print' && $route !== 'final-invoices.print')
        <!-- BEGIN: Footer-->
        @include('parts.footer')
        <!-- END: Footer-->
    @endif

    <!-- scripts -->
    @include('parts.scripts')
    <!-- END: scripts -->

</body>
<!-- END: Body-->

</html>