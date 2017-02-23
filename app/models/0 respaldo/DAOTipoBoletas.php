<?php

class DAOTipoBoletas extends Model {

	protected $_tabla = "boleta";

    protected $_primaria = 'id_boleta';

	function __construct(){
		parent::__construct();
	}


	public function getListado(){
		$query = "select * from tipo_boleta order by id_tipo";
		$consulta = $this->db->getQuery($query);

		return $consulta->rows;
	}

	
}