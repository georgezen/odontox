$(document).on('keyup', '.numeric', function(event) {
	event.preventDefault();
	var numerico = $(this).val();
	if (isNaN(numerico)) {
		toastr.error("Ingrese números");
		$(this).val('');
	}
});

