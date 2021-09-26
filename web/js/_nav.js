$(document).on('click', '.btn-cart', function (e) {
    var url = $(this).attr('url');
    window.location.href = url;
});

$(document).ready(function (e) {
    $('.user-cart').html(cart_count);
});