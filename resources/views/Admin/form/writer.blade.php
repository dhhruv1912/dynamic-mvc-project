@extends('Admin.admin-file')

@section('admin-section')


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>

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
    <form action="{{ route('admin.writter.save', $id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <div class="row">
                <div class="col-md-4 h-100">
                    <div class="card mb-4 shadow @error('profile') shadow-danger @enderror">
                        <div class="card-body">
                            <div class="col-md-12 mb-3">
                                Profile
                            </div>
                            <div class="col-12 col-md-12 text-center">
                                <input type="hidden" name="profile_p" value="{{ $profile }}">
                                <img src="@if($profile != '') {{ asset('assets/img/writer/profile/' . $profile ) }} @else   http://localhost/one/public/assets/img/product/cosw2.jpg @endif" id="profile_pre" width="315px" height="315px" style="object-fit: cover;" class="bg-light main_img_pre rounded-circle">
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3 mx-0">
                                    <input type="file" data-target="#profile_pre" class="form-control col-md-9 @error('profile') is-invalid @enderror" id="profile" name="profile">
                                    <button type="button" class="btn btn-outline-secondary clear_main_img col-md-3">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-4 shadow @error('thumbnail') shadow-danger @enderror">
                        <div class="card-body">
                            <div class="col-md-12 mb-3">
                                Thumbnail
                            </div>
                            @if (isset($thumbnail))
                            <input type="hidden" name="category_main_img_p" value="{{ $thumbnail }}">
                            @endif
                            <div class="col-12 col-md-12 ">
                                <input type="hidden" name="thumbnail_p" value="{{ $thumbnail }}">
                                <img src="@if($thumbnail != '')  {{ asset('assets/img/writer/thumbnail/' . $thumbnail ) }}  @else  http://localhost/one/public/assets/img/product/cosw2.jpg @endif" id="thumbnail_pre" width="100% " height="315px" style="object-fit: cover;" class="rounded bg-light main_img_pre">
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3 mx-0">
                                    <input type="file" data-target="#thumbnail_pre" class="form-control col-md-9 @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">
                                    <button type="button" class="btn btn-outline-secondary clear_main_img col-md-3">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('name') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="name" class="form-label">Writter Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="@if (old('name') != null) {{ old('name') }} @else {{ $name }} @endif">
                            <div id="name_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('username') shadow-danger @enderror">
                        <div class="card-body">
                            <label for="username" class="form-label">Writter Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="@if (old('username') != null) {{ old('username') }} @else {{ $username }} @endif">
                            <div id="username_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('category_status') shadow-danger @enderror">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3"><label for="category_status" class="form-label">Status</label></div>
                                <div class="col">
                                    <div class="form-switch">
                                        <input type="hidden" name="status" value="0">
                                        <input class="form-check-input mt-0" name="status" type="checkbox" @if($status==1 ) checked @endif value="1" id="flexSwitchCheckDefault">
                                    </div>
                                </div>
                            </div>
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
    </form>
</div>

@endsection

@section('sub-script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).on("change", 'input[type="file"]', function () {
        target = $(this).data('target');
        if($(this).val() != ''){
            $(target).attr('src',window.URL.createObjectURL(this.files[0]))
        }else{
            $(target).attr('src','http://localhost/one/public/assets/img/product/cosw2.jpg')
        }
    });
</script>
@endsection