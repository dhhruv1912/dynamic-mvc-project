@extends('front-file')
@section('style')
<link rel="stylesheet" href="{{ asset('plugin/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('plugin/slick/slick-theme.css') }}">
@endsection
@section('front')
<pre>
    @php
         // print_r($product[0]);
    @endphp
</pre>
<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic mx-md-5 mb-0" style="border-radius: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="{{ route('front.shop') }}">Home</a>
                        <a href="{{ route('front.category', $product[0]->c_slug ) }}">{{ $product[0]->c_name }}</a>
                        <span>{{ $product[0]->name }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-3">
                    <div class="p-3 m-3">
                        <div class="slider product_image">
                            <div class="product__details__pic__item">
                                <img src="{{ asset('assets/img/product/' . $product[0]->mimg   ) }}" height="auto" width="auto" alt="">
                            </div>
                            @php $imgs= json_decode($product[0]->simg, true); @endphp
                            @if( is_array($imgs) && count($imgs) > 0)
                            @foreach($imgs as $sort_od=>$image_ )
                            <div class="product__details__pic__item">
                                <img src="{{ asset('assets/img/product/' . $image_['link']   ) }}" height="440px" width="440px" alt="">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product__details__text text-left">
                        <h4>{{$product[0]->name}}</h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <span> - 5 Reviews</span>
                        </div>
                        @if( $product[0]->spc != 0)
                        <h3>${{ $product[0]->price - $product[0]->spc }}<span>${{ $product[0]->price }} </span></h3>
                        @else
                        <h3>${{ $product[0]->price }} </h3>
                        @endif
                        <p>{!! $product[0]->about !!}</p>
                        <form action="{{ route('front.cart.add')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product[0]->id }}">
                            <div class="product__details__cart__option">
                                <div class="quantity bg-white">
                                    <div class="pro-qty">
                                        <input type="text" name="qty" value="1">
                                    </div>
                                </div>
                                <input class="primary-btn" type="submit" value="add to cart">
                            </div>
                        </form>
                        <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                        </div>
                        <div class="product__details__last__option">
                            <h5><span class="bg-transparent">Guaranteed Safe Checkout</span></h5>
                            <img src="{{ asset('front/img/shop-details/details-payment.png') }}" alt="">
                            <ul>
                                <li><span>SKU:</span> {{ $product[0]->sku }}</li>
                                <li><span>Categories:</span> <a class="btn" href="{{ route('front.category', $product[0]->c_slug ) }}">{{ $product[0]->c_name }}</a></li>
                                <li><span>Tag:</span>
                                    @foreach(json_decode($product[0]->tag,true) as $aa=>$tag) <a href="{{ route('front.tag', $tag ) }}" class="btn"> {{ $tag }}</a> @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="product__details__content mb-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab pt-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-desc" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-review" role="tab">Customer
                                    Previews(5)</a>
                            </li>
                            @if($product[0]->info != '' && $product[0]->info != null)
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-info" role="tab">Additional
                                    information</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-desc" role="tabpanel">
                                <div class="product__details__tab__content">
                                    {!! $product[0]->desc !!}
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-review" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                            @if($product[0]->info != '' && $product[0]->info != null)
                            <div class="tab-pane" id="tabs-info" role="tabpanel">
                                <div class="product__details__tab__content">
                                    {!! $product[0]->info !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

@endsection
@section('home-script')
<script src="{{ asset('plugin/slick/slick.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.product_image').slick({
            slidesToShow: 1,
            arrows: false,
            autoplay: true,
            centerMode: true,
            centerPadding: 'auto',
        });
    });
</script>
@endsection