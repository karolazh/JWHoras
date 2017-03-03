<?php

class DAOTipoEscolaridad extends Model{

    protected $_tabla			= "pre_tipo_escolaridad";
    protected $_primaria		= "id_tipo_escolaridad";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();
    }
    
    /*** 20170131 - Funcion obtiene datos de una región ***/
    public function getTipoEscolaridad($id_tipo_escolaridad){
		$query	= "	SELECT * 
					FROM ".$this->_tabla."
					WHERE id_tipo_escolaridad = ?";

	$params		= array($id_tipo_escolaridad);
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
    public function getListaTipoEscolaridad(){
        $query		= $this->db->select("*")->from($this->_tabla);
        $resultado	= $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}