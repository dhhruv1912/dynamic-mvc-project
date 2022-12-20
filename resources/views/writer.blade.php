@extends('front-file')
@section('front')
<style>
    .writer-profile{
        border-radius: 50%;
        height: 150px;
        width: 150px;
        object-fit: cover;
        border: 2px solid #a52a2a;
        padding: 2px;
    }
    .writer-info-img{
        bottom: 0;
        left: 25%;
        transform: translate(-50%,50%);
    }
    .writer-info-text{
        bottom: 0;
        right: 10%;
        transform: translate(-50%,100%);
    }
</style>

<!-- Hero Section Begin -->
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-blog set-bg position-relative" style="background-position: center center;" data-setbg="{{ asset('assets/img/writer/thumbnail/' . $writer->thumbnail ) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 style="text-shadow: -6px 6px 5px black;">{{ $writer->name }}</h2>
            </div>
        </div>
    </div>
    <div class="position-absolute writer-info-img d-flex">
        <img class="shadow-lg writer-profile" src="{{ asset('assets/img/writer/profile/' . $writer->profile ) }}" alt="">
    </div>
    <div class="position-absolute writer-info-text d-flex">
        <div class="h-50 position-relative">Showing 1 of {{ $blogs->total() }} Blogs</div>
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