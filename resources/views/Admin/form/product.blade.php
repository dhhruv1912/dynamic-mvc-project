@extends('Admin.admin-file')

@section('admin-section')

@php
$product_id = (isset($product)) ? $product[0]['id'] : '';
$product_name = (isset($product)) ? $product[0]['name'] : '';
$product_desc = (isset($product)) ? $product[0]['desc'] : '';
$product_tag = (isset($product)) ? $product[0]['tag'] : '';
$product_model = (isset($product)) ? $product[0]['model'] : '';
$product_sku = (isset($product)) ? $product[0]['sku'] : '';
$product_price = (isset($product)) ? $product[0]['price'] : '';
$product_tax_category = (isset($product)) ? $product[0]['tax'] : '';
$product_quantity = (isset($product)) ? $product[0]['qty'] : '';
$product_min_qty = (isset($product)) ? $product[0]['mqty'] : '';
$product_out_of_stock_status = (isset($product)) ? $product[0]['out_of_stock'] : '';
$product_shipping_req = (isset($product)) ? $product[0]['shipping'] : '';
$product_date = (isset($product)) ? $product[0]['avl_date'] : '';
$product_menuf = (isset($product)) ? $product[0]['mfc'] : '';
$product_cat = (isset($product)) ? $product[0]['cat'] : '';
$product_discount = (isset($product)) ? $product[0]['disc'] : 0;
$product_special = (isset($product)) ? $product[0]['spc'] : 0;
$product_main_img = (isset($product)) ? $product[0]['mimg'] : '';
$product_sub_img = (isset($product)) ? $product[0]['simg'] : '';
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>

    <div id="alert_tag"></div>
    @if ($errors->any())
    @foreach ($errors->all() as $k=>$error)
    <div class="alert alert-danger alert-dismissible mt-3">
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach
    @endif
    <style>
        .shadow {
            box-shadow: 0 0.25rem 1rem rgb(105 108 255 / 30%) !important;
        }

        .shadow.shadow-danger {
            box-shadow: 0 0.25rem 1rem rgb(230 56 26 / 30%) !important;
        }
    </style>
    <form action="{{ route('admin.product_save', $product_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="divider divider-primary">
            <div class="divider-text">General</div>
        </div>
        <div class="mb-5">
            <div class="card mb-4 shadow @error('product_name') shadow-danger @enderror">
                <div class="card-body">
                    <div class="row">
                        <label for="product_name" class="col-form-label col-md-2">Product Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name')  }}{{ $product_name }}">
                            <div id="product_name_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_name_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow @error('product_desc') shadow-danger @enderror">
                <div class="card-body">
                    <div class="row">
                        <label for="product_desc" class="col-form-label col-md-2">Product Description</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control @error('product_desc') is-invalid @enderror prod_desc" id="product_desc" name="product_desc">{{ old('product_desc') }}{{ $product_desc }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow @error('product_tag') shadow-danger @enderror">
                <div class="card-body">
                    <div class="row">
                        <label for="product_tag" class="col-form-label col-md-2">Product Tag</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('product_tag') is-invalid @enderror" id="product_tag" name="product_tag" value="{{ old('product_tag') }}{{ $product_tag }}">
                            <div id="product_tag_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_tag_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider divider-primary">
                <div class="divider-text">Data</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_model') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_model" class="form-label">Product Model</label>
                            <input type="text" class="form-control @error('product_model') is-invalid @enderror" id="product_model" name="product_model" value="{{ old('product_model') }}{{ $product_model }}">
                            <div id="product_model_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_model_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_sku') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_sku" class="form-label">Product SKU</label>
                            <input type="text" class="form-control @error('product_sku') is-invalid @enderror" id="product_sku" name="product_sku" value="{{ old('product_sku') }}{{ $product_sku }}">
                            <div id="product_sku_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_sku_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_price') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="number" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price" value="{{ old('product_price') }}{{ $product_price }}">
                            <div id="product_price_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_price_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_tax_category') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_tax_category" class="form-label">Product Tax Category</label>
                            <!-- <input type="text" class="form-control @error('product_tax_category') is-invalid @enderror" id="product_tax_category" name="product_tax_category" value="{{ old('product_tax_category') }}"> -->
                            <select name="product_tax_category" id="product_tax_category" class="form-control @error('product_tax_category').is-invalid.@enderror">
                                <option value="None" @if ( old('product_tax_category' )=='None' || $product_tax_category=='none' ) selected @endif>None</option>
                            </select>
                            <div id="product_tax_category_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_tax_category_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_quantity') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_quantity" class="form-label">Product Quantity</label>
                            <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity" name="product_quantity" value="{{ old('product_quantity') }}{{ $product_quantity }}">
                            <div id="product_quantity_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_quantity_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_min_qty') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_min_qty" class="form-label">Product Minium Stock Status</label>
                            <input type="number" class="form-control @error('product_min_qty') is-invalid @enderror" id="product_min_qty" name="product_min_qty" value="{{ old('product_min_qty') }}{{ $product_min_qty }}">
                            <div id="product_min_qty_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_min_qty_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_out_of_stock_status') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_out_of_stock_status" class="form-label">Product Out Of Stock Status</label>
                            <input type="text" class="form-control @error('product_out_of_stock_status') is-invalid @enderror" id="product_out_of_stock_status" name="product_out_of_stock_status" value="{{ old('product_out_of_stock_status') }}{{ $product_out_of_stock_status }}">
                            <div id="product_out_of_stock_status_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_out_of_stock_status_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_shipping_req') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_shipping_req" class="form-label">Product Shipping Required</label><br>
                            <!-- <input type="text" class="form-control @error('product_shipping_req') is-invalid @enderror" id="product_shipping_req" name="product_shipping_req" value="{{ old('product_shipping_req') }}"> -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="product_shipping_req" id="inlineRadio1" value="1" @if( old('product_shipping_req')=='1' || $product_shipping_req=='1' ) checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="product_shipping_req" id="inlineRadio2" value="0" @if( old('product_shipping_req')=='0' || $product_shipping_req=='0' ) checked @endif>
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                            <div id="product_shipping_req_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_shipping_req_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_date') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_date" class="form-label">Product Date Availabel</label>
                            <input type="date" class="form-control @error('product_date') is-invalid @enderror" id="product_date" name="product_date" value="{{ old('product_date') }}{{ $product_date }}">
                            <div id="product_date_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_date_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider divider-primary">
                <div class="divider-text">Link</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_menuf') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_menuf" class="form-label">Product Menufacturer</label>
                            <input type="text" class="form-control @error('product_menuf') is-invalid @enderror" id="product_menuf" name="product_menuf" value="{{ old('product_menuf') }}{{ $product_menuf }}">
                            <div id="product_menuf_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_menuf_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_cat') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_cat" class="form-label">Product Categories</label>
                            <select multiple="" class="form-control @error('product_cat') is-invalid @enderror " id="product_cat" name="product_cat[]" aria-label="Multiple select example">
                                <option value="1" @if (old("product_cat" )) @if( in_array('1', old("product_cat" )) ) selected @endif @elseif ($product_cat != '') @if (in_array('1' , json_decode($product_cat))) selected @endif @endif>One</option>
                                <option value="2" @if (old("product_cat" )) @if( in_array('2', old("product_cat" )) ) selected @endif @elseif ($product_cat != '') @if (in_array('2' , json_decode($product_cat))) selected @endif @endif>Two</option>
                                <option value="3" @if (old("product_cat" )) @if( in_array('3', old("product_cat" )) ) selected @endif @elseif ($product_cat != '') @if (in_array('3' , json_decode($product_cat))) selected @endif @endif>Three</option>
                            </select>
                            <div id="product_cat_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_cat_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider divider-primary">
                <div class="divider-text">Discount & Special Price</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_discount') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_discount" class="form-label">Product Discount</label>
                            <input type="number" class="form-control @error('product_discount') is-invalid @enderror" id="product_discount" name="product_discount" value="{{ old('product_discount') }}{{ $product_discount }}">
                            <div id="product_discount_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_discount_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('product_special') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_special" class="form-label">Product Special Price</label>
                            <input type="number" class="form-control @error('product_special') is-invalid @enderror" id="product_special" name="product_special" value="{{ old('product_special') }}{{ $product_special }}">
                            <div id="product_special_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="product_special_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider divider-primary">
                <div class="divider-text">Image</div>
            </div>
            <div class="row mb-4">
                <div class="col-md-1">
                    <div class="h-100 card mb-4 shadow @error('product_main_img') shadow-danger @enderror">
                        <div class="card-body">
                            Main Image
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-100 card mb-4 shadow @error('product_main_img') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="product_main_img" class="form-label">Product Special Price</label>
                            <input type="file" data-target="main_img_pre" class="form-control @error('product_main_img') is-invalid @enderror" id="product_main_img" name="product_main_img">
                        </div>
                    </div>
                </div>
                @if (isset($product_main_img))
                <input type="hidden" name="product_main_img_p" value="{{ $product_main_img }}">
                @endif
                <div class="col-12 col-md-2 px-1 shadow">
                    <img src="@if($product_main_img != '') {{ asset('assets/img/product') }}/{{ $product_main_img }} @else  http://localhost/one/public/assets/img/product/cosw2.jpg @endif" id="main_img_pre" width="100% " height="150px" class="rounded p-1 bg-light main_img_pre">
                </div>
                <div class="col-md-3">
                    <div class="h-100 card mb-4 shadow ">
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-secondary clear_main_img">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-1">
                    <div class="card shadow ">
                        <div class="card-body">No</div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card shadow ">
                        <div class="card-body">
                            <label for="product_main_img" class="form-label">Select Image</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2 px-1">
                    <div class="card shadow ">
                        <div class="card-body">
                            <label for="product_main_img" class="form-label">Image</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card shadow ">
                        <div class="card-body">
                            <label for="product_main_img" class="form-label">Sort Order</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card shadow ">
                        <div class="card-body">
                            <label for="product_main_img" class="form-label">Delete</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="extra_img">
                @if ($product_sub_img != '')
                @php $product_sub_img = json_decode($product_sub_img,true); $sub_counter = 0; @endphp
                @foreach ($product_sub_img as $no=>$sub_img)
                @php $sub_counter++ @endphp
                <div class="row mb-2">
                    <div class="col-md-1">
                        <div class="h-100 card mb-4 shadow ">
                            <div class="card-body">
                                <label class="form-label custom-middel">{{ $sub_counter }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="h-100 card mb-4 shadow ">
                            <div class="card-body">
                                <input type="hidden" id="product_main_img{{ $sub_counter }}_p" name="product_main_img{{ $sub_counter }}_p" value="{{ $sub_img['link'] }}">
                                <input type="file" class="form-control custom-middel" id="product_main_img{{ $sub_counter }}_p" data-target="img_pre_{{ $sub_counter }}_p" name="product_main_img{{ $sub_counter }}_p">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 px-1">
                        <img src="{{ asset('assets/img/product') }}/{{ $sub_img['link'] }}" width="100%" height="150px" class="rounded shadow-sm p-1 bg-light img_pre_{{ $sub_counter }}_p">
                    </div>
                    <div class="col-md-2">
                        <div class="h-100 card mb-4 shadow ">
                            <div class="card-body">
                                <input type="number" class="form-control  custom-middel" id="product_img_sort{{ $sub_counter }}_p" value="{{ $sub_img['sort_order'] }}" name="product_img_sort{{ $sub_counter }}_p">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="h-100 card mb-4 shadow ">
                            <div class="card-body">
                                <button type="button" class="btn btn-outline-danger custom-middel delete_img" data-img_counter="{{ $sub_counter }}_p">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="row pb-3">
                <div class="col-12">
                    <span class="add_extra_image btn btn-primary float-end my-2 rounded-pill">Add Image</span>
                </div>
            </div>
        </div>
        <div>
            <div class="bottom-0 position-fixed row w-75">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="float-end">
                                <button type="reset" class="btn rounded-pill btn-outline-danger">Reset</button>
                                <button class="btn rounded-pill btn-outline-primary menu_submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>

@endsection

@section('sub-script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('assets/js/page/product_form.js') }}"></script>
<script>
    $('.prod_desc').summernote();
    if ("{{ $product_desc }}" != "") {
        markupStr = "{{ $product_desc }}";
    } else {
        markupStr = "{{ old('product_desc') }}";
    }
    $('.prod_desc').summernote('code', markupStr)
</script>
@endsection