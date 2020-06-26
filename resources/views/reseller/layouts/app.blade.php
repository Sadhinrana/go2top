<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Go2Top admin - @yield('title')</title>
    <link href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/summernote/dist/summernote-bs4.css') }}">
    <!-- toastr CSS -->
    <link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/libs/raty-js/lib/jquery.raty.css') }}" rel="stylesheet">
    <!-- select2 css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap-material-datetimepicker css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
    <!-- needed css -->
    <link href="{{ asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/reseller/css/main.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar d-block d-md-none">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="javascript:void(0)" onclick="window.location = window.location.origin + '/reseller/users'" aria-expanded="false">
                                <img src="{{ asset('assets/images/logos/logo-light-icon.png') }}" alt="homepage" class="light-logo" height="25px" />
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('reseller/users*') ? 'selected' : '' }}"> <a class="sidebar-link {{ request()->is('reseller/users*') ? 'active' : '' }}" href="{{ route('reseller.users.index') }}" aria-expanded="false"><span class="hide-menu">Users </span></a></li>
                        <li class="sidebar-item {{ request()->is('reseller/exported_orders') ? 'selected' : '' }}"> <a class="sidebar-link {{ request()->is('reseller/exported_orders') ? 'active' : '' }}" href="{{ route('reseller.orders.index') }}" aria-expanded="false"><span class="hide-menu">Orders </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('reseller.order.drip_feed') }}" aria-expanded="false"><span class="hide-menu">Drip-Feed </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('reseller.order.tasks') }}" aria-expanded="false"><span class="hide-menu">Tasks</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('reseller.services.index') }}" aria-expanded="false"><span class="hide-menu">Services </span></a></li>
                        <li class="sidebar-item {{ request()->is('reseller/payments*') ? 'selected' : '' }}"> <a class="sidebar-link {{ request()->is('reseller/payments*') ? 'active' : '' }}" href="{{ route('reseller.payments.index') }}" aria-expanded="false"><span class="hide-menu">Payments </span></a></li>
                        <li class="sidebar-item {{ request()->is('reseller/tickets*') ? 'selected' : '' }}"> <a class="sidebar-link {{ request()->is('reseller/tickets*') ? 'selected' : '' }}" href="{{ route('reseller.tickets.index') }}" aria-expanded="false"><span class="hide-menu">Tickets</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false"><span class="hide-menu">Affiliates </span></a></li>
                        <li class="sidebar-item {{ request()->is('reseller/reports*') ? 'selected' : '' }}"> <a class="sidebar-link {{ request()->is('reseller/reports*') ? 'active' : '' }}" href="{{ route('reseller.reports.index') }}" aria-expanded="false"><span class="hide-menu">Reports </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('reseller.appearance.index') }}" aria-expanded="false"><span class="hide-menu">Appearance </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('reseller.blog.index') }}" aria-expanded="false"><span class="hide-menu">Blog </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('reseller.setting.general.index') }}" aria-expanded="false"><span class="hide-menu">Settings </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('reseller.profile') }}" aria-expanded="false"><span class="hide-menu">Account </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="hide-menu">Logout </span></a></li>
                        <form id="logout-form" action="{{ route('reseller.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="page-content container-fluid" style="background-color: #fff">
                @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Go2TopIT. Designed and Developed by
                <a href="javascript:void(0)">Go2TopIT</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.init.horizontal-fullwidth.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jqbootstrapvalidation/validation.js') }}"></script>
    <!-- This Page JS -->
    <script src="{{ asset('assets/libs/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raty-js/lib/jquery.raty.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/raty/rating-init.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/forms/select2/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') }}"></script>
    <script>
        $(function(){
            @if (session('success'))
                toastr["success"]('{{ session('success') }}');
            @endif

            @error('error')
            Swal.fire({
                type: 'error',
                title: '500 Internal Server Error!',
                html: 'Something went wrong! <br> <span class="error-message text-danger d-none">{{ $message }}</span>',
                footer: '<a href="javascript:void(0)" onclick="document.querySelector(\'.error-message\').classList.remove(\'d-none\');">Why do I have this issue?</a>'
            });
            @enderror

            /************************************/
            //default editor
            /************************************/
            $('.summernote').summernote({
                height: 200, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });

            // MAterial Date picker
            $('.mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
        });

        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);
    </script>
    @yield('script')

</html>
