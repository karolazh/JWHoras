<?php 

class DAOTipoDocumentos extends Model {

	function __construct(){
		parent::__construct();
	}


	public function getListado(){
		$query = 'select * from tipo_documento order by id_tipodocumento';
		$consulta = $this->db->getQuery($query);

		return $consulta->rows;
	}
}