	$(document).ready(function() {
        
        var agenda = new Array();
        var arrAgenda = $('#arrAgenda').val();
        
        if (arrAgenda != "") {
            arrAgenda = arrAgenda.substring(0,arrAgenda.length-1);
            var arrayAgenda = arrAgenda.split(';');

            for (var i=0; i<arrayAgenda.length; i++) {
                var subarrAgenda= arrayAgenda[i].split(',');
                var titulo		= subarrAgenda[0];
                var id			= subarrAgenda[4];
                var fecha		= "";

                if (subarrAgenda[2] == "") {
                    fecha = subarrAgenda[1];
                } else {
                    fecha = subarrAgenda[1].toString() + 'T' + 
                            subarrAgenda[2].toString();
                }
                agenda[i] = { title: titulo, start: fecha, url: BASE_URI + "index.php/Especialista/ver/"+id };
            }
        }
        
        $('#calendarEspecialista').fullCalendar({
			header: {
				left	: 'prev,next today',
				center	: 'title',
				right	: 'month, listWeek'
			},
			navLinks	: true,
			height		: 650,
			editable	: false,
			eventLimit	: true,
            events		: agenda,
			eventClick	: function(event) {
				if (event.url) {
					xModal.open(event.url, 'Agenda Especialista', 85);
					return false;
				}
			}
		});
        
        $('#calendarEditar').fullCalendar({
			header		: {
				left	: 'prev,next today',
				center	: 'title',
				right	: 'month, listWeek'
			},
			navLinks	: true,
			height		: 650,
			editable	: true,
			eventLimit	: true,
            events		: agenda,
			eventClick	: function(event) {
				if (event.url) {
					xModal.open(event.url, 'Agenda Especialista', 85);
					return false;
				}
			},
			eventDrop: function(event, delta, revertFunc) {
				// add ajax con Guardado, Envio de Email y Evento
				alert(event.title + " was dropped on " + event.start.format());
				if (!confirm("Are you sure about this change?")) {
					revertFunc();
				}

			}
		});

	});