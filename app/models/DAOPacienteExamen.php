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
                        lab.gl_nombre_laboratorio
                    FROM pre_paciente_examen examen
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
                    LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio 
                    WHERE examen.id_paciente = ?
                    ORDER BY examen.fc_crea DESC";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }

    public function getExamenAleradoByIdPaciente($id_paciente){
        $query = "  SELECT
                        examen.id_paciente_examen ,
                        examen.id_tipo_examen,
                        examen.id_empa,
                        examen.id_laboratorio,
                        examen.gl_folio,
                        examen.gl_resultado,
                        examen.gl_resultado_descripcion,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,
                        tipo.gl_nombre_examen,
                        lab.gl_nombre_laboratorio
                    FROM pre_paciente_examen examen
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
                    LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio 
                    WHERE examen.id_paciente = ?
                    AND examen.gl_resultado = 'A'
                    ORDER BY examen.fc_crea DESC";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }
    
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
                    FROM pre_paciente pac -- , pre_paciente_examen AS pac_examen
                    INNER JOIN pre_paciente_examen pac_examen ON pac_examen.id_paciente = pac.id_paciente
                    -- LEFT JOIN pre_centro_salud i ON i.id_centro_salud = pac.id_institucion
                    LEFT JOIN pre_centro_salud cs ON cs.id_centro_salud = pac.id_centro_salud
                    LEFT JOIN pre_comuna com ON com.id_comuna = pac.id_comuna
                    LEFT JOIN pre_paciente_estado est ON est.id_paciente_estado = pac.id_paciente_estado";

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
}

?>