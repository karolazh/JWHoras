<?php

class DAOComuna extends Model{

    /**
     * @var string 
     */
    protected $_tabla = "tab_comunas";
    protected $_primaria = "com_id";
    
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
    
    /*** 20170131 - Funcion obtiene datos de una comuna ***/
    public function getComuna($cod_comuna){
        $query = "select * from tab_comunas 
                  where com_id = ?";

        $consulta = $this->db->getQuery($query,array($cod_comuna));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    /*
     * 20170203 - Lista Comunas
     */
    public function getListaComunas($id_provincia){
        $query = "select * from tab_comunas 
                  where com_pro_id = ?";

        $resultado = $this->db->getQuery($query,array($id_provincia));
        
        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}