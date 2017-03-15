<?php
include('config.php');

$type = $_POST['type'];

if($type == 'new'){
	$startdate = $_POST['startdate'].'+'.$_POST['zone'];
	$title = $_POST['title'];
	$insert = mysqli_query($con,"INSERT INTO calendar(`title`, `startdate`, `enddate`, `allDay`) VALUES('$title','$startdate','$startdate','false')");
	$lastid = mysqli_insert_id($con);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));
}

if($type == 'changetitle'){
	$eventid = $_POST['eventid'];
	$title   = $_POST['title'];
	$update  = mysqli_query($con,"UPDATE tbl_actividad SET actividad='$title' where id_actividad='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'resetdate'){
	$title     = $_POST['title'];
	$startdate = $_POST['start'];
	$enddate   = $_POST['end'];
	$eventid   = $_POST['eventid'];
	$update = mysqli_query($con,"UPDATE tbl_actividad SET actividad='$title', fecha_desde = '$startdate', fecha_hasta = '$enddate' where id_actividad='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'remove'){
	$eventid = $_POST['eventid'];
	$delete = mysqli_query($con,"DELETE FROM calendar where id='$eventid'");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'fetch'){
	$events = array();
	$query = mysqli_query($con, "SELECT * FROM tbl_actividad");
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)){
	$e = array();
	
    $e['id']    = $fetch['id_actividad'];
    $e['title'] = $fetch['actividad'];
    $e['start'] = $fetch['fecha_desde'];
    $e['end']   = $fetch['fecha_hasta'];
	$e['id_tipo_actividad']   = $fetch['id_tipo_actividad'];

    $allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;

    array_push($events, $e);
	}
	echo json_encode($events);
}

if($type == 'feriados'){
	$events = array();
	$query = mysqli_query($con, "SELECT * FROM tbl_feriados");
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)){
	$e = array();
	
   // $e['id']    = $fetch['id_dia_feriado'];
    $e['feriado'] = $fetch['fecha_feriado'];
	//$e['holiday'] = $fetch['holiday'];
  
    /*
	$allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;
    */
    array_push($events, $e);
	}
	echo json_encode($events);
}


?>