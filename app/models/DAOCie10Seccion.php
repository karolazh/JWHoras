<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_cie10_seccion
* Plataforma	: !PHP
* Creacion		: 21/03/2017
* @name			DAOCie10Seccion.php
* @version		1.0
* @author		David Guzmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<david.guzman@cosof.cl>	21/03/2017	DAOCie10Seccion
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOCie10Seccion extends Model{

    protected $_tabla           = "pre_cie10_2_seccion";
    protected $_primaria		= "id_seccion";
    protected $_transaccional	= false;

    function __construct()
    {
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

    public function getById($id){
        $query	= "	SELECT * FROM ".$this->_tabla."
					WHERE ".$this->_primaria." = ?";

		$param	= array($id);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }
	
	public function getDetalleByIdSeccion($id_seccion){
		$query	= "	SELECT 
						g.*
					FROM pre_cie10_2_seccion s
						LEFT JOIN pre_cie10_3_grupo g ON s.id_seccion = g.id_seccion
					WHERE s.id_seccion = ?";

		$param	= array($id_seccion);
        $resul	= $this->db->getQuery($query,$param);

        if($resul->numRows > 0){
            return $resul->rows;
        }else{
            return NULL;
        }
    }

}

?>