@extends('Admin.admin-file')

@section('admin-section')

@php
$id = (isset($menus)) ? $menus[0]['id'] : '';
$name = (isset($menus)) ? $menus[0]['name'] : '';
$icon = (isset($menus)) ? $menus[0]['icon'] : '';
$controller = (isset($menus)) ? $menus[0]['controller'] : '';
$status = (isset($menus)) ? $menus[0]['status'] : '';
$view = (isset($menus)) ? $menus[0]['view'] : '';
$route = (isset($menus)) ? $menus[0]['route'] : '';
$route_name = (isset($menus)) ? $menus[0]['route_name'] : '';
$group = (isset($menus)) ? $menus[0]['group'] : '';
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
    <form id="menu_add_form" action="{{ route('admin.save_menu',['id' => $id]) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 shadow @error('menu_name') shadow-danger @enderror">
                    <div class="card-body">
                        <div>
                            <label for="menu_name" class="form-label">Menu Name</label>
                            <input type="text" class="form-control @error('menu_name') is-invalid @enderror" id="menu_name" name="menu_name" value="{{ ($id != '') ? $name : old('menu_name') }}">
                            <div id="menu_name_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="menu_name_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 shadow @error('menu_icon')  shadow-danger @enderror ">
                    <div class="card-body">
                        <div>
                            <label for="menu_icon" class="form-label">Menu Icon</label>
                            <div class="row mx-0">
                                <span class="border col-1 icon_preview px-3 py-2 rounded"><i class="bx"></i></span>
                                <input type="text" class="form-control col @error('menu_icon') is-invalid @enderror" id="menu_icon" name="menu_icon" value="{{ ($id != '') ? $icon : old('menu_icon') }}">
                            </div>
                            <div id="menu_icon_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="menu_icon_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 shadow  @error('menu_route') shadow-danger @enderror">
                    <div class="card-body">
                        <div>
                            <label for="menu_route" class="form-label">Web Path</label>
                            <div class="input-group">
                            <span class="input-group-text @error('menu_route') is-invalid @enderror" id="route_path">https::/domain.com/</span>
                                <input type="text" class="form-control @error('menu_route') is-invalid @enderror" id="menu_route" name="menu_route" value="{{ ($id != '') ? $route : old('menu_route') }}">
                            </div>
                            <div id="menu_route_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="menu_route_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 shadow @error('menu_route_name') shadow-danger @enderror">
                    <div class="card-body">
                        <div>
                            <label for="menu_route_name" class="form-label">Route Name</label>
                            <input type="text" class="form-control @error('menu_route_name') is-invalid @enderror" id="menu_route_name" name="menu_route_name" value="{{ ($id != '') ? $route_name : old('menu_route_name') }}">
                            <div id="menu_route_name_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="menu_route_name_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($menus)) 
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('menu_route_group') shadow-danger @enderror">
                        <div class="card-body">
                            <div>
                                <label for="menu_route_group" class="form-label">Route Group</label>
                                <input type="text" class="form-control @error('menu_route_group') is-invalid @enderror" readonly id="menu_route_group" name="menu_route_group" value="{{ $group }}">
                                <div id="menu_route_group_help" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                                <div id="menu_route_group_error" class="form-text text-danger">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="card mb-4 shadow @error('menu_route_group') shadow-danger @enderror">
                        <div class="card-body">
                            <div>
                                <label for="menu_route_group" class="form-label">Route Group</label>
                                <select class="form-select @error('menu_route_group') is-invalid @enderror"  id="menu_route_group" name="menu_route_group">
                                    <option value="new route" @if ( old('menu_route_group' )=='new route' ) selected @endif @if ($group == 'new route')  selected  @endif>None</option>
                                    <option value="new Admin route" @if ( old('menu_route_group' )=='new Admin route' ) selected @endif @if ($group == 'new Admin route')  selected  @endif>Admin</option>
                                </select>


                                <div id="menu_route_group_help" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                                <div id="menu_route_group_error" class="form-text text-danger">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-6">
                <div class="card mb-4 shadow @error('menu_controller') shadow-danger @enderror">
                    <div class="card-body">
                        <div>
                            <label for="menu_controller" class="form-label">Controller</label>
                            <input type="text" class="form-control @error('menu_controller') is-invalid @enderror" @if (isset($menus)) readonly @endif id="menu_controller" name="menu_controller" value="{{ ($id != '') ? $controller : old('menu_controller') }}">
                            <div id="menu_controller_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="menu_controller_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 shadow @error('view_file') shadow-danger @enderror">
                    <div class="card-body">
                        <div>
                            <label for="view_file" class="form-label">View File</label>
                            <input type="text" class="form-control @error('view_file') is-invalid @enderror" @if (isset($menus)) readonly @endif id="view_file" name="view_file" value="{{ ($id != '') ? $view : old('view_file') }}">
                            <div id="view_file_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                            <div id="view_file_error" class="form-text text-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div>
                            <label for="menu_status" class="form-label">Status</label>
                            <div class="form-check form-switch mb-2">
                                <input type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" @if ($status == '1') checked @endif id="status" name="status" value="1">
                                <label class="form-check-label" for="status">Default switch checkbox input</label>
                            </div>
                            <div id="menu_status_help" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div class="float-end">
                            <button type="reset" class="btn rounded-pill btn-outline-danger">Reset</button>
                            <button class="btn rounded-pill btn-outline-primary menu_submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<script>
    $(function() {
        $('#route_path').text(window.location.origin + '/')
        $('#menu_icon').keyup(function() {
            val = $(this).val();
            $('.icon_preview i').removeClass().addClass('bx ' + val);
        })
        $('#menu_icon').trigger('keyup');
        $('#menu_controller').keyup(function() {
            val = $(this).val();
            valv = val.replace('Controller', '') + 'Controller';
            $(this).val(valv);
            end = valv.length - 10;
            var InputElement = $('#menu_controller')[0];
            InputElement.setSelectionRange(end, end);
        })
    });
</script>
@endsection