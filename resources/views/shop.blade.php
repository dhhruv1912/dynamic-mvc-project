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
                                                        <input class="form-check-input" type="checkbox" name="cat[]" id="cat-{{ $key }}" value="{{ $key }}">
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
                                                        <input class="form-check-input" type="checkbox" name="price[]" id="price-0-50" value="0-50">
                                                        <label for="price-0-50">$0.00 - $50.00</label>
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
                                                    <li class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="tag[]" id="tag-product" value="product">
                                                        <label for="tag-product">Product</label>
                                                    </li>
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
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('/front/img/product/product-'. $key .'.jpg') }}">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                    </li>
                                    <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Piqué Biker Jacket</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$67.24</h5>
                                <div class="product__color__select">
                                    <label for="pc-4">
                                        <input type="radio" id="pc-4">
                                    </label>
                                    <label class="active black" for="pc-5">
                                        <input type="radio" id="pc-5">
                                    </label>
                                    <label class="grey" for="pc-6">
                                        <input type="radio" id="pc-6">
                                    </label>
                                </div>
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