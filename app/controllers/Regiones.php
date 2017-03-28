<?php

/**
******************************************************************************
* Sistema			: PREVENCION DE FEMICIDIOS
* Descripcion		: Controller para Region
* Plataforma		: !PHP
* Creacion			: 14/02/2017
* @name             Paciente.php
* @version			1.0
* @author			Carolina Zamora <carolina.zamora@cosof.cl>
* =============================================================================
* !ControlCambio
* --------------
* !cProgramador				!cFecha		!cDescripcion 
* -----------------------------------------------------------------------------
*
* -----------------------------------------------------------------------------
*******************************************************************************
*/

class Regiones extends Controller{

	protected $_DAORegion;
	
	function __construct(){
		parent::__construct();
		$this->load->lib('Fechas', false);
		$this->_DAORegion = $this->load->model('DAORegion');
	}

    /**
	 * Descripción: Carga comunas por región
	 * @author: S/N
	 */
    public function cargarComunasPorRegion(){
		$region		= $_POST['region'];
		$comunas	= $this->_DAORegion->getDetalleByIdRegion($region);
		$json		= array();
		$i			= 0;
		foreach($comunas as $comuna){
			$json[$i]['id_comuna'] = $comuna->id_comuna;
			$json[$i]['nombre_comuna'] = $comuna->gl_nombre_comuna;
			$i++;
		}

		echo json_encode($json);
    }
}