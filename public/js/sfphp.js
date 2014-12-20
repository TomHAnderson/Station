$(function() {
	$('.btn-danger, a.confirm').on('click', function(event) {
		return confirm('Are you sure?');
	});
});