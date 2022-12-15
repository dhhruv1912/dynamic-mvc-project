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
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <form action="{{ route('front.filter') }}" method="post">
                        @csrf
                        <div class="row my-2 justify-content-around">
                            <a href="{{ route('front.shop') }}" class="btn-outline-dark btn rounded-0" style="width: 45%;">Reset</a>
                            <button type="submit" class="btn btn-dark rounded-0" style="width: 45%;">Filter</button>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @foreach($category as $key=>$cat)
                                                    <li class="form-check">
                                                        <input class="form-check-input" type="radio" name="cat" id="cat-{{ $key }}" @if(isset($filter['cat'])) @if($filter['cat'] == $key) checked @endif @endif value="{{ $key }}">
                                                        <label for="cat-{{ $key }}">{{ $cat }}</label>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li class="form-check">
                                                        <input class="form-check-input" type="radio" name="price" id="price-0-100" @if(isset($filter['price'])) @if($filter['price'] == '0-100') checked @endif @endif  value="0-100">
                                                        <label for="price-0-100">$0.00 - $100.00</label>
                                                    </li>
                                                    <li class="form-check">
                                                        <input class="form-check-input" type="radio" name="price" id="price-100-500" @if(isset($filter['price'])) @if($filter['price'] == '100-500') checked @endif @endif  value="100-500">
                                                        <label for="price-100-500">$100.00 - $500.00</label>
                                                    </li>
                                                    <li class="form-check">
                                                        <input class="form-check-input" type="radio" name="price" id="price-500-" @if(isset($filter['price'])) @if($filter['price'] == '500-') checked @endif @endif  value="500-">
                                                        <label for="price-500-">$500.00 +</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                    </div>
                                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__tags">
                                                <ul>
                                                    @php $tgs = json_decode($tags[0]['value']) @endphp
                                                    @foreach($tgs as $t=>$tg)
                                                    <li class="form-check">
                                                        <input class="form-check-input" type="radio" name="tag" id="tag-{{ $tg }}"  @if(isset($filter['tag'])) @if($filter['tag'] == $tg) checked @endif @endif value="{{ $tg }}">
                                                        <label for="tag-{{ $tg }}">{{ $tg }}</label>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
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
                    @foreach($product as $key=>$prdt)
                    <div class="col-lg-4 col-md-6 col-sm-6">
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