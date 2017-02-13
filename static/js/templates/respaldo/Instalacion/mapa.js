$("#mapa_ubicacion").ready(function(){
	var map;
	
	function initialize() {
		
	var Lat = $("#txtLatitud").val();
	var Lng = $("#txtLongitud").val();

	
	var myLatlng = new google.maps.LatLng(Lat,Lng);
	var mapOptions = 	{
							zoom: 17,
							center: myLatlng
						}
	var map = new google.maps.Map(document.getElementById('mapa_ubicacion'), mapOptions);

	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title: 'Instalación'
	})
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);	
});


