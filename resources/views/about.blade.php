@extends('front-file')
@section('front')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>About Us</h4>
                        <div class="breadcrumb__links">
                            <a href="index.html">Home</a>
                            <span>About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="{{ asset('assets/img/settings/' . json_decode($settings['about_main_image'])[0] ) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Who We Are ?</h4>
                        <p>{{ $settings['who_we_are'] }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>What We Do ?</h4>
                        <p>{{ $settings['what_we_do'] }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Why Choose Us</h4>
                        <p>{{ $settings['why_choose_us'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="testimonial__text">
                        <span class="icon_quotations"></span>
                        <p>“{{ $settings['about_quote'] }}”
                        </p>
                        <div class="testimonial__author">
                            <div class="testimonial__author__pic">
                                <img src="{{ asset('assets/img/settings/' . json_decode($settings['about_quote_profile'])[0] ) }}" alt="">
                            </div>
                            <div class="testimonial__author__text">
                                <h5>{{ $settings['about_quote_author'] }}</h5>
                                <p>{{ $settings['about_quote_pos'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__pic set-bg" data-setbg="{{ asset('assets/img/settings/' . json_decode($settings['about_right_thumb_image'])[0] ) }}"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Counter Section Begin -->
    <section class="counter spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">{{ $settings['about_clients'] }}</h2>
                        </div>
                        <span>Our <br />Clients</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">{{ $settings['about_total_categories'] }}</h2>
                        </div>
                        <span>Total <br />Categories</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">{{ $settings['about_country'] }}</h2>
                        </div>
                        <span>In <br />Country</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">{{ $settings['about_customers'] }}</h2>
                            <strong>%</strong>
                        </div>
                        <span>Happy <br />Customer</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Team Section Begin -->
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Team</span>
                        <h2>Meet Our Team</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($settings['member_1_profile']) && $settings['member_1_profile'] != '')
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="team__item">
                            <img src="{{ asset('assets/img/settings/' . json_decode($settings['member_1_profile'])[0] ) }}" alt="">
                            <h4>{{ $settings['member_1_name'] }}</h4>
                            <span>{{ $settings['member_1_role'] }}</span>
                        </div>
                    </div>
                @endif
                @if(isset($settings['member_2_profile']) && $settings['member_2_profile'] != '')
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="team__item">
                            <img src="{{ asset('assets/img/settings/' . json_decode($settings['member_2_profile'])[0] ) }}" alt="">
                            <h4>{{ $settings['member_2_name'] }}</h4>
                            <span>{{ $settings['member_2_role'] }}</span>
                        </div>
                    </div>
                @endif
                @if(isset($settings['member_3_profile']) && $settings['member_3_profile'] != '')
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="team__item">
                            <img src="{{ asset('assets/img/settings/' . json_decode($settings['member_3_profile'])[0] ) }}" alt="">
                            <h4>{{ $settings['member_3_name'] }}</h4>
                            <span>{{ $settings['member_3_role'] }}</span>
                        </div>
                    </div>
                @endif
                @if(isset($settings['member_4_profile']) && $settings['member_4_profile'] != '')
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="team__item">
                            <img src="{{ asset('assets/img/settings/' . json_decode($settings['member_4_profile'])[0] ) }}" alt="">
                            <h4>{{ $settings['member_4_name'] }}</h4>
                            <span>{{ $settings['member_4_role'] }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Client Section Begin -->
    <section class="clients spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Partner</span>
                        <h2>Happy Clients</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(json_decode($settings['clients_img']) as $id=>$client)
                    <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                        <span href="#" class="client__item"><img src="{{ asset('assets/img/settings/' . $client ) }}" alt=""></span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Client Section End -->

@endsection
@section('home-script')
@endsection