@extends('front-file')
@section('front')

<!-- Hero Section Begin -->
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-blog set-bg" data-setbg="{{ asset('assets/img/settings/' . json_decode($settings['blog_page_header_image'])[0] ) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>#{{$tag}}</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            @foreach($blogs as $key=>$blog)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset('assets/img/blog/thumb/' . $blog['thumbnail'] ) }}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset('front/img/icon/calendar.png') }}" alt=""> {{ date('d F Y', strtotime($blog['date'])) }}</span>
                            <h5>{{ $blog['name'] }}</h5>
                            <a href="{{ route('front.blog.view' , $blog['slug'] ) }}">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Blog Section End -->
<!-- Latest Blog Section End -->

@endsection
@section('home-script')
@endsection