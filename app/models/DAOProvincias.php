<?php

class DAOProvincias extends Model{

    protected $_tabla			= "pre_provincias";
    protected $_primaria		= "id_provincia";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();
    }
    
    /*** 20170131 - Funcion obtiene datos de una provincia ***/
    public function getProvincia($id_provincia){
		$query	= "	SELECT * 
					FROM ".$this->_tabla."
					WHERE id_provincia = ?";

		$params		= array($id_provincia);
        $consulta	= $this->db->getQuery($query,$params);

        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*
     * 20170203 - Lista Provincias
     */
    public function getListaProvincias($id_region){
        $query	= "	SELECT * 
					FROM ".$this->_tabla." 
					WHERE id_region = ?";

		$params		= array($id_region);
        $resultado	= $this->db->getQuery($query,$params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

}