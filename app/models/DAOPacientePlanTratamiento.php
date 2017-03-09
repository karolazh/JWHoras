<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_paciente_plan_tratamiento
* Plataforma	: !PHP
* Creacion		: 09/03/2017
* @name			DAOPacientePlanTratamiento.php
* @version		1.0
* @author		Victor Retamal <victor.retamal@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOPacientePlanTratamiento extends Model{

    protected $_tabla			= "pre_paciente_plan_tratamiento";
    protected $_primaria		= "id_plan_tratamiento";
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

    public function getByIdPaciente($id_paciente){
        $query	= "	SELECT 
						plan.*,
						e.gl_nombre_especialidad
					FROM pre_paciente_plan_tratamiento plan
						LEFT JOIN pre_tipo_especialidad e ON e.id_tipo_especialidad = plan.id_tipo_especialidad
					WHERE id_paciente = ?";

		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

}

?>