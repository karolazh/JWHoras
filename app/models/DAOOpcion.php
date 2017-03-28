<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_opcion
* Plataforma        : !PHP
* Creacion          : 06/05/2017
* @name             DAOOpcion.php
* @version          1.0
* @author           Orlando Vazquez <orlando.vazquez@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOOpcion extends Model {

    protected $_tabla			= "pre_opcion";
    protected $_primaria		= "id_opcion";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();       
    }

	public function getLista(){
        $query	= "	SELECT * FROM ".$this->_tabla;
        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }
	
    public function getById($id_opcion){
        $query	= "	SELECT * FROM ".$this->_tabla."
					WHERE ".$this->_primaria." = ?";

		$param	= array($id_opcion);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return null;
        }
    }
	
    /**
	 * Descripción : Obtiene Opción Raiz
	 * @author S/N
	 */
	public function getAllOpcionRaiz(){
        $query = "  SELECT *
					FROM pre_opcion
					WHERE bo_activo = 1 AND id_opcion_padre = 0";

        $result = $this->db->getQuery($query);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return null;
        }
    }
	
    /**
	 * Descripción : Obtiene Opción Rama
	 * @author S/N
	 */
	public function getAllOpcionRama(){
        $query = "  SELECT *
					FROM pre_opcion
					WHERE bo_activo = 1 AND id_opcion_padre != 0";

        $result	= $this->db->getQuery($query);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return null;
        }
    }
}

?>