@extends('front-file')
@section('front')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="index.html">Home</a>
                        <span>Shop</span>
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
            <form action="{{ route('front.filter') }}" method="post">
                @csrf
                @php $tgs = json_decode($tags[0]['value']) @endphp
                <div class="row">
                    <div class="col-md-3">
                        <p>Category:</p>
                        <select name="cat" id="cat">
                            <option value="">Select Category</option>
                            @foreach($category as $key=>$cat)
                                <option value="{{ $key }}" @if(isset($filter['cat'])) @if($filter['cat'] == $key) selected @endif @endif>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <p>Price Range:</p>
                        <select name="price" id="price">
                            <option value="">Select Range</option>
                            <option value="0-100" @if(isset($filter['price'])) @if($filter['price'] == '0-100') selected @endif @endif>$0.00 - $100.00</option>
                            <option value="100-500" @if(isset($filter['price'])) @if($filter['price'] == '100-500') selected @endif @endif>$100.00 - $500.00</option>
                            <option value="500-" @if(isset($filter['price'])) @if($filter['price'] == '500-') selected @endif @endif>$500.00 +</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <p>Tag:</p>
                        <select name="tag" id="tag">
                            <option value="">Select Tag</option>
                            @foreach($tgs as $t=>$tg)
                            <option value="{{ $tg }}" @if(isset($filter['tag'])) @if($filter['tag'] == $tg) selected @endif @endif>{{ $tg }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="row my-2 justify-content-around">
                            <!-- <a href="{{ route('front.shop') }}" class="btn-outline-dark btn rounded-0" style="width: 45%;">Reset</a> -->
                            <button type="submit" class="btn btn-dark rounded-0" style="width: 45%;">Filter</button>
                        </div>
                    </div>
                </div>
                <!-- <div class="shop__sidebar__accordion p-4">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-heading">
                                <a data-toggle="collapse" data-target="#collapseOne">Filter</a>
                            </div>
                            <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="shop__product__option__right"> 
                                        <ul class="nice-scroll">
                                        </ul>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </form>
            <div class="col-lg-12 mt-5">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–{{ count($product) }} of {{ $product->total() }} results</p>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select>
                                    <option value="">Low To High</option>
                                    <option value="">$0 - $55</option>
                                    <option value="">$55 - $100</option>
                                </select>
                            </div>
                        </div> -->
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
                </div>
                {{ $product->links('pagination.shop') }}
            </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection