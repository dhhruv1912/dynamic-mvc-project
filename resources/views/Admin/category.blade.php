@extends('Admin.admin-file')

@section('admin-section')

<nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme mb-1" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="btn btn-outline-primary" href="{{ route('admin.category.form') }}"> Add Category <i class='bx bx-right-arrow-alt'></i></a>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    <div class="mx-4 mb-3 pb-5">
        <div class="px-3 row text-center mb-3">
            <div class="col-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite"> No</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Name</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Image</div>
            </div>
            <div class="col px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Desc</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Slug</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite">Status</div>
            </div>
            <div class="col-1 px-1">
                <div class="rounded shadow-sm py-2 bg-purple-lite"> Action</div>
            </div>
        </div>

        @foreach ($categories as $k => $category)
        <div class="px-3 row text-center mb-2">
            <div class="col-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $category['id'] }}</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ $category['Name'] }}</div>
            </div>
            <div class="col-12 col-md-2 px-1">
                <img src="{{ asset('assets/img/category') }}/{{ $category['Img'] }}" width="auto" height="150px" class="rounded shadow-sm p-1 bg-light" />
            </div>
            <div class="col px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light text-break">{{ $category['Desc'] }}</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light text-break">{{ $category['Slug'] }}</div>
            </div>
            <div class="col-12 col-md-1 px-1">
                <div class="rounded h-100 shadow-sm py-2 bg-light">{{ ($category['status'] == '1') ? 'Active' : 'Diactive' }}</div>
            </div>
            <div class="col-1 px-1">
                <div class="m-0 h-100">
                    <div class="pb-1">
                        <button type="button" class="btn btn-outline-secondary col-12" data-id="{{ $category['id'] }}"><i class='bx bxs-show'></i></button>
                    </div>
                    <div class="py-1">
                        <a href="{{ route('admin.category.form',$category['id']) }}"><button type="button" class="btn btn-outline-primary col-12" data-id="{{ $category['id'] }}"><i class='bx bx-edit'></i></button></a>
                    </div>
                    <div class="pt-1">
                        <a href="{{ route('admin.category.delete',$category['id']) }}"><button type="button" class="btn btn-outline-danger col-12" data-id="{{ $category['id'] }}"><i class='bx bxs-trash'></i></button></a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        @endforeach
    </div>
</div>
@endsection