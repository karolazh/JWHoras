<?php

class DAOTipoCompra extends Model {

	function __construct(){
		parent::__construct();
	}


	public function getListado(){
		$query = "select * from tipo_compra order by id_tipocompra";
		$consulta = $this->db->getQuery($query);

		return $consulta->rows;
	}
}