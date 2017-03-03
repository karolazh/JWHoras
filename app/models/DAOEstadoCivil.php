<?php

class DAOEstadoCivil extends Model{

    protected $_tabla			= "pre_tipo_estado_civil";
    protected $_primaria		= "id_tipo_estado_civil";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();
    }
    
    /*** 20170131 - Funcion obtiene datos de una región ***/
    public function getTipoOcupacion($id_tipo_estado_civil){
		$query	= "	SELECT * 
					FROM ".$this->_tabla."
					WHERE id_tipo_estado_civil = ?";

	$params		= array($id_tipo_estado_civil);
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
    public function getListaTipoEstadoCivil(){
        $query		= $this->db->select("*")->from($this->_tabla);
        $resultado	= $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}