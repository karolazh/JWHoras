<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_cie10_3_grupo
* Plataforma	: !PHP
* Creacion		: 21/03/2017
* @name			DAOCie10Grupo.php
* @version		1.0
* @author		David Guzmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<david.guzman@cosof.cl>	22/03/2017	DAOCie10Grupo
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOCie10Grupo extends Model{

    protected $_tabla           = "pre_cie10_3_grupo";
    protected $_primaria		= "id_grupo";
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

	public function getDetalleByIdGrupo($id_grupo){
		$query	= "	SELECT 
						c.*
					FROM pre_cie10_3_grupo g
						LEFT JOIN pre_cie10_4 c ON g.id_grupo = c.id_grupo
					WHERE g.id_grupo = ?";

		$param	= array($id_grupo);
        $resul	= $this->db->getQuery($query,$param);

        if($resul->numRows > 0){
            return $resul->rows;
        }else{
            return NULL;
        }
    }
	
}

?>