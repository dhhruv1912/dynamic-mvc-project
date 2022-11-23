@extends('Admin.admin-file')

@section('admin-section')

<form action="{{ route('admin.product') }}" method="post">
    @csrf
    <nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme mb-1" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="navbar-nav align-items-center col-3">
                <div class="nav-item d-flex align-items-center w-100">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none" placeholder="Search Name..." name="name" value="@if (isset($name)) {{ $name }} @endif" aria-label="Search..." />
                </div>
            </div>
            <div class="navbar-nav align-items-center col-3">
                <div class="nav-item d-flex align-items-center w-100">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none" placeholder="Search SKU..." name="sku" value="@if (isset($sku)) {{ $sku }} @endif" aria-label="Search..." />
                </div>
            </div>
            <div class="navbar-nav align-items-center col-3">
                <div class="nav-item d-flex align-items-center w-100">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none" placeholder="Search Model..." name="model" value="@if (isset($model)) {{ $model }} @endif" aria-label="Search..." />
                </div>
            </div>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="btn btn-outline-primary" href="{{ route('admin.product_add') }}"> Add Product <i class='bx bx-right-arrow-alt'></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme mb-4">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

            <div class="navbar-nav align-items-center col-2">
                <div class="nav-item d-flex align-items-center w-100">
                    <div class="d-flex align-items-center">
                        <div class="col-4">
                            <label for="stock" class="form-control border-0 border-bottom rounded-0 shadow-none">Stock</label>
                        </div>
                        <div class="col-3">
                            <select name="stock_val" class="form-control border-0 border-bottom rounded-0 shadow-none">
                                <option @if (isset($stock_val) && $stock_val=='>=' ) selected @endif value=">="> >= </option>
                                <option @if (isset($stock_val) && $stock_val=='<=' ) selected @endif value="<=">
                                    <= </option>
                            </select>
                        </div>
                        <div class="col-4"><input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none" id="stock" name="stock" value="@if (isset($stock)) {{ $stock }} @endif" aria-label="Search..." /></div>
                    </div>
                </div>
            </div>

            <div class="navbar-nav align-items-center col-2">
                <div class="nav-item d-flex align-items-center w-100">
                    <div class="d-flex align-items-center">
                        <label for="status" class="form-control border-0 border-bottom rounded-0 shadow-none">Status</label>
                        <select name="status" class="form-control border-0 border-bottom rounded-0 shadow-none w-100">
                            <option @if (isset($status) && $status=='1' ) selected @endif value="1"> Active </option>
                            <option @if (isset($status) && $status=='2' ) selected @endif value="2"> Diactive </option>
                        </select>
                    </div>
                </div>
            </div>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <button type="submit" class="btn btn-outline-primary">Filter <i class='bx bx-right-arrow-alt'></i></button>
                </li>
            </ul>
        </div>
    </nav>
</form>
<div class="content-wrapper">
    <div class="mx-4 mb-3 pb-5">
        <div class="px-3 row text-center mb-3">
            <div class="col px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite"> No</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Name</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Image</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Model</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">SKU</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Price</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Stock</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Orders</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Status</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Review</div>
            </div>
            <div class="col px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite"> Action</div>
            </div>
        </div>

        @foreach ($products as $k => $product)
        <div class="px-3 row text-center mb-2">
            <div class="col px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $product['id'] }}</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $product['name'] }}</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <img src="{{ asset('assets/img/product') }}/{{ $product['mimg'] }}" width="auto" height="150px" class="rounded shadow-sm p-1 bg-light" />
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light text-break">{{ $product['model'] }}</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light text-break">{{ $product['sku'] }}</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $product['price'] }}</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $product['qty'] }}</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">2/160</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ ($product['status'] == '1') ? 'Active' : 'Diactive' }}</div>
            </div>
            <!-- <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light"><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star-half'></i><i class='bx bx-star'></i></div>
            </div> -->
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $product['rating'] }}</div>
            </div>
            <div class="col px-1">
                <div class="m-0 h-100">
                    <div class="pb-1">
                        <button type="button" class="btn btn-outline-secondary col-12" data-id="{{ $product['id'] }}"><i class='bx bxs-show'></i></button>
                    </div>
                    <div class="py-1">
                        <a href="{{ route('admin.product_add',$product['id']) }}"><button type="button" class="btn btn-outline-primary col-12" data-id="{{ $product['id'] }}"><i class='bx bx-edit'></i></button></a>
                    </div>
                    <div class="pt-1">
                        <a href="{{ route('admin.product_delete',$product['id']) }}"><button type="button" class="btn btn-outline-danger col-12" data-id="{{ $product['id'] }}"><i class='bx bxs-trash'></i></button></a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        @endforeach
    </div>

    {{ $products->links('pagination.product') }}
</div>
@if (session()->exists('product_added'))
@php $sus_data = session()->get('product_added'); @endphp
<div class="bg-{{ $sus_data['show_popup'] }} bottom-0 bs-toast end-0 fade m-4 show toast toast-placement-ex" id="page-responce" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">{{ $sus_data['title'] }}</div>
        <!-- <small>11 mins ago</small> -->
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">{{ $sus_data['message'] }}</div>
</div>
@endif

@endsection