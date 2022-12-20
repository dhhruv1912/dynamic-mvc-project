@extends('Admin.admin-file')
@section('sub-script')
<link rel="stylesheet" href="{{ asset('assets/css/user_card.css') }}">
<style>
    .obj-cover {
        object-fit: cover;
    }

    .background_ {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection
@section('admin-section')
<form action="{{ route('admin.product') }}" method="post">
    @csrf
    <nav class="container-xxl layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme mb-1" id="layout-navbar">
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
                    <a class="btn btn-outline-primary" href="{{ route('admin.writer.form') }}"> Create <i class='bx bx-right-arrow-alt'></i></a>
                </li>
            </ul>
        </div>
    </nav>


</form>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="content-wrapper">
        <div class="row">
            @foreach($writer as $key => $value)
            <div class="col-md-3">
                <div class="card shadow-lg profile-card-3">
                    <div class="background-block">
                        <img src="{{ asset('assets/img/writer/thumbnail/' . $value['thumbnail'] ) }}" alt="profile-sample1" class="background_">
                    </div>
                    <div class="profile-thumb-block">
                        <img height="75px" width="75px" src="{{ asset('assets/img/writer/profile/' . $value['profile'] ) }}" alt="profile-image" class="profile obj-cover">
                    </div>
                    <div class="card-content">
                        <h2>{{ $value['name'] }}<small>Writter</small></h2>
                        <div class="icon-block">
                            <a href="{{ route('front.writer' , $value['username'] ) }}"><i class='bx bx-show-alt'></i></a>
                            <a href="{{ route('admin.writer.form' , $value['username']) }}"><i class='bx bxs-edit-alt'></i></a>
                            <a href="{{ route('admin.writter.delete' , $value['username']) }}"><i class='bx bxs-trash'></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@if (session()->exists('writer'))
@php $sus_data = session()->get('writer'); @endphp
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