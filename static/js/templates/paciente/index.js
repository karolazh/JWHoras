
    $(".guardarReconoce").on('click', function(e) {
        var button_process	= buttonStartProcess($(this), e);
		var id_registro			= $(this).attr("data");
		
		$.ajax({
			dataType: "json",
			cache	:false,
			async	: true,
			data	: {id_registro:id_registro},
			type	: "post",
			url		: BASE_URI + "index.php/Registro/GuardarReconoce", 
			error	: function(xhr, textStatus, errorThrown){
						xModal.danger('Error: No se pudo guardar');
			},
			success	: function(data){
						if(data.correcto){
							xModal.success('Éxito: información guardada!');
							setTimeout(function() { location.href = BASE_URI + "index.php/Registro"; }, 2000);
						} else {
							xModal.info('Error:  No se pudo guardar');
						}
			}
		});
		buttonEndProcess(button_process);
    });