<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_paciente_agresor_violencia
* Plataforma	: !PHP
* Creacion		: 08/03/2017
* @name			DAOPacienteAgresorViolencia.php
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

class DAOPacienteAgresorViolencia extends Model{

    protected $_tabla			= "pre_paciente_agresor_violencia";
    protected $_primaria		= "id_violencia";
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
						*
					FROM pre_paciente_agresor_violencia 
					WHERE id_paciente = ".$id_paciente;

		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }
	
	public function getByIdPacientePregunta($id_paciente,$id_pregunta){
        $query	= "	SELECT 
						*
					FROM pre_paciente_agresor_violencia 
					WHERE	id_paciente = ".$id_paciente."
				    AND	id_pregunta = ".$id_pregunta;

		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }
    
	public function insertViolencia($id_paciente, $id_pregunta, $valor){
        $query	= "	INSERT INTO pre_paciente_agresor_violencia 
								(
									id_paciente,
									id_pregunta,
									nr_valor
								)
							VALUES
								(
									".$id_paciente.",
									".$id_pregunta.",
									".$valor."	
								)
					";

        if ($this->db->execQuery($query)) {
			return $this->db->getLastId();
        } else {
            return NULL;
        }
    }
	
	public function updateViolencia($id_paciente, $id_pregunta, $valor){
        $query	= "	UPDATE pre_paciente_agresor_violencia 
					SET	nr_valor =	".$valor."
					WHERE id_paciente = ".$id_paciente." AND id_pregunta = ".$id_pregunta."";

        if ($this->db->execQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
}

?>