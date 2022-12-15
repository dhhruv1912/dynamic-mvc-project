@extends('front-file')
@section('front')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="index.html">Home</a>
                        <a href="shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('cart_update') }}">
                    <div class="shopping__cart__table" style="min-height: 250px;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @csrf
                                @foreach(json_decode($cart[0]) as $kkk => $cart_data)
                                <tr>
                                    <td class="product__cart__item h-100">
                                        <div class="product__cart__item__pic h-100">
                                            <img src="{{ asset('assets/img/product//' . $product[$kkk]['mimg'] ) }}" height="90px" width="90px" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6 style="width: 80%;text-align:left">{{ $product[$kkk]['name'] }}</h6>
                                            <h5>${{ ($product[$kkk]['price'] - $product[$kkk]['spc']) }}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" name="{{ $kkk }}" value="{{ $cart_data }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">${{ ($product[$kkk]['price'] - $product[$kkk]['spc']) * $cart_data }}</td>
                                    <td class="cart__close"><a href="{{ route('front.cart.remove' , $kkk) }}"><i class="fa fa-close"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <button type="submit" class="primary-btn">Update cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>$ 169.50</span></li>
                        <li>Total <span>$ 169.50</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('home-script')
@endsection