	$(document).ready(function() {
        
        var arrAgenda = $('#arrAgenda').val();
        arrAgenda = arrAgenda.substring(0,arrAgenda.length-1);
        var arrayAgenda = arrAgenda.split(';');
        var agenda = new Array();
        
        for (var i=0; i<arrayAgenda.length; i++) {
            var subarrAgenda = arrayAgenda[i].split(',');
            var titulo = subarrAgenda[0];
            var fecha = "";
            if (subarrAgenda[2] == "") {
                fecha = subarrAgenda[1];
            } else {
                fecha = subarrAgenda[1].toString() + 'T' + 
                        subarrAgenda[2].toString();
            }
            agenda[i] = { title: titulo, start: fecha };
        }
        //alert(arrAgenda);
        //alert(agenda);
        
        $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month, agendaWeek, agendaDay, listWeek'
			},
			//defaultDate: fecha, //'2017-03-15',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
            events: agenda
//			events: [
//				{
//					title: 'All Day Event',
//					start: '2017-03-016'
//				},
//				{
//					title: 'Long Event',
//					start: '2017-03-07',
//					end: '2017-03-10'
//				},
//				{
//					id: 999,
//					title: 'Repeating Event',
//					start: '2017-03-09T16:00:00'
//				},
//				{
//					id: 999,
//					title: 'Repeating Event',
//					start: '2017-03-16T16:00:00'
//				},
//				{
//					title: 'Conference',
//					start: '2017-03-13',
//					end: '2017-03-15'
//				},
//				{
//					title: 'Meeting',
//					start: '2017-03-12T10:30:00',
//					end: '2017-03-12T12:30:00'
//				},
//				{
//					title: 'Lunch',
//					start: '2017-03-12T12:00:00'
//				},
//				{
//					title: 'Meeting',
//					start: '2017-03-12T14:30:00'
//				},
//				{
//					title: 'Happy Hour',
//					start: '2017-03-12T17:30:00'
//				},
//				{
//					title: 'Dinner',
//					start: '2017-03-12T20:00:00'
//				},
//				{
//					title: 'Birthday Party',
//					start: '2017-03-13T07:00:00'
//				},
//				{
//					title: 'Click for Google',
//					url: 'http://google.com/',
//					start: '2017-03-28'
//				}
//			]
		});
		
	});