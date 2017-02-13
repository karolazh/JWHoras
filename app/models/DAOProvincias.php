<?php

class DAOProvincias extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "tab_provincias";
    protected $_primaria = "pro_id";
    
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
    public function getProvincia($cod_provincia){
	$query = "select * from tab_provincias 
                  where pro_id = ?";

        $consulta = $this->db->getQuery($query,array($cod_provincia));
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
        $query = "select * from tab_provincias 
                  where pro_reg_id = ?";

        $resultado = $this->db->getQuery($query,array($id_region));
        
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}