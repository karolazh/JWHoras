<?php


class Regiones extends Controller{


	protected $_DAORegiones;
	
	function __construct(){
		parent::__construct();
		
		$this->_DAORegiones = $this->load->model('DAORegiones');
}

public function cargarComunasPorRegion(){
		$region = $_POST['region'];

		$daoRegiones = $this->load->model('DAORegiones');
		$comunas = $daoRegiones->obtComunasPorRegion($region)->getRows();

		$json = array();
		$i = 0;
		foreach($comunas as $comuna){
			$json[$i]['id_comuna'] = $comuna->id_comuna;
			$json[$i]['nombre_comuna'] = $comuna->gl_nombre_comuna;
			$i++;
		}

		echo json_encode($json);
	}
	
}	