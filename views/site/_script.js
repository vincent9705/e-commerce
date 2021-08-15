// Refer to https://api.jquery.com/category/events/ for list of events, but it's mixed with other stuff as well
$(document).on('click', '#toggle-title', function(e) {
	e.preventDefault();
	var target = $('.title');

	if (target.is(':visible'))
		target.hide();
	else if (target.is(':hidden'))
		target.show();
});

