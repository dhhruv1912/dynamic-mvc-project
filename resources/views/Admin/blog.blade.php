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
                    <a class="btn btn-outline-primary" href="{{ route('admin.blog_form') }}"> Create <i class='bx bx-right-arrow-alt'></i></a>
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
                <div class="rounded shadow-sm py-2 bg-purple-lite">Thumbnail</div>
            </div>
            <div class="col-12 col-md-3 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Name</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Slug</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Author</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Date</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Tags</div>
            </div>
            <div class="col px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite"> Action</div>
            </div>
        </div>

        @foreach ($blogs as $k => $blog)
        <div class="px-3 row text-center mb-2">
            <div class="col px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $blog['id'] }}</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <img src="{{ asset('assets/img/blog/thumb') }}/{{ $blog['thumbnail'] }}" width="auto" height="150px" style="max-width: inherit;" class="rounded shadow-sm p-1 bg-light" />
            </div>
            <div class="col-12 col-md-3 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $blog['name'] }}</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded h-100 shadow-sm  bg-light text-break">
                    <div class="h-75 py-2">
                        {{ $blog['slug'] }}
                    </div>
                    <div class="h-25 p-2 bg-label-primary">
                        Blog Views : {{ $blog['views'] }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-1 px-1">
                @if(auth()->user()->username == $blog['author'])
                <div class="rounded h-100 shadow-sm  bg-light text-break">
                    <div class="h-75 py-2">
                        {{ $blog['author'] }}
                    </div>
                    <div class="h-25 p-2 bg-label-info">
                        You
                    </div>
                </div>
                @else
                <div class="rounded h-100 shadow-sm py-2 bg-light text-break">{{ $blog['author'] }}</div>
                @endif
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm bg-light text-break">
                    <div class="h-75 py-2">
                        {{ $blog['date'] }}
                    </div>
                    @if($blog['status'] == 1)
                    <div class="h-25 p-2 bg-label-success">
                        Public
                    </div>
                    @else
                    <div class="h-25 p-2 bg-label-danger">
                        Privet
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">
                    @php $tags = json_decode($blog['tags'],true) @endphp
                    @foreach($tags as $id =>$tag)
                    <span class="badge bg-primary">{{ $tag }}</span>
                    @endforeach
                    
                </div>
            </div>
            <!-- <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $blog['views'] }}</div>
            </div> -->
            <div class="col px-1">
                <div class="m-0 h-100">
                    <div class="pb-1">
                        <button type="button" class="btn btn-outline-secondary col-12" data-id="{{ $blog['id'] }}"><i class='bx bxs-show'></i></button>
                    </div>
                    <div class="py-1">
                        <a href="{{ route('admin.blog_form',$blog['slug']) }}"><button type="button" class="btn btn-outline-primary col-12" data-id="{{ $blog['id'] }}"><i class='bx bx-edit'></i></button></a>
                    </div>
                    <div class="pt-1">
                        <a href="{{ route('admin.blog_delete',$blog['slug']) }}"><button type="button" class="btn btn-outline-danger col-12" data-id="{{ $blog['id'] }}"><i class='bx bxs-trash'></i></button></a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        @endforeach
    </div>

    {{ $blogs->links('pagination.product') }}

</div>
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