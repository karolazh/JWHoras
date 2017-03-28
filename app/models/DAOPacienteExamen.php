<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_paciente_examen
* Plataforma        : !PHP
* Creacion          : 22/02/2017
* @name             DAOPacienteExamen.php
* @version          1.0
* @author           Carolina Zamora <carolina.zamora@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOPacienteExamen extends Model{

    protected $_tabla           = "pre_paciente_examen";
    protected $_primaria		= "id_paciente_examen";
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
            return null;
        }
    }

    /**
	 * Descripción : Obtiene exámenes por Id de Paciente desde 
     * "pre_paciente_examen" y desde "pre_empa" PAP y mamografía
	 * @author  Carolina Zamora <carolina.zamora@cosof.cl>  08-03-2017
     * @param   int $id_paciente
	 */
    public function getByIdPaciente($id_paciente){
        $query = "  SELECT 
                        examen.id_paciente_examen,
                        examen.id_tipo_examen,
                        examen.id_paciente,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        examen.gl_resultado_descripcion,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio,
                        date_format(examen.fc_toma,'%d-%m-%Y') AS fc_toma,
                        date_format(examen.fc_resultado,'%d-%m-%Y') AS fc_resultado,
                        examen.gl_hora_toma,
                        examen.gl_observacion_toma,
                        date_format(examen.fc_toma,'%Y-%m-%d') AS fc_toma_calendar,
                        date_format(examen.fc_resultado,'%Y-%m-%d') AS fc_resultado_calendar,
                        NULL AS fc_ultimo_pap_ano, 
                        NULL AS fc_ultimo_pap_mes
                    FROM pre_paciente_examen examen
                    LEFT JOIN pre_empa empa ON (empa.id_empa = examen.id_empa AND empa.bo_finalizado = 0)
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
                    LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio
                    WHERE examen.id_paciente = ". $id_paciente ."
                    UNION   
                    SELECT  0 AS id_paciente_examen,
                            6 AS id_tipo_examen,
                            empa.id_paciente,
                            empa.id_empa, 
                            0 AS id_laboratorio,
                            0 AS gl_folio,
                            'A' AS gl_resultado, 
                            'EXAMEN EXTERNO' as gl_resultado_descripcion,
                            NULL AS fc_crea,
                            tipo.gl_nombre_examen,
                            'SIN INFORMACION' as gl_nombre_laboratorio,
                            NULL AS fc_toma,
                            NULL AS fc_resultado,
                            NULL AS gl_hora_toma,
                            'SIN INFORMACION' as gl_observacion_toma,
                            NULL AS fc_toma_calendar,
                            NULL AS fc_resultado_calendar,
                            fc_ultimo_pap_ano, 
                            fc_ultimo_pap_mes
                    FROM pre_empa empa
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = 6
                    WHERE bo_pap_realizado = 1
                    AND bo_pap_resultado = 0
                    AND bo_pap_vigente = 1
                    AND bo_finalizado = 0
                    AND empa.id_paciente = ". $id_paciente ."
                    UNION   
                    SELECT  0 AS id_paciente_examen,
                            8 AS id_tipo_examen,
                            empa.id_paciente,
                            empa.id_empa, 
                            0 AS id_laboratorio,
                            0 AS gl_folio,
                            'A' AS gl_resultado, 
                            'EXAMEN EXTERNO' as gl_resultado_descripcion,
                            NULL AS fc_crea,
                            tipo.gl_nombre_examen,
                            'SIN INFORMACION' as gl_nombre_laboratorio,
                            NULL AS fc_toma,
                            NULL AS fc_resultado,
                            NULL AS gl_hora_toma,
                            'SIN INFORMACION' as gl_observacion_toma,
                            NULL AS fc_toma_calendar,
                            NULL AS fc_resultado_calendar,
                            fc_ultimo_pap_ano, 
                            fc_ultimo_pap_mes
                    FROM pre_empa empa
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = 8
                    WHERE bo_mamografia_realizada = 1
                    AND bo_mamografia_resultado_pasado = 0
                    AND bo_mamografia_vigente = 1
                    AND bo_finalizado = 0
                    AND empa.id_paciente = ". $id_paciente;
        
        $result	= $this->db->getQuery($query);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }

    /**
	 * Descripción: Función que trae exámenes de paciente con resultado "Alterado"
	 * @author Carolina Zamora <carolina.zamora@cosof.cl>
     * @param  int   $id_paciente
	 */
    public function getExamenAleradoByIdPaciente($id_paciente){
        $query = "  SELECT 
                        examen.id_paciente_examen,
                        examen.id_tipo_examen,
                        examen.id_paciente,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        examen.gl_resultado_descripcion,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio,
                        date_format(examen.fc_toma,'%d-%m-%Y') AS fc_toma,
                        date_format(examen.fc_resultado,'%d-%m-%Y') AS fc_resultado,
                        examen.gl_hora_toma,
                        examen.gl_observacion_toma,
                        date_format(examen.fc_toma,'%Y-%m-%d') AS fc_toma_calendar,
                        date_format(examen.fc_resultado,'%Y-%m-%d') AS fc_resultado_calendar,
                        NULL AS fc_ultimo_pap_ano, 
                        NULL AS fc_ultimo_pap_mes
                    FROM pre_paciente_examen examen
                    LEFT JOIN pre_empa empa ON (empa.id_empa = examen.id_empa AND empa.bo_finalizado = 0)
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
                    LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio
                    WHERE examen.id_paciente = ". $id_paciente ."
                    AND examen.gl_resultado = 'A'
                    UNION   
                    SELECT  0 AS id_paciente_examen,
                            6 AS id_tipo_examen,
                            empa.id_paciente,
                            empa.id_empa, 
                            0 AS id_laboratorio,
                            0 AS gl_folio,
                            'A' AS gl_resultado, 
                            'EXAMEN EXTERNO' as gl_resultado_descripcion,
                            NULL AS fc_crea,
                            tipo.gl_nombre_examen,
                            'SIN INFORMACION' as gl_nombre_laboratorio,
                            NULL AS fc_toma,
                            NULL AS fc_resultado,
                            NULL AS gl_hora_toma,
                            'SIN INFORMACION' as gl_observacion_toma,
                            NULL AS fc_toma_calendar,
                            NULL AS fc_resultado_calendar,
                            fc_ultimo_pap_ano, 
                            fc_ultimo_pap_mes
                    FROM pre_empa empa
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = 6
                    WHERE bo_pap_realizado = 1
                    AND bo_pap_resultado = 0
                    AND bo_pap_vigente = 1
                    AND bo_finalizado = 0
                    AND empa.id_paciente = ". $id_paciente ."
                    UNION   
                    SELECT  0 AS id_paciente_examen,
                            8 AS id_tipo_examen,
                            empa.id_paciente,
                            empa.id_empa, 
                            0 AS id_laboratorio,
                            0 AS gl_folio,
                            'A' AS gl_resultado, 
                            'EXAMEN EXTERNO' as gl_resultado_descripcion,
                            NULL AS fc_crea,
                            tipo.gl_nombre_examen,
                            'SIN INFORMACION' as gl_nombre_laboratorio,
                            NULL AS fc_toma,
                            NULL AS fc_resultado,
                            NULL AS gl_hora_toma,
                            'SIN INFORMACION' as gl_observacion_toma,
                            NULL AS fc_toma_calendar,
                            NULL AS fc_resultado_calendar,
                            fc_ultimo_pap_ano, 
                            fc_ultimo_pap_mes
                    FROM pre_empa empa
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = 8
                    WHERE bo_mamografia_realizada = 1
                    AND bo_mamografia_resultado_pasado = 0
                    AND bo_mamografia_vigente = 1
                    AND bo_finalizado = 0
                    AND empa.id_paciente = ". $id_paciente;
        
        $result	= $this->db->getQuery($query);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }
    
    /**
	 * Descripción : Obtiene Lista de Pacientes con exámenes para grilla
	 * @author  Carolina Zamora <carolina.zamora@cosof.cl>
     * @param   array $where
	 */
    public function getListaDetalle($where=array()){
        $query = "  SELECT DISTINCT
                        pac.id_paciente,
                        pac.gl_rut,
                        pac.gl_run_pass,
                        pac.bo_reconoce,
                        pac.bo_acepta_programa,
                        pac.gl_nombres,
                        pac.gl_apellidos,
                        date_format(pac.fc_crea,'%d-%m-%Y') as fc_crea,
                        IF(pac.bo_extranjero=1, pac.gl_run_pass, pac.gl_rut) AS gl_identificacion,
                        cs.gl_nombre_establecimiento as gl_institucion,
                        com.gl_nombre_comuna,
                        est.gl_nombre_estado_caso,
                        est.id_paciente_estado,
                        (SELECT COUNT(*) FROM pre_paciente_registro 
                         WHERE pre_paciente_registro.id_paciente = pac.id_paciente ) AS nr_motivo_consulta,
                        (SELECT COUNT(*) FROM pre_paciente_examen paciente_examen 
                         WHERE paciente_examen.id_paciente = pac.id_paciente
                         AND paciente_examen.gl_resultado = 'A') AS nr_examen_alterado,
                        datediff(now(), pac.fc_crea) AS nr_dias_primera_visita
                    FROM pre_paciente pac
                    INNER JOIN pre_paciente_examen pac_examen ON pac_examen.id_paciente = pac.id_paciente
                    LEFT JOIN  pre_empa empa ON (empa.id_empa = pac_examen.id_empa AND empa.bo_finalizado = 0)
                    LEFT JOIN  pre_centro_salud cs ON cs.id_centro_salud = pac.id_centro_salud
                    LEFT JOIN  pre_comuna com ON com.id_comuna = pac.id_comuna
                    LEFT JOIN  pre_paciente_estado est ON est.id_paciente_estado = pac.id_paciente_estado";

		if(!empty($where)){
			foreach($where as $w){
				$query .= ' WHERE '.$w['campo'].' = '.$w['valor'];
			}
		}
                
        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
			return $result->rows;
        }else{
            return NULL;
        }
    }   
    
    /**
	 * Descripción: Obtiene exámenes por Id de Laboratorio y Paciente
	 * @author Carolina Zamora <carolina.zamora@cosof.cl>
     * @param  int   $id_laboratorio
     * @param  int   $id_paciente
	 */
    public function getByIdLaboratorio($id_laboratorio, $id_paciente){
        $query = "  SELECT 
                        examen.id_paciente_examen,
                        examen.id_tipo_examen,
                        examen.id_paciente,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        examen.gl_resultado_descripcion,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio,
                        date_format(examen.fc_toma,'%d-%m-%Y') AS fc_toma,
                        date_format(examen.fc_resultado,'%d-%m-%Y') AS fc_resultado,
                        examen.gl_hora_toma,
                        examen.gl_observacion_toma,
                        date_format(examen.fc_toma,'%Y-%m-%d') AS fc_toma_calendar,
                        date_format(examen.fc_resultado,'%Y-%m-%d') AS fc_resultado_calendar,
                        NULL AS fc_ultimo_pap_ano, 
                        NULL AS fc_ultimo_pap_mes
                    FROM pre_paciente_examen examen
                    LEFT JOIN pre_empa empa ON (empa.id_empa = examen.id_empa AND empa.bo_finalizado = 0)
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
                    LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio
                    WHERE examen.id_laboratorio = ". $id_laboratorio ." 
                    AND examen.id_paciente = ". $id_paciente;
        
        $result	= $this->db->getQuery($query);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }
	
    /**
	 * Descripción: Obtiene exámenes por Id de Laboratorio y Tipo de Examen
	 * @author S/N
     * @param  int   $id_paciente
	 * @param  int   $id_tipo_examen
     */
	public function getByIdPacienteExamen($id_paciente, $id_tipo_examen){
        $query = "  SELECT *
                    FROM pre_paciente_examen
                    WHERE	id_paciente = ". $id_paciente ."
					AND		id_tipo_examen = ". $id_tipo_examen;
        
        $result	= $this->db->getQuery($query);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return NULL;
        }
    }
	
    /**
	 * Descripción: Obtiene último ID de exámen en "pre_paciente_examen"
	 * @author S/N
	 */
	public function getLastId(){
        $query = "  SELECT MAX(id_paciente_examen) AS id_paciente_examen
					FROM pre_paciente_examen";
        
        $result	= $this->db->getQuery($query);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return NULL;
        }
    }

    /**
	 * Descripción: Obtiene exámenes por Id de Laboratorio
	 * @author S/N
     * @param  int   $id_laboratorio
	 */
    public function getAllByIdLaboratorio($id_laboratorio){
        $query = "  SELECT 
                        examen.id_paciente_examen,
                        examen.id_tipo_examen,
                        examen.id_paciente,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        examen.gl_resultado_descripcion,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio,
                        date_format(examen.fc_toma,'%d-%m-%Y') AS fc_toma,
                        date_format(examen.fc_resultado,'%d-%m-%Y') AS fc_resultado,
                        examen.gl_hora_toma,
                        examen.gl_observacion_toma,
                        date_format(examen.fc_toma,'%Y-%m-%d') AS fc_toma_calendar,
                        date_format(examen.fc_resultado,'%Y-%m-%d') AS fc_resultado_calendar,
                        NULL AS fc_ultimo_pap_ano, 
                        NULL AS fc_ultimo_pap_mes,
                        IF(paciente.bo_extranjero=1,paciente.gl_run_pass,paciente.gl_rut) AS gl_identificacion,
						paciente.gl_rut,
						paciente.gl_nombres,
						paciente.gl_apellidos
                    FROM pre_paciente_examen examen
                    LEFT JOIN pre_empa empa ON (empa.id_empa = examen.id_empa AND empa.bo_finalizado = 0)
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
                    LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio
                    LEFT JOIN pre_paciente paciente ON paciente.id_paciente = examen.id_paciente
                    WHERE examen.id_laboratorio = ?";

        $param	= array($id_laboratorio);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows > 0) {
            return $result->rows;
        }else{
            return NULL;
        }
    }

}

?>