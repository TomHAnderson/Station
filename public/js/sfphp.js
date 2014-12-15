$(function() {
	$('.btn-danger').on('click', function(event) {
		return confirm('Are you sure?');
	});
});