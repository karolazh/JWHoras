<?php
include('config.php');

$type = $_POST['type'];

	$events = array();
	$query = mysqli_query($con, "SELECT * FROM tbl_feriados");
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)){
	$e = array();
	
   // $e['id']    = $fetch['id_dia_feriado'];
    $e['feriado'] = $fetch['fecha_feriado'];
	$e['holiday'] = $fetch['holiday'];
  
    /*
	$allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;
    */
    array_push($events, $e);
	}
	echo json_encode($events);
?>	