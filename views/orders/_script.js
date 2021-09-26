$(document).on('click', '.btn-set-to-ship', function (e) {
    e.preventDefault();
    if (confirm('Confirm set status to "To Ship"?')) {
        var url = $(this).attr('url');
        $.post(url,
            null,
            function (result) {
                console.log(result);
                if (result.success) {
                    var msg = [
                        'Status has been changed.',
                    ];
                    window.alert(msg.join('<br>'));
                    $.pjax.reload({ container: '#pjax-orders' });
                } else if (result.error) {
                    window.alert(result.error);
                }
            })
            .fail(function (result) {
                window.alert(result.responseJSON.message);
            });
    }
});

$(document).on('click', '.btn-set-completed', function (e) {
    e.preventDefault();
    if (confirm('Confirm set status to "Completed"?')) {
        var url = $(this).attr('url');
        $.post(url,
            null,
            function (result) {
                if (result.success) {
                    var msg = [
                        'Status has been changed.',
                    ];
                    window.alert(msg.join('<br>'));
                    $.pjax.reload({ container: '#pjax-orders' });
                } else if (result.error) {
                    window.alert(result.error);
                }
            })
            .fail(function (result) {
                window.alert(result.responseJSON.message);
            });
    }
});

$(document).on('click', '.btn-set-cancel', function (e) {
    e.preventDefault();
    if (confirm('Confirm set status to "Cancel"?')) {
        var url = $(this).attr('url');
        $.post(url,
            null,
            function (result) {
                if (result.success) {
                    var msg = [
                        'Status has been changed.',
                    ];
                    window.alert(msg.join('<br>'));
                    $.pjax.reload({ container: '#pjax-orders' });
                } else if (result.error) {
                    window.alert(result.error);
                }
            })
            .fail(function (result) {
                window.alert(result.responseJSON.message);
            });
    }
});