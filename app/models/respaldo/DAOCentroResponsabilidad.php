<?php

class DAOCentroResponsabilidad extends Model {

	function __construct(){
		parent::__construct();
	}


	public function getListado($subsecretaria=null){
		if(is_null($subsecretaria)){
			$query = "select * from centro_responsabilidad order by nombre_centroresponsabilidad";
			$consulta = $this->db->getQuery($query);	
		}else{
			$query = "select * from centro_responsabilidad where subsecretaria_fk_centroresponsabilidad = ? order by nombre_centroresponsabilidad";
			$consulta = $this->db->getQuery($query,array($subsecretaria));
		}
		

		return $consulta->rows;
	}


}