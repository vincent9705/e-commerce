$(document).on('click', '.btn-cart-plus', function (e) {
    var cart_id  = $(this).attr('cart-id');
    var url      = plus_url + '?cart_id=' + cart_id;
    var quantity = $(this).siblings('.quantity-text');

    $.get(url,
        function (result) {
            if (result.success) {
                calSubToal();
                quantity.html(Number(quantity.html()) + 1);
            }
            else
                window.alert(result.error);

        })
        .fail(function (result) {
            console.log(result);
        });
});

$(document).on('click', '.btn-cart-minus', function (e) {
    var cart_id = $(this).attr('cart-id');
    var url     = minus_url + '?cart_id=' + cart_id;
    var quantity = $(this).siblings('.quantity-text');

    $.get(url,
        function (result) {
            if (result.success) {
                calSubToal();
                quantity.html(Number(quantity.html()) - 1);
            }
        })
        .fail(function (result) {
            console.log(result);
        });
});

$(document).on('click', '.btn-delete-cart', function (e){
    var cart_id = $(this).attr('cart-id');
    var url     = remove_url + '?cart_id=' + cart_id;
    var card    = $(this).parent().parent().parent();
    $.get(url,
        function (result) {
            if (result.success) {
                calSubToal();
                card.remove();
            }
        })
        .fail(function (result) {
            console.log(result);
        });
});

$(document).ready(function(e){
    calSubToal();
});

function calSubToal()
{
    var sub_total = $('.cart-sub-total');

    $.get(calsub_url,
        function (result) {
            if (result.success) {
                var res = result.success;
                var str = "<b>Sub Total: " + res.toFixed(2) + "</b>"
                sub_total.html(str);
            }
        })
        .fail(function (result) {
            console.log(result);
        });
}

$(document).on('click', '.btn-check-out', function (e) {
    if (confirm('Are you sure want to check out these products?')) {
        $.get(checkout_url,
            function (result) {
                if (result.success) {
                    window.alert("Items in your cart has been check out successfully!");
                    window.location.href = home_url;
                }
            })
            .fail(function (result) {
                console.log(result);
            });
    }
});
