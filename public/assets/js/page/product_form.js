$(function () {
    
    image_counter = 0;
    $(".add_extra_image ").click(function () {
        image_counter++;
        extra_img = `
    <div class="row mb-2">
        <div class="col-md-1">
            <div class="h-100 card mb-4 shadow ">
                <div class="card-body">
                    <label class="form-label custom-middel">${image_counter}</label>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="h-100 card mb-4 shadow ">
                <div class="card-body">
                    <input type="file" class="form-control custom-middel" id="product_main_img${image_counter}" data-target="img_pre_${image_counter}" name="product_main_img${image_counter}">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2 px-1">
            <img src="http://localhost/one/public/assets/img/product/cosw2.jpg" width="100%" height="150px" class="rounded shadow-sm p-1 bg-light img_pre_${image_counter}">
        </div>
        <div class="col-md-2">
            <div class="h-100 card mb-4 shadow ">
                <div class="card-body">
                    <input type="number" class="form-control  custom-middel" id="product_img_sort${image_counter}" name="product_img_sort${image_counter}">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="h-100 card mb-4 shadow ">
                <div class="card-body">
                    <button type="button" class="btn btn-outline-danger custom-middel delete_img" data-img_counter="${image_counter}">Delete</button>
                </div>
            </div>
        </div>
    </div>
        `;
        $("#extra_img").append(extra_img);
    });
    $(document).on("click", ".delete_img", function () {
        id = $(this).data("img_counter");
        $(this).parent().parent().parent().parent().remove();
    });
    $(document).on("change", 'input[type="file"]', function () {
        target = $(this).data('target');
        if($(this).val() != ''){
            $('.'+target).attr('src',window.URL.createObjectURL(this.files[0]))
        }else{
            $('.'+target).attr('src','http://localhost/one/public/assets/img/product/cosw2.jpg')

        }
    });
    $(document).on('click', '.clear_main_img',function(){
        $('#product_main_img').val('').trigger('change');
    })
});
