$(document).on('click', '.btn-pagination', function (e) {
    var url = url_change_page + "?page_no=" + $(this).attr("page");
    window.location.href = url;
});

$(document).on('click', '.btn-next-page', function (e) {
    var go_to_page = (current_page == total_pages) ? current_page : Number(current_page) + 1
    var url        = url_change_page + "?page_no=" + (go_to_page);
    window.location.href = url;
});

$(document).on('click', '.btn-previous-page', function (e) {
    var go_to_page = (current_page == 1) ? 1 : Number(current_page) - 1
    var url        = url_change_page + "?page_no=" + (go_to_page);
    window.location.href = url;
});