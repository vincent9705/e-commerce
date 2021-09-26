$(document).on('click', '.btn-add-to-cart', function (e) {
    e.preventDefault();
    var url = url_add_cart + '?product_id=' + $(this).attr('product-id');

    $.get(url,        
        function (result) {
            if(result.success)
            {
                $('.btn-cart').fadeOut(400).fadeIn(600);
                $('.user-cart').html(result.success);
            }
            else
                window.alert(result.error);

        })
        .fail(function (result) {
            console.log(result);
        });
});