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
                    ORDER BY examen.fc_crea DESC";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }

    public function getByIdPacienteAlterado($id_paciente){
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
        $query = "  SELECT
                        examen.id_paciente_examen,
                        examen.id_tipo_examen,
                        tipo.gl_nombre_examen,
                        examen.id_laboratorio,
                        lab.gl_nombre_laboratorio,
                        examen.id_paciente,
                        pac.gl_rut,
                        pac.bo_extranjero,
                        pac.gl_run_pass,
                        concat_ws(' ' , pac.gl_nombres, pac.gl_apellidos) AS gl_nombre_paciente,
                        pac.id_centro_salud,
                        cen.gl_nombre_establecimiento,
                        examen.id_empa,
                        examen.gl_folio,
                        examen.gl_resultado,
                        examen.gl_resultado_descripcion,
                        date_format(examen.fc_crea,'%d-%m-%Y') AS fc_crea,                        
                        examen.id_usuario_crea,
                        usr.gl_rut,
                        concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS gl_funcionario
                    FROM pre_paciente_examen examen
                    LEFT JOIN pre_tipo_examen tipo ON tipo.id_tipo_examen = examen.id_tipo_examen
                    LEFT JOIN pre_laboratorio lab ON lab.id_laboratorio = examen.id_laboratorio
                    LEFT JOIN pre_paciente pac ON pac.id_paciente = examen.id_paciente
                    LEFT JOIN pre_centro_salud cen ON cen.id_centro_salud = pac.id_centro_salud
                    LEFT JOIN pre_usuario usr ON usr.id_usuario = examen.id_usuario_crea";

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