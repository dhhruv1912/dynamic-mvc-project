@extends('front-file')
@section('front')
<pre>
    @if(isset($filter))
    @php print_r($filter) @endphp
    @endif
</pre>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>{{ $tag_name }}</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('front.shop') }}">Home</a>
                        <span>Tag ></span>
                        <span>{{ $tag_name }}</span>
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
                                <p>Showing 1–{{ count($product) }} of {{ $product->total() }} results</p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($product as $key=>$prdt)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            
                            <a href="{{ route('front.product',$prdt->sku ) }}">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('/assets/img/product//'. $prdt->mimg ) }}">
                                    <ul class="product__hover">
                                        <li><img src="{{ asset('/front/img/icon/heart.png' ) }}" alt=""></li>
                                        <li><img src="{{ asset('/front/img/icon/search.png' ) }}" alt=""></li>
                                    </ul>
                                </div>
                            </a>
                                <div class="product__item__text">
                                    <h6>{{ $prdt->name  }}</h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>${{$prdt->price }}</h5>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>{{ $product->links('pagination.shop') }}
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection