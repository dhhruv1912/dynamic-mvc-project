@extends('Admin.admin-file')

@section('admin-section')


<nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme mb-4" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="{{ route('admin.add_menu') }}">
                    <button type="button" class="btn btn-outline-primary">Add Menu <i class='bx bx-right-arrow-alt'></i></button>
                </a>
            </li>
        </ul>
    </div>
</nav>
@if (session()->get('responce'))
    <div class="alert alert-{{ session()->get('alert_type') }} alert-dismissible mx-4 mt-3" role="alert">
        {{ session()->get('responce') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Hoverable Table rows -->
<div class="card mx-4">
    <h5 class="card-header">Hoverable rows</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu Name</th>
                    <th>Controller</th>
                    <th>Status</th>
                    <th>Route</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($menus as $menu)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $menu['id'] }}</strong></td>
                    <td>{{ $menu['name'] }}</td>
                    <td>{{ $menu['controller'] }}</td>
                    <td><span class="badge bg-label-{{ ($menu['status'] == '1') ? 'primary' : 'danger' }} me-1">{{ ($menu['status'] == '1') ? 'Show' : 'Hide' }}</span></td>
                    <td>{{ $menu['route'] }}</td>
                    <td>
                        <span class="px-3"><a href="{{ route('admin.menu.view',['id' => $menu['id']]) }}"><i class='bx bx-show menu_list_view'></i></a></span>
                        <span class="px-3"><a href="{{ route('admin.add_menu',['id' => $menu['id']]) }}"><i class='bx bx-edit menu_list_edit'></i></a></span>
                        <span class="px-3"><a href="{{ route('admin.menu.delete',['id' => $menu['id']]) }}"><i class='bx bx-trash menu_list_delete'></i></a></span>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
<!--/ Hoverable Table rows -->


<!--/ Contextual Classes -->
<script>
    $(function() {
        $(document).on('mouseenter', '.menu_list_view', function() {
            $(this).addClass('bxs-show text-info').removeClass('bx-show')
        })
        $(document).on('mouseleave', '.menu_list_view', function() {
            $(this).addClass('bx-show').removeClass('bxs-show text-info')
        })
        $(document).on('mouseenter', '.menu_list_edit', function() {
            $(this).addClass('bxs-edit text-primary').removeClass('bx-edit')
        })
        $(document).on('mouseleave', '.menu_list_edit', function() {
            $(this).addClass('bx-edit').removeClass('bxs-edit text-primary')
        })
        $(document).on('mouseenter', '.menu_list_delete', function() {
            $(this).addClass('bxs-trash text-danger').removeClass('bx-trash')
        })
        $(document).on('mouseleave', '.menu_list_delete', function() {
            $(this).addClass('bx-trash').removeClass('bxs-trash text-danger')
        })
    });
</script>
@endsection