    $(document).ready(function() {
		
	$.ajax({
		url: BASE_URI + "static/template/plugins/fullCalendar/process.php",
        type: 'POST', // Send post data
        data: 'type=fetch',
        async: false,
        success: function(s){
        	json_events = s;
        }
	});
	
	
	
	//console.lod(data);
	var currentMousePos = {
	    x: -1,
	    y: -1
	};
		jQuery(document).on("mousemove", function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });
	
	$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
		});
        
        $('#calendar').fullCalendar({
			
			navLinks: true, // can click day/week names to navigate views
			weekNumbers: true,
			weekNumbersWithinDays: true,
			 weekNumbers: true,
			weekNumberCalculation: 'ISO',

			events: JSON.parse(json_events),
			utc: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'

			},
			editable: true,
			droppable: true, 
			slotDuration: '00:30:00',
			
			viewRender: function(view,element){	
				
				$.ajax({
					url: BASE_URI + "static/template/plugins/fullCalendar/process.php",
					type: 'POST',
					data: 'type=feriados',
					async: false,
					success: function (data){
						    $.each(JSON.parse(data), function(i, item){
							$fer = item.feriado;
							  if(!$fer){
									$("a.fc-day-number").css("color","red");
								}else{
									$("a.fc-day-number").css("color","blue");
								}						
						  });						  
					}
				});
			},			
			
			eventReceive: function(event){
				var title = event.title;
				var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
				$.ajax({
		    		url: BASE_URI + "static/template/plugins/fullCalendar/process.php",
		    		data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
		    		type: 'POST',
		    		dataType: 'json',
		    		success: function(response){
		    			event.id = response.eventid;
		    			$('#calendar').fullCalendar('updateEvent',event);
		    		},
		    		error: function(e){
		    			console.log(e.responseText);
		    		}
		    	});
				$('#calendar').fullCalendar('updateEvent',event);
				console.log(event);
			},
			eventClick: function(calEvent, jsEvent, view) {
				alert('Actividad : ' + calEvent.title);
				//change the border color just for fun
				//$(this).css('border-color', 'red');
			},
			eventDrop: function(event, delta, revertFunc) {
		        var title = event.title;
		        var start = event.start.format();
		        var end = (event.end == null) ? start : event.end.format();
		        $.ajax({
					url: BASE_URI + "static/template/plugins/fullCalendar/process.php",
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')		    				
						revertFunc();
					},
					error: function(e){		    			
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    }
			/*,
			
			evento para modificar el nombre del evento
		    eventClick: function(event, jsEvent, view) {
		    	console.log(event.id);
		          var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
		          if (title){
		              event.title = title;
		              console.log('type=changetitle&title='+title+'&eventid='+event.id);
		              $.ajax({
				    		url: BASE_URI + "static/template/plugins/fullCalendar/process.php",
				    		data: 'type=changetitle&title='+title+'&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){	
				    			if(response.status == 'success')			    			
		              				$('#calendar').fullCalendar('updateEvent',event);
				    		},
				    		error: function(e){
				    			alert('Error processing your request: '+e.responseText);
				    		}
				    	});
		          }
			}*/,
			eventResize: function(event, delta, revertFunc) {
				console.log(event);
				var title = event.title;
				var end = event.end.format();
				var start = event.start.format();
		        $.ajax({
					url: BASE_URI + "static/template/plugins/fullCalendar/process.php",
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')		    				
						revertFunc();
					},
					error: function(e){		    			
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
			eventAfterRender: function (event, element, view) {
				
				var id_tipo_actividad = event.id_tipo_actividad;
				
				if (event.id_tipo_actividad == 1) {					
					element.css('background-color', '#BF2727');
				} else if (event.id_tipo_actividad == 2) {					
					element.css('background-color', '#17B2D1');
				} else if (event.id_tipo_actividad == 3) {					
					element.css('background-color', '#D18D17');
				} else if (event.id_tipo_actividad == 4) {					
					element.css('background-color', '#7717D1');
				}
			},			
			eventDragStop: function (event, jsEvent, ui, view) {
			    if (isElemOverDiv()) {
			    	var con = confirm('Are you sure to delete this event permanently?');
			    	if(con == true) {
						$.ajax({
				    		url: BASE_URI + "static/template/plugins/fullCalendar/process.php",
				    		data: 'type=remove&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){
				    			console.log(response);
				    			if(response.status == 'success'){
				    				$('#calendar').fullCalendar('removeEvents');
            						getFreshEvents();
            					}
				    		},
				    		error: function(e){	
				    			alert('Error processing your request: '+e.responseText);
				    		}
			    		});
					}   
				}
			}
           
        });
		
	function getFreshEvents(){
		$.ajax({
			url: BASE_URI + "static/template/plugins/fullCalendar/process.php",
	        type: 'POST', // Send post data
	        data: 'type=fetch',
	        async: false,
	        success: function(s){
	        	freshevents = s;
	        }
		});
		$('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
	}
	
	function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }
        
 });
