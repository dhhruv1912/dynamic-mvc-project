<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>


    @yield('sub-script')
    <style>
        .bg-purple-lite {
            color: rgb(105 108 255);
            background-color: rgb(105 108 255 / 16%) !important;
        }

        .text-review {
            color: rgb(193 193 0);
        }

        .custom-middel {
            position: relative;
            top: 50%;
            transform: translate(0, -50%);
        }

        .custom-middel:hover{
            transform: translateY(-51%) !important;
        }
        
        .custom-middel:focus{
            transform: translateY(-51%) !important;
        }

        .w-85{
            width: 85% !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!Notification) {
                alert('Desktop notifications not available in your browser. Try Chromium.');
                return;
            }

            if (Notification.permission !== 'granted')
                Notification.requestPermission();
        });


        function notifyMe(title,msg,link,img) {
            if (Notification.permission !== 'granted')
                Notification.requestPermission();
            else {
                var notification = new Notification(title, {
                    icon: img,
                    body: msg,
                });
                notification.onclick = function() {
                    window.open(link);
                };
            }
        }
    </script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('assets/img/svg/logo.svg') }}" width="25" alt="">

                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item" data-i18n="">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    @php
                    $menus = load_menus();

                    @endphp
                    @foreach ($menus as $key=>$menu)
                    <li class="menu-item" data-i18n="{{ $menu['route'] }}">
                        <a href="{{ route($menu['route_name']) }}" class="menu-link">
                            <i class="menu-icon tf-icons bx {{ $menu['icon'] }}"></i>
                            <div>{{ $menu['name'] }}</div>
                        </a>
                    </li>
                    @endforeach

                    <li class="menu-item" data-i18n="menu">
                        <a href="{{ route('admin.menu') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Menu</div>
                        </a>
                    </li>

                    <li class="menu-item" data-i18n="log-out">
                        <a href="{{ route('admin.logout') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-log-out'></i>
                            <div>Log Out</div>
                        </a>
                    </li>


                </ul>
            </aside>
            <!-- / Menu -->

            <div class="layout-page">
                <!-- Navbar -->

                <!--  -->

                @yield('admin-section')

            </div>
        </div>
    </div>
    <script>
        $(function() {
            tab = window.location.pathname.split('/')[4]
            tab = (tab == undefined) ? '' : tab;
            $('li[data-i18n="' + tab + '"]').addClass('active')
        });
        
    </script>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>