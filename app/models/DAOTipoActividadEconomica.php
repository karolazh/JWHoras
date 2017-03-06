<?php

class DAOTipoActividadEconomica extends Model{

    protected $_tabla			= "pre_tipo_actividad_economica";
    protected $_primaria		= "id_actividad_economica";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();
    }
    
    /*** 20170131 - Funcion obtiene datos de una región ***/
    public function getTipoActividadEconomica($id_actividad_economica){
		$query	= "	SELECT * 
					FROM ".$this->_tabla."
					WHERE id_actividad_economica = ?";

	$params		= array($id_actividad_economica);
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
    public function getLista(){
        $query		= $this->db->select("*")->from($this->_tabla);
        $resultado	= $query->getResult();

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}