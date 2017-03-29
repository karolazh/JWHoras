<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_paciente_agenda_especialista
* Plataforma        : !PHP
* Creacion          : 09/03/2017
* @name             DAOPacienteAgendaEspecialista.php
* @version          1.0
* @author           Victor Retamal <victor.retamal@cosof.cl>
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

    /**
	 * Descripción : Obtiene Paciente-Agenda-Especialista por Id de Paciente
	 * @author  David Guzmán <david.guzman@cosof.cl>
     * @param   int $id_paciente
	 */
    public function getByIdPaciente($id_paciente){
        $query = "  SELECT 
						agenda.*,
						e.gl_nombre_especialidad
					FROM pre_paciente_agenda_especialista agenda
					LEFT JOIN pre_tipo_especialidad e ON e.id_tipo_especialidad = agenda.id_tipo_especialidad
					WHERE agenda.bo_activo = 1
					AND agenda.id_paciente = ?";

		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene Plan de Tratamiento por Id de Paciente
	 * @author  Victor Retamal <victor.retamal@cosof.cl>
     * @param   int $id_paciente
	 */
    public function getPlan($id_paciente,$id_tipo_especialidad=0){
        $query	= "  SELECT 
						agenda.*,
						e.gl_nombre_especialidad
					FROM pre_paciente_agenda_especialista agenda
					LEFT JOIN pre_tipo_especialidad e ON e.id_tipo_especialidad = agenda.id_tipo_especialidad
					WHERE agenda.bo_activo = 1
					AND agenda.id_paciente = ?";
		
		if($id_tipo_especialidad != 0){
			$query	.= ' AND agenda.id_tipo_especialidad = 1';
		}

		$param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Inserta en tabla "pre_paciente_agenda_especialista"
	 * @author  David Guzmán <david.guzman@cosof.cl>
     * @param   array   $parametros
	 */
	public function insertAgenda($parametros){
		//id_estado = 3 (Finalizado)
        $query	= "	INSERT INTO pre_paciente_agenda_especialista (
						id_especialista,
						id_paciente,
						id_empa,
						id_estado,
						id_cie10_capitulo,
						id_cie10_seccion,
						id_cie10_grupo,
						id_cie10,
						gl_observacion_diagnostico,
						gl_diagnostico,
						id_tipo_especialidad,
						fc_crea,
						id_usuario_crea
					) VALUES (
						".$_SESSION['id'].",
						".$parametros['id_paciente'].",
						".$parametros['id_empa'].",
						3,
						".$parametros['capitulo_cie10'].",
						".$parametros['seccion_cie10'].",
						".$parametros['grupo_cie10'].",
						".$parametros['cie10'].",
						'".$parametros['gl_observacion']."',
						'".$parametros['gl_diagnostico']."',
						(SELECT ue.id_tipo_especialidad FROM pre_usuario_especialidad ue WHERE ue.id_usuario = ".$_SESSION['id']."),
						now(),
						".$_SESSION['id']."
						)
                    ";
        if ($this->db->execQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	/**
	 * Descripción : Inserta en tabla "pre_paciente_agenda_especialista"
	 * @author  David Guzmán <david.guzman@cosof.cl>
     * @param   array   $parametros
	 */
	public function insertReAgendar($parametros){
		
        $query	= "	INSERT INTO pre_paciente_agenda_especialista
						(
						id_especialista,
						id_paciente,
						id_empa,
						fecha_agenda,
						hora_agenda,
						gl_agenda_observacion,
						id_tipo_especialidad,
						fc_crea,
						id_usuario_crea
						)
					VALUES
						(
						".$_SESSION['id'].",
						".$parametros['id_paciente'].",
						".$parametros['id_empa'].",
						".Fechas::formatearBaseDatos(str_replace("'","",$parametros['fc_toma'])).",
						'".$parametros['gl_hora_toma']."',
						'".$parametros['gl_agenda_observacion']."',
						(SELECT ue.id_tipo_especialidad FROM pre_usuario_especialidad ue WHERE ue.id_usuario = ".$_SESSION['id']."),
						now(),
						".$_SESSION['id']."
						)";
        
        if ($this->db->execQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	/**
	 * Descripción : Update en tabla "pre_paciente_agenda_especialista"
	 * @author  David Guzmán <david.guzman@cosof.cl>
     * @param   array   $parametros
	 */
	public function updateReAgendar($parametros){
		
		$query	= "	UPDATE pre_paciente_agenda_especialista SET
						id_estado						= 4,
						bo_activo						= 0,
						id_usuario_actualiza			= ".$_SESSION['id'].",
						fc_actualiza					= now()
					WHERE id_tipo_especialidad = ".$parametros['id_tipo_especialidad']."
                    ";

        if($this->db->execQuery($query)) {
            return TRUE;
        }else{
            return FALSE;
        }
	}
	
	/**
	 * Descripción: Obtiene exámenes por Id de Especialista
	 * @author David Guzmán <david.guzman@cosof.cl>
     * @param  int   $id_especialista
	 */
    public function getAllByIdEspecialista($id_especialista){
        $query = "  SELECT 
                        esp.*,
						tipoesp.gl_nombre_especialidad AS gl_especialidad,
						pac.gl_nombres AS gl_nombres_paciente,
						pac.gl_apellidos AS gl_apellidos_paciente,
						u.gl_nombres AS gl_nombres_especialista,
						u.gl_apellidos AS gl_apellidos_especialista,
						date_format(esp.fecha_agenda,'%d-%m-%Y') AS fecha_agenda,
						date_format(esp.fecha_agenda,'%Y-%m-%d') AS fecha_agenda_calendar,
						date_format(esp.fecha_diagnostico,'%d-%m-%Y') AS fecha_diagnostico,
						date_format(esp.fc_crea,'%d-%m-%Y') AS fc_crea,
						IF(pac.bo_extranjero=1,pac.gl_run_pass,pac.gl_rut) AS gl_identificacion
                    FROM pre_paciente_agenda_especialista esp
                    LEFT JOIN pre_tipo_especialidad tipoesp ON tipoesp.id_tipo_especialidad = esp.id_tipo_especialidad
					LEFT JOIN pre_paciente pac ON pac.id_paciente = esp.id_paciente
					LEFT JOIN pre_usuario u ON u.id_usuario = esp.id_especialista
                    WHERE esp.id_especialista = ?
					AND	 esp.bo_activo = 1";

        $param	= array($id_especialista);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows > 0) {
            return $result->rows;
        }else{
            return NULL;
        }
    }
	
	/**
	 * Descripción: Obtiene exámenes por Id de Paciente
	 * @author David Guzmán <david.guzman@cosof.cl>
     * @param  int   $id_paciente
	 */
    public function getAllByIdPaciente($id_paciente){
        $query = "  SELECT 
                        esp.*,
						tipoesp.gl_nombre_especialidad AS gl_especialidad,
						pac.gl_nombres AS gl_nombres_paciente,
						pac.gl_apellidos AS gl_apellidos_paciente,
						u.gl_nombres AS gl_nombres_especialista,
						u.gl_apellidos AS gl_apellidos_especialista,
						date_format(esp.fecha_agenda,'%d-%m-%Y') AS fecha_agenda,
						date_format(esp.fecha_agenda,'%Y-%m-%d') AS fecha_agenda_calendar,
						date_format(esp.fecha_diagnostico,'%d-%m-%Y') AS fecha_diagnostico,
						date_format(esp.fc_crea,'%d-%m-%Y') AS fc_crea,
						IF(pac.bo_extranjero=1,pac.gl_run_pass,pac.gl_rut) AS gl_identificacion
                    FROM pre_paciente_agenda_especialista esp
                    LEFT JOIN pre_tipo_especialidad tipoesp ON tipoesp.id_tipo_especialidad = esp.id_tipo_especialidad
					LEFT JOIN pre_paciente pac ON pac.id_paciente = esp.id_paciente
					LEFT JOIN pre_usuario u ON u.id_usuario = esp.id_especialista
                    WHERE esp.id_paciente = ?
					AND	esp.bo_activo = 1
					AND	esp.id_cie10 IS NULL";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows > 0) {
            return $result->rows;
        }else{
            return NULL;
        }
    }
	
}

?>