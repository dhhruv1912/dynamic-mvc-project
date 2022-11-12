@extends('Admin.admin-file')

@section('admin-section')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>
    <div class="card mb-4">
        <div class="card-body">
            <div>
                <label for="menu_name" class="form-label">Menu Name</label>
                <div class="form-control">{{ $menu['name'] }}</div>
                <div id="menu_name_help" class="form-text">
                    We'll never share your details with anyone else.
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div>
                <label for="menu_name" class="form-label">Menu Icon</label>
                <div class="form-control"><i class="bx {{ $menu['icon'] }}"></i></div>
                <div id="menu_name_help" class="form-text">
                    We'll never share your details with anyone else.
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div>
                <label for="menu_name" class="form-label">Menu Controller</label>
                <div class="form-control">{{ $menu['controller'] }}</div>
                <div id="menu_name_help" class="form-text">
                    We'll never share your details with anyone else.
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div>
                <label for="menu_name" class="form-label">Menu Status</label>
                <div class="form-control">{{ $menu['status'] }}</div>
                <div id="menu_name_help" class="form-text">
                    We'll never share your details with anyone else.
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div>
                <label for="menu_name" class="form-label">Menu View</label>
                <div class="form-control">{{ $menu['view'] }}</div>
                <div id="menu_name_help" class="form-text">
                    We'll never share your details with anyone else.
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div>
                <label for="menu_name" class="form-label">Menu Route</label>
                <div class="form-control">{{ $menu['route'] }}</div>
                <div id="menu_name_help" class="form-text">
                    We'll never share your details with anyone else.
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.menu') }}"><button type="button" class="btn btn-outline-primary"><i class='bx bx-left-arrow-alt'></i> Back</button></a>
</div>
@endsection