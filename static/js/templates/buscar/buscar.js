
$("#region").on('change', function (e) {
	if ($('#bool_region').val() == 1) {
		$("#region option[value="+$('#reg').val()+"]").prop('selected',true);
	}
});