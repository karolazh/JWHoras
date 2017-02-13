<?php
class DAORegiones extends Model{

	function __construct(){
		parent::__construct();
	}

	//funcion sql obtProvinciasPorRegion
	public function obtProvinciasPorRegion($region){
		$query = "select * from tbl_provincias where id_region = ? order by nombre_provincias ASC";
		return $this->db->getQuery($query,array($region));
	}
	
	//funcion sql obtOficinasPorProvinciass
	public function obtOficinasPorProvincias($oficinas){
		$query = "SELECT * 
				  FROM tbl_provincias p
				  JOIN tbl_comunas c on c.id_provincias = p.id_provincia
				  JOIN tbl_oficinas_vs_comunas oc on oc.id_comuna = c.id_comunas
				  JOIN tbl_oficinas o on o.id_oficina = oc.id_oficina
				  WHERE p.id_provincia = ?
				  group by o.id_oficina
				  order by o.nombre_oficina ASC";
		return $this->db->getQuery($query,array($oficinas));
	}
}