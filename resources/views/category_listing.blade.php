@extends('front-file')
@section('front')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Category</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('front.shop') }}">Home</a>
                        <span>Category </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–{{ count($category) }} of {{ $category->total() }} results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select>
                                    <option value="">Low To High</option>
                                    <option value="">$0 - $55</option>
                                    <option value="">$55 - $100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($category as $key=>$prdt)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            
                            <a href="{{ route('front.category',$prdt['Slug'] ) }}">
                                <div class="product__item__pic set-bg" style="background-size: contain;" data-setbg="{{ asset('/assets/img/category//'. $prdt['Img'] ) }}">
                                    <ul class="product__hover">
                                        <li><img src="{{ asset('/front/img/icon/heart.png' ) }}" alt=""></li>
                                        <li><img src="{{ asset('/front/img/icon/search.png' ) }}" alt=""></li>
                                    </ul>
                                </div>
                            </a>
                                <div class="product__item__text">
                                    <h6>{{ $prdt['Name']  }}</h6>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection