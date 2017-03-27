<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_paciente_alarma
* Plataforma	: !PHP
* Creacion		: 27/03/2017
* @name			DAOPacienteAlarma.php
* @version		1.0
* @author		David Guzmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOPacienteAlarma extends Model{

    protected $_tabla			= "pre_paciente_alarma";
    protected $_primaria		= "id_alarma";
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
        $query	= "	SELECT	pa.*,
							pat.gl_nombre_alarma AS gl_tipo_alarma,
							pae.gl_nombre_alarma AS gl_estado_alarma,
							per.gl_nombre_perfil AS gl_nombre_perfil
					FROM pre_paciente_alarma pa
					LEFT JOIN pre_paciente_alarma_tipo pat ON pat.id_tipo_alarma = pa.id_alarma_tipo
					LEFT JOIN pre_paciente_alarma_estado pae ON pae.id_alarma_estado = pa.id_alarma_estado
					LEFT JOIN pre_perfil per ON per.id_perfil = pa.id_perfil
					WHERE	pa.bo_mostrar = 1
					AND		pa.id_paciente = ?";

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