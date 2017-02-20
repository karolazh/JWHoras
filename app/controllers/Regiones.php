<?php


class Regiones extends Controller{


	protected $_DAORegiones;
	
	function __construct(){
		parent::__construct();
		
		$this->_DAORegiones = $this->load->model('DAORegion');
                $this->_DAOComuna = $this->load->model("DAOComuna");

}

    public function cargarComunasPorRegion(){
            $region = $_POST['region'];

            $daoRegion = $this->load->model('DAORegion');
            $comunas = $daoRegion->obtComunasPorRegion($region)->rows;

            $json = array();
            $i = 0;
            foreach($comunas as $comuna){
                    $json[$i]['id_comuna'] = $comuna->com_id;
                    $json[$i]['nombre_comuna'] = $comuna->com_nombre;
                    $i++;
            }

            echo json_encode($json);
    }
	
}	