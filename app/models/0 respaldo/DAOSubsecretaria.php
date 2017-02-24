<?php

class DAOSubsecretaria extends Model {

	function __construct(){
		parent::__construct();
	}


	public function getListado(){
		$query = "select * from subsecretaria order by id_subsecretaria";
		$consulta = $this->db->getQuery($query);

		return $consulta->rows;
	}
}