$("#gl_tipo_riesgo").on('change', function (e) {
	if ($('#gl_tipo_riesgo').val()==1) {
            $('#gl_tipo_riesgo').css("borderColor", "");
            $('#gl_tipo_riesgo').css("borderColor", "#BDB76B");
        } else if ($('#gl_tipo_riesgo').val()==2){
            $('#gl_tipo_riesgo').css("borderColor", "");
            $('#gl_tipo_riesgo').css("borderColor", "#CD853F");
        } else if ($('#gl_tipo_riesgo').val()==3){
            $('#gl_tipo_riesgo').css("borderColor", "");
            $('#gl_tipo_riesgo').css("borderColor", "#FF0000");
        } else if ($('#gl_tipo_riesgo').val()==4){
           $('#gl_tipo_riesgo').css("borderColor", "");
            $('#gl_tipo_riesgo').css("borderColor", "#FF0000"); 
        } else if ($('#gl_tipo_riesgo').val()==0){
            $('#gl_tipo_riesgo').css("borderColor", ""); 
        }
});