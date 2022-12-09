$(function () {
    $(document).on('click', '.clear_main_img',function(){
        $('#category_img').val('').trigger('change');
    })
    $(document).on("change", 'input[type="file"]', function () {
        target = $(this).data('target');
        if($(this).val() != ''){
            $('.'+target).attr('src',window.URL.createObjectURL(this.files[0]))
        }else{
            $('.'+target).attr('src','http://localhost/one/public/assets/img/product/cosw2.jpg')

        }
    });
});