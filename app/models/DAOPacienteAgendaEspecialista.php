<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_paciente_agenda_especialista
* Plataforma	: !PHP
* Creacion		: 09/03/2017
* @name			DAOPacienteAgendaEspecialista.php
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

class DAOPacienteAgendaEspecialista extends Model{

    protected $_tabla			= "pre_paciente_agenda_especialista";
    protected $_primaria		= "id_agenda_especialista";
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
						agenda.*,
						e.gl_nombre_especialidad
					FROM pre_paciente_agenda_especialista agenda
						LEFT JOIN pre_tipo_especialidad e ON e.id_tipo_especialidad = agenda.id_tipo_especialidad
					WHERE id_paciente = ?";

		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

	public function insert($parametros){
        $query	= "	INSERT INTO pre_paciente_agenda_especialista
						(
						id_especialista,
						id_paciente,
						id_empa,
						id_estado,
						cie10,
						cie102,
						cie103,
						gl_observacion,
						gl_diagnostico,
						id_tipo_especialidad,
						fecha_especialista,
						fc_crea,
						id_usuario_crea
						)
					VALUES
						(
						".$_SESSION['id'].",
						".$parametros['id_paciente'].",
						".$parametros['id_empa'].",
						".$parametros['id_estado'].",
						".$parametros['cie10'].",
						".$parametros['cie102'].",
						".$parametros['cie103'].",
						".$parametros['gl_observacion'].",
						".$parametros['gl_diagnostico'].",
						".$parametros['id_tipo_especialidad'].",
						now(),
						now(),
						".$_SESSION['id']."
						)
                    ";
        if ($this->db->execQuery($query)) {
            return $this->db->getLastId();
        } else {
            return NULL;
        }
    }
	
}

?>