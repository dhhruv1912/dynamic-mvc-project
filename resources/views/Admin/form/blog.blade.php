@extends('Admin.admin-file')


@section('admin-section')
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

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
    <form action="{{ route('admin.blog_save', $id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <div class="card mb-4 shadow @error('blog_name') shadow-danger @enderror">
                <div class="card-body">
                    <div class="row">
                        <label for="blog_name" class="col-form-label col-md-2">Blog Title</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('blog_name') is-invalid @enderror" id="blog_name" name="blog_name" value="@error('blog_name') old('blog_name') @else {{ $name }} @endif">
                            @error('blog_name')
                            {{ $message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow @error('blog_slug') shadow-danger @enderror">
                <div class="card-body">
                    <div class="row">
                        <label for="blog_slug" class="col-form-label col-md-2">Blog Slug</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('blog_slug') is-invalid @enderror" id="blog_slug" name="blog_slug" value="@error('blog_slug') {{ old('blog_slug') }} @else {{ $slug }} @endif">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 shadow @error('blog_author') shadow-danger @enderror">
                                <div class="card-body">
                                    <div class="row">
                                        <label for="blog_author" class="col-form-label col-md-4">Blog Author</label>
                                        <div class="col-md-8">
                                            <select readonly name="blog_author" class="form-control @error('blog_author') is-invalid @enderror" id="blog_author" value="{{auth()->user()->username}}">
                                                <option value="">Select Author</option>
                                                @foreach($admins as $id=>$admin)
                                                <option @if(auth()->user()->username == $admin['username']) selected @endif value="{{ $admin['username'] }}">{{ $admin['fname'] }} {{ $admin['lname'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 shadow @error('blog_writer') shadow-danger @enderror">
                                <div class="card-body">
                                    <div class="row">
                                        <label for="blog_writer" class="col-form-label col-md-4">Blog Writer</label>
                                        <div class="col-md-8">
                                            <select name="blog_writer" class="form-control @error('blog_writer') is-invalid @enderror" id="blog_writer" value="{{auth()->user()->username}}">
                                                <option value="">Select writer</option>
                                                @foreach($writers as $id=>$writer)
                                                <option @if($writter == $writer['username']) selected @endif value="{{ $writer['username'] }}" > {{ $writer['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-4 shadow @error('blog_status') shadow-danger @enderror">
                        <div class="card-body">
                            <div class="row">
                                <label for="blog_status" class="col-form-label col-md-6">Blog Status</label>
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="blog_status" value="0">
                                        <input class="my-2 form-check-input @error('blog_status') is-invalid @enderror" type="checkbox" id="blog_status" name="blog_status" value="1" @if ( @old('blog_status') != null ) @if (@old('blog_status')=='1') checked="checked" @endif @else @if($status=='1') checked="checked" @endif @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="card mb-4 shadow @error('blog_thumbnail') shadow-danger @enderror w-100">
                    <div class="card-body">
                        <label for="blog_thumbnail" class="form-label">Product Thumbnail</label>
                        <input type="file" data-target="#thumbnail_preview" accept="image/*" class="form-control @error('blog_thumbnail') is-invalid @enderror" id="blog_thumbnail" name="blog_thumbnail" value="">
                    </div>
                </div>
                <div class="ms-4 col">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <input type="hidden" name="thumbnail_p" value="{{ $thumbnail }}">
                            <label for="blog_thumbnail"><img src="{{ asset('assets/img/blog/thumb/' . $thumbnail) }}" id="thumbnail_preview" height="200px" width="auto" alt=""></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow @error('blog_content') shadow-danger @enderror">
                <div class="card-body">
                    <label for="blog_content" class="form-label">BLog Content</label>
                    <textarea type="text" class="form-control @error('blog_content') is-invalid @enderror blog_content" id="blog_content" name="blog_content">@error('blog_content') old('blog_content') @else {{ $content }} @endif</textarea>
                </div>
            </div>
            <div class="card mb-4 shadow @error('blog_tags') shadow-danger @enderror">
                <div class="card-body">
                    <label for="blog_tags" class="form-label">Blog Tag</label>
                    <input type="text" class="form-control @error('blog_tags') is-invalid @enderror" id="blog_tags" name="blog_tags" value="@if(old('blog_tags') != null) {{ old('blog_tags') }} @else {{ $tags }} @endif">
                    <div id="blog_tags_help" class="form-text">
                        Saperate Tags by Commma (,).
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
<script>
    $('.blog_content').summernote();
</script>

@if (session()->exists('blog'))
@php $sus_data = session()->get('blog'); @endphp
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
@section('sub-script')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).on("change", 'input[type="file"]', function() {
        target = $(this).data('target');
        if ($(this).val() != '') {
            $(target).attr('src', window.URL.createObjectURL(this.files[0]))
        } else {
            $(target).attr('src', 'http://localhost/one/public/assets/img/product/cosw2.jpg')
        }
    })
</script>
@endsection