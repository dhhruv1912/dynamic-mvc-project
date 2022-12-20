@extends('front-file')
@section('front')

<!-- Blog Details Hero Begin -->
<section class="blog-hero spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9 text-center">
                <div class="blog__hero__text">
                    <h2>{{ $blog->name }}</h2>
                    <ul>
                        <li>By {{ $blog->a_fname }} {{ $blog->a_lname }}</li>
                        <li>{{ date('d F Y', strtotime($blog->date)) }}</li>
                        <li>{{ count($comments) }} Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="{{ asset('assets/img/blog/thumb/' . $blog->thumbnail ) }}" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="blog__details__content">
                    @if($settings['show_share_blog'])
                    <div class="blog__details__share">
                        <span>share</span>
                        <ul>
                            <li><a href="{{ $settings['share_blog_fb'] }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ $settings['share_blog_twitter'] }}" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ $settings['share_blog_yt'] }}" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="{{ $settings['share_blog_linked-in'] }}" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            @if(auth()->check())
                                <li><a href="{{ route('front.blog.like', $blog->id) }}" class="bg-info">@if(in_array($blog->id,json_decode($user_liked_blog[0]['blog_like'],true))) <i class="fa-solid fa-thumbs-up"></i> @else <i class="fa-regular fa-thumbs-up"></i> @endif</a></li>
                            @endif
                        </ul>
                    </div>
                    @endif
                    {!! $blog->content !!}
                    <div class="blog__details__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__author">
                                    <a href="{{ route('front.writer', $blog->w_user) }}">
                                        <div class="blog__details__author__pic">
                                            <img src="{{ asset('assets/img/writer/profile/' . $blog->w_profile ) }}" style="object-fit: cover;" alt="">
                                        </div>
                                        <div class="blog__details__author__text">
                                            <h5>{{ $blog->w_name }}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__tags">
                                    @php $tags = json_decode($blog->tags,true);$counter= 0; @endphp
                                    @foreach( $tags as $id=>$tag)
                                        @if($counter < 3)
                                            <a href="{{ route('front.blog.tag' , $tag) }}">#{{ $tag }}</a>
                                        @endif
                                        @php $counter++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog__details__btns">
                        <div class="row">
                            @foreach($comment as $key=> $cmnt)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <span class="blog__details__btns__item">
                                    <div class="d-flex">
                                        <p><span class="bg-secondary text-white rounded-circle p-1">{{ substr(explode(' ',$cmnt->user_name)[0], 0, 1) }}{{ substr(explode(' ',$cmnt->user_name)[1], 0, 1) }}</span></p>
                                        <span class="p-1">
                                            <p> {{ $cmnt->user_name }}</p>
                                            <h5>{{ $cmnt->comment }}</h5>
                                        </span>
                                    </div>
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="blog__details__btns">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <a href="{{ route('front.blog.view' , $previous->slug) }}" class="blog__details__btns__item">
                                    <p><span class="arrow_left"></span> Previous Pod</p>
                                    <h5>{{ $previous->name }}</h5>
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <a href="{{ route('front.blog.view' , $next->slug) }}" class="blog__details__btns__item blog__details__btns__item--next">
                                    <p>Next Pod <span class="arrow_right"></span></p>
                                    <h5>{{ $next->name }}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="blog__details__comment">
                        <h4>Leave A Comment</h4>
                        <form action="{{ route('front.blog.comment') }}" method="post">
                            @csrf
                            <div class="row">
                                @if(auth()->check())
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" placeholder="Name" value="{{ auth()->user()->fname }} {{ auth()->user()->lname }}" readonly>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" placeholder="Email" value="{{ auth()->user()->email }}" readonly>
                                    </div>
                                    <input type="hidden" name="fname" value="{{ auth()->user()->fname }}">
                                    <input type="hidden" name="lname" value="{{ auth()->user()->lname }}">
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @else
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" placeholder="Name">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" placeholder="Email">
                                    </div>
                                @endif
                                <div class="col-lg-12 text-center">
                                    <textarea placeholder="Comment" name="comment"></textarea>
                                    <button type="submit" @if(!auth()->check()) disabled @endif class="@if(auth()->check()) site-btn @else btn btn-dark disabled rounded-0 @endif">Post Comment</button>
                                    @if(!auth()->check())<p class="text-danger">Please Sign in to Comment</p>@endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

@endsection
@section('home-script')
@endsection