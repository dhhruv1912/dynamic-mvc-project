@extends('Admin.admin-file')

@section('admin-section')

@php
$category_id = (isset($category)) ? $category[0]['id'] : '';
$category_name = (isset($category)) ? $category[0]['Name'] : '';
$category_desc = (isset($category)) ? $category[0]['Desc'] : '';
$category_slug = (isset($category)) ? $category[0]['Slug'] : '';
$category_status = (isset($category)) ? $category[0]['status'] : '';
$category_img = (isset($category)) ? $category[0]['Img'] : '';
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
    <form action="{{ route('admin.category.save', $category_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <div class="row">
                <div class="col-md-6 h-100">
                    <div class="card mb-4 shadow @error('category_img') shadow-danger @enderror">
                        <div class="card-body">
                            <div class="col-md-12 mb-3">
                                Main Image
                            </div>
                            @if (isset($category_img))
                            <input type="hidden" name="category_main_img_p" value="{{ $category_img }}">
                            @endif
                            <div class="col-12 col-md-12 ">
                                <img src="@if($category_img != '') {{ asset('assets/img/category') }}/{{ $category_img }} @else  http://localhost/one/public/assets/img/product/cosw2.jpg @endif" id="main_img_pre" width="100% " height="315px" style="object-fit: contain;" class="rounded bg-light main_img_pre">
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3 mx-0">
                                    <input type="file" data-target="main_img_pre" class="form-control col-md-9 @error('category_img') is-invalid @enderror" id="category_img" name="category_img">
                                    <button type="button" class="btn btn-outline-secondary clear_main_img col-md-3">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('category_name') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name') }}{{ $category_name }}">
                            <div id="category_name_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="category_name_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 shadow @error('category_slug') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="category_slug" class="form-label">Category Slug</label>
                            <input type="text" class="form-control @error('category_slug') is-invalid @enderror" id="category_slug" name="category_slug" value="{{ old('category_slug') }}{{ $category_slug }}">
                            <div id="category_slug_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="category_slug_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 shadow @error('category_status') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="category_status" class="form-label">Category Status</label>
                            <input type="text" class="form-control @error('category_status') is-invalid @enderror" id="category_status" name="category_status" value="{{ old('category_status') }}{{ $category_status }}">
                            <div id="category_status_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="category_status_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card mb-4 shadow @error('category_desc') shadow-danger @enderror">
                <div class="card-body">
                    <div class="row">
                        <label for="category_desc" class="col-form-label col-md-2">Category Description</label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control @error('category_desc') is-invalid @enderror cat_desc" id="category_desc" name="category_desc">{{ old('category_desc') }}{{ $category_desc }}</textarea>
                        </div>
                    </div>
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
<script src="{{ asset('assets/js/page/category_form.js') }}"></script>
<script>
    $('.cat_desc').summernote();
    if ("{{ $category_desc }}" != "") {
        markupStr = "{{ $category_desc }}";
    } else {
        markupStr = "{{ old('category_desc') }}";
    }
    $('.cat_desc').summernote('code', markupStr)
</script>
@endsection