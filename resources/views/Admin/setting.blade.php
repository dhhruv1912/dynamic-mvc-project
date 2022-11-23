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
    <form action="{{ route{'admin.setting.save') }}" method="post">
        @csrf
        <div class="mb-5">
            <div class="card mb-4 shadow @error('product_name') shadow-danger @enderror">
                <div class="card-body p-3">
                    Category
                </div>
            </div>
            <div class="card mb-4 shadow">
                <div class="card-body">
                    <div id="categories"></div>
                    <input type="hidden" name="catss" id="catss" />
                    <div class="row">
                        <label for="cat_name" class="col-form-label col-md-2">Add Categorie</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control @error('cat_name') is-invalid @enderror" id="cat_name" name="cat_name" value="{{ old('cat_name')  }}">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-primary add_cats">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow @error('product_name') shadow-danger @enderror">
                <div class="card-body p-3">
                    <button type="submit" class="btn btn-primary btn-outline-primary float-end">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    main_field = $('#catss');
    $('.add_cats').click(function() {
        val = $('#cat_name').val();
        main_val = main_field.val();
        main_field.val(main_val + val + ',');
        $('#cat_name').val('');
    })
</script>
@endsection