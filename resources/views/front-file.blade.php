<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from technext.github.io/malefashion/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Dec 2022 13:16:09 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('/front/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/front/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/front/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/front/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/front/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/front/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/front/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/front/css/style.css') }}" type="text/css">
    <script src="{{ asset('/front/js/jquery-3.3.1.min.js') }}"></script>
    @yield('style')
    <style>
        .filter_check:checked {
            color: black;
        }

        .header__top__links span {
            color: #fff;
            font-size: 13px;
            /* text-transform: uppercase; */
            letter-spacing: 2px;
            margin-right: 28px;
            display: inline-block;
        }

        .bg-tranapsrent {
            background-color: transparent !important;
        }

        .is-invalid {
            border-color: #f00 !important;
            margin-bottom: 0px !important;
        }

    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                @if(Auth::check())
                    <span> ???? Hello, {{ Auth::user()->fname }}</span>
                    <a href="{{ route('logout') }}">Sign out</a>
                @else
                    <a href="{{ route('login_form') }}">Sign in</a>
                @endif
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset('/front/img/icon/search.png') }}" alt=""></a>
            <a href="{{ route('front.wishlist') }}"><img src="{{ asset('/front/img/icon/heart.png') }}" alt=""></a>
            <a href="{{ route('front.cart') }}"><img src="{{ asset('/front/img/icon/cart.png') }}" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                @if(Auth::check())
                                <span> ???? Hello, {{ Auth::user()->fname }} {{ Auth::user()->lname }}</span>
                                <a href="{{ route('logout') }}">Sign out</a>
                                @else
                                <a href="{{ route('login_form') }}">Sign in</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('/front/img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="@if(\Request::route()->getName() == 'home' ) active @endif"><a href="{{ route('home') }}">Home</a></li>
                            <li class="@if(\Request::route()->getName() == 'front.shop' ) active @endif" ><a href="{{ route('front.shop') }}">Shop</a></li>
                            <li class="@if(\Request::route()->getName() == 'front.about' ) active @endif" ><a href="{{ route('front.about') }}">About Us</a></li>
                            <li class="@if(\Request::route()->getName() == 'front.blog' ) active @endif" ><a href="{{ route('front.blog') }}">Blog</a></li>
                            <li class="@if(\Request::route()->getName() == 'front.contect' ) active @endif" ><a href="{{ route('front.contect') }}">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="{{ asset('/front/img/icon/search.png') }}" alt=""></a>
                        @if(Auth::check())
                        <a href="{{ route('front.wishlist') }}"><img src="{{ asset('/front/img/icon/heart.png') }}" alt=""></a>
                        <a href="{{ route('front.cart') }}"><img src="{{ asset('/front/img/icon/cart.png') }}" alt=""> <span>0</span></a>
                        <div class="price">$0.00</div>
                        @else
                        <a href="{{ route('login_form') }}"><img src="{{ asset('/front/img/icon/heart.png') }}" alt=""></a>
                        <a href="{{ route('login_form') }}"><img src="{{ asset('/front/img/icon/cart.png') }}" alt=""> <span>0</span></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    @yield('front')

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="{{ asset('/front/img/footer-logo.png') }}" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="{{ asset('/front/img/payment.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Clothing Store</a></li>
                            <li><a href="#">Trending Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivary</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ??
                            <script>
                                document.write(new Date().getFullYear());
                            </script>2020
                            All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com/" target="_blank">Colorlib</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->
    <!-- Js Plugins -->
    <script src="{{ asset('/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/front/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('/front/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('/front/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/front/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('/front/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('/front/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/front/js/main.js') }}"></script>

    @yield('home-script')
</body>


</html>