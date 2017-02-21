<?php

class DAOProvincias extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "pre_provincias";
    protected $_primaria = "id_provincia";
    
    /**
     * @var boolean 
     */
    protected $_transaccional = false;
    
    /**
     * 
     */
    function __construct(){
        parent::__construct();
    }
    
    /*** 20170131 - Funcion obtiene datos de una provincia ***/
    public function getProvincia($id_provincia){
	$query = "select * from ".$this->_tabla."
                  where id_provincia = ?";

        $consulta = $this->db->getQuery($query,array($id_provincia));
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
        $query = "select * from ".$this->_tabla." 
                  where id_region = ?";

        $resultado = $this->db->getQuery($query,array($id_region));
        
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}