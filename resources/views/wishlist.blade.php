@extends('front-file')
@section('front')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Wishlist</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('front.shop') }}">Home</a>
                        <span>Wishlist</span>
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
                @foreach($product as $key=>$prdt)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">

                        <a href="{{ route('front.product',$prdt['sku'] ) }}">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('/assets/img/product//'. $prdt['mimg'] ) }}">
                                <ul class="product__hover">
                                    <li><img src="{{ asset('/front/img/icon/heart.png' ) }}" alt=""></li>
                                    <li><img src="{{ asset('/front/img/icon/search.png' ) }}" alt=""></li>
                                </ul>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h6>{{ $prdt['name']  }}</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>${{$prdt['price'] }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection