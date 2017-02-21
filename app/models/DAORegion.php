<?php

class DAORegion extends Model{

    protected $_tabla			= "pre_regiones";
    protected $_primaria		= "id_region";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();
    }
    
    /*** 20170131 - Funcion obtiene datos de una región ***/
    public function getRegion($cod_region){
		$query	= "	SELECT * 
					FROM ".$this->_tabla."
					WHERE id_region = ?";

		$params		= array($cod_region);
        $consulta	= $this->db->getQuery($query,$params);
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*
     * 20170203 - Lista Regiones
     */
    public function getListaRegiones(){
        $query		= $this->db->select("*")->from($this->_tabla);
        $resultado	= $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    public function obtComunasPorRegion($region){
		$query	= "	SELECT 
						comunas.gl_nombre_comuna,
						comunas.id_comuna 
					FROM pre_comunas comunas
						LEFT JOIN pre_provincias prov ON comunas.id_provincia = prov.id_provincia
						LEFT JOIN pre_regiones reg ON prov.id_region = reg.id_region
					WHERE reg.id_region = ?";

		$params	= array($region);
		return $this->db->getQuery($query,$params);
    }
}