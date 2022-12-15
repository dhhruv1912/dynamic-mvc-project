@extends('front-file')
@section('front')

<!-- Hero Section Begin -->
@if(isset($settings['hero_image']) && $settings['hero_image'] != '')
<section class="hero">
    <div class="hero__slider owl-carousel">
        @foreach(json_decode($settings['hero_image']) as $no => $slide)
        <div class="hero__items set-bg" data-setbg="{{ asset('assets/img/settings/' . $slide) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>{{ $settings['hero_title'] }}</h6>
                            <h2>{{ $settings['hero_head'] }}</h2>
                            <p>{{ $settings['hero_desc'] }}</p>
                            <a href="{{ $settings['hero_link'] }}" class="primary-btn">{{ $settings['hero_button_text'] }}<span class="arrow_right"></span></a>
                            <div class="hero__social">
                                @if(isset($settings['hero_fb_link']) && $settings['hero_fb_link'] != '#' && $settings['hero_fb_link'] != '')
                                <a href="{{ $settings['hero_fb_link'] }}"><i class="fa fa-facebook"></i></a>
                                @endif
                                @if(isset($settings['hero_tw_link']) && $settings['hero_tw_link'] != '#' && $settings['hero_tw_link'] != '')
                                <a href="{{ $settings['hero_tw_link'] }}"><i class="fa fa-twitter"></i></a>
                                @endif
                                @if(isset($settings['hero_pn_link']) && $settings['hero_pn_link'] != '#' && $settings['hero_pn_link'] != '')
                                <a href="{{ $settings['hero_pn_link'] }}"><i class="fa fa-pinterest"></i></a>
                                @endif
                                @if(isset($settings['hero_in_link']) && $settings['hero_in_link'] != '#' && $settings['hero_in_link'] != '')
                                <a href="{{ $settings['hero_in_link'] }}"><i class="fa fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif
<!-- Hero Section End -->

<!-- Banner Section Begin -->
@if (isset($settings['banner_category']) && count(json_decode($settings['banner_category'])) > 0 )
<section class="banner spad">
    <div class="container">
        <div class="row">
            @php $banner_category = json_decode($settings['banner_category']); $display_cat = []; @endphp
            @if(isset($banner_category))
            @foreach($category as $key=>$cat)
            @if($cat['id'] == $banner_category[0])
            @php $display_cat[] = $cat; @endphp
            @endif
            @if($cat['id'] == $banner_category[1])
            @php $display_cat[] = $cat; @endphp
            @endif
            @if($cat['id'] == $banner_category[2])
            @php $display_cat[] = $cat; @endphp
            @endif
            @endforeach
            @endif
            @if(isset($display_cat[0]))
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="{{ asset('/assets/img/category//' . $display_cat[0]['Img']) }}" class="bg-light p-3" style="object-fit: contain;" height="440px" width="440px" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>{{ $display_cat[0]['Name'] }}</h2>
                        <a href="{{ $display_cat[0]['Slug'] }}">Shop now</a>
                    </div>
                </div>
            </div>
            @endif
            @if(isset($display_cat[1]))
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="{{ asset('/assets/img/category//' . $display_cat[1]['Img']) }}" class="bg-light p-3" style="object-fit: contain;" height="440px" width="440px" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>{{ $display_cat[1]['Name'] }}</h2>
                        <a href="{{ $display_cat[1]['Slug'] }}">Shop now</a>
                    </div>
                </div>
            </div>
            @endif
            @if(isset($display_cat[2]))
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="{{ asset('/assets/img/category//' . $display_cat[2]['Img']) }}" class="bg-light p-3" style="object-fit: contain;" height="440px" width="440px" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>{{ $display_cat[2]['Name'] }}</h2>
                        <a href="{{ $display_cat[2]['Slug'] }}">Shop now</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                    <li data-filter=".new-arrivals">New Arrivals</li>
                    <li data-filter=".hot-sales">Hot Sales</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @foreach($product['sale'] as $key=>$sale_product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                <div class="product__item sale">
                    <a href="{{ route('front.product',$sale_product['sku'] ) }}">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('/assets/img/product//' . $sale_product['mimg']) }}">
                            <span class="label">Sale</span>
                            <ul class="product__hover">
                                <li><img src="{{ asset('/front/img/icon/heart.png') }}" alt=""></li>
                                <li><img src="{{ asset('/front/img/icon/search.png') }}" alt=""></li>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>{{ $sale_product['name'] }}</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5><del>${{ $sale_product['price'] }}</del> ${{ $sale_product['spc'] }}</h5>
                    </div>
                </div>
            </div>

            @endforeach
            @foreach($product['new'] as $key=>$new_product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <a href="{{ route('front.product',$new_product['sku'] ) }}">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('/assets/img/product//' . $new_product['mimg']) }}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><img src="{{ asset('/front/img/icon/heart.png') }}" alt=""></li>
                                <li><img src="{{ asset('/front/img/icon/search.png') }}" alt=""></li>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>{{ $new_product['name'] }}</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>${{ $new_product['price'] }}</h5>
                    </div>
                </div>
            </div>

            @endforeach
            @foreach($product['rend'] as $key=>$rend_product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix">
                <div class="product__item">
                    <a href="{{ route('front.product',$rend_product['sku'] ) }}">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('/assets/img/product//' . $rend_product['mimg']) }}">
                            <ul class="product__hover">
                                <li><img src="{{ asset('/front/img/icon/heart.png') }}" alt=""></li>
                                <li><img src="{{ asset('/front/img/icon/search.png') }}" alt=""></li>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>{{ $rend_product['name'] }}</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>${{ $rend_product['price'] }}</h5>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
@if(isset($settings['show_hero_product']) && $settings['show_hero_product'] == 1)
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>{{ $settings['hero_product_l1'] }} <br /> <span>{{ $settings['hero_product_l2'] }}</span> <br />{{ $settings['hero_product_l3'] }}</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img style="margin-top: 50% !important;transform: translateY(-50%);" src="{{ asset('/assets/img/product//' . $hero[0]['mimg']) }}" alt="">
                    <div class="hot__deal__sticker">
                        <span>Sale Of</span>
                        <h5>${{ ( (int)$hero[0]['price'] ) - (int)$hero[0]['spc'] }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>{{ $hero[0]['name'] }}</h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span id="days">3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span id="hours">1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span id="minutes">50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span id="seconds">18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
@if(isset($settings['show_instagram_section']) && $settings['show_instagram_section'] == 1)
<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    @if($settings['insta_img_1'] != null) <div class="instagram__pic__item set-bg" data-setbg="{{ asset('/assets/img/settings//' . json_decode($settings['insta_img_1'])[0] )}}"></div> @endif
                    @if($settings['insta_img_2'] != null) <div class="instagram__pic__item set-bg" data-setbg="{{ asset('/assets/img/settings//' . json_decode($settings['insta_img_2'])[0] )}}"></div> @endif
                    @if($settings['insta_img_3'] != null) <div class="instagram__pic__item set-bg" data-setbg="{{ asset('/assets/img/settings//' . json_decode($settings['insta_img_3'])[0] )}}"></div> @endif
                    @if($settings['insta_img_4'] != null) <div class="instagram__pic__item set-bg" data-setbg="{{ asset('/assets/img/settings//' . json_decode($settings['insta_img_4'])[0] )}}"></div> @endif
                    @if($settings['insta_img_5'] != null) <div class="instagram__pic__item set-bg" data-setbg="{{ asset('/assets/img/settings//' . json_decode($settings['insta_img_5'])[0] )}}"></div> @endif
                    @if($settings['insta_img_6'] != null) <div class="instagram__pic__item set-bg" data-setbg="{{ asset('/assets/img/settings//' . json_decode($settings['insta_img_6'])[0] )}}"></div> @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>{{ $settings['instagram_desc'] }}</p>
                    <h3>{{ $settings['instagram_hash'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
@if(isset($settings['show_blog_section']) && $settings['show_blog_section'] == 1)
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>{{ $settings['blog_head'] }}</span>
                    <h2>{{ $settings['blog_title'] }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('/front/img/blog/blog-1.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('/front/img/icon/calendar.png') }}" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('/front/img/blog/blog-2.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('/front/img/icon/calendar.png') }}" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('/front/img/blog/blog-3.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('/front/img/icon/calendar.png') }}" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Latest Blog Section End -->

@endsection
@section('home-script')
<script>
    var timerdate = "2023/01/01";
</script>
<script src=" {{ asset('assets/js/page/home.js') }} "></script>
@endsection