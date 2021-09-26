$(document).on('click', '.btn-search', function(e){
    var date_from = $('#date-from').val();
    var date_to   = $('#date-to').val();
    var url = url_search + "?date_from=" + date_from + "&date_to=" + date_to;

    window.location.href = url;
});

$(document).ready(function(e){
    document.getElementById("date-from").value = date_from;
    document.getElementById("date-to").value = date_to;
});