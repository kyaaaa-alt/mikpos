

// __________MODAL
// showing modal with effect
$('.modal-effect').on('click', function(e) {
	e.preventDefault();
	var effect = $(this).attr('data-effect');
	$('#modaldemo8').addClass(effect);
});

// hide modal with effect
$('#modaldemo8').on('hidden.bs.modal', function(e) {
	$(this).removeClass(function(index, className) {
		return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
	});
});