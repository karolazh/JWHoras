<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_paciente_agresor
* Plataforma	: !PHP
* Creacion		: 01/03/2017
* @name			DAOPacienteAgresor.php
* @version		1.0
* @author		David Guzmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<david.guzman@cosof.cl>	07-03-2017	insertarAgresor()
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOPacienteAgresor extends Model{

    protected $_tabla			= "pre_paciente_agresor";
    protected $_primaria		= "id_agresor";
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

	public function insertarAgresor($parametros) {
		$query	= "	INSERT INTO pre_paciente_agresor
						(
						id_paciente,
						id_tipo_vinculo,
						gl_tipo_vinculo,
						gl_nombres_agresor,
						gl_apellidos_agresor,
						bo_extranjero,
						gl_rut_agresor,
						gl_run_pass,
						id_tipo_riesgo,
						id_comuna_vive,
						id_comuna_trabaja,
						id_estado_civil,
						id_tipo_ocupacion,
						id_actividad_economica,
						id_tipo_sexo,
						id_tipo_genero,
						id_orientacion_sexual,
						id_ingreso_mensual,
						fc_nacimiento_agresor,
						nr_hijos,
						nr_hijos_en_comun,
						nr_denuncias_por_violencia,
						id_usuario_crea,
						fc_crea
						)
					VALUES
						(
						".$parametros['id_paciente'].",
						".$parametros['id_tipo_vinculo'].",
						".$parametros['gl_tipo_vinculo'].",
						".$parametros['gl_nombres_agresor'].",
						".$parametros['gl_apellidos_agresor'].",
						".$parametros['bo_extranjero'].",
						".$parametros['gl_rut_agresor'].",
						".$parametros['gl_run_pass_agresor'].",
						".$parametros['id_tipo_riesgo'].",
						".$parametros['id_comuna_vive'].",
						".$parametros['id_comuna_trabaja'].",
						".$parametros['id_estado_civil'].",
						".$parametros['id_tipo_ocupacion_agresor'].",
						".$parametros['id_actividad_economica'].",
						".$parametros['id_tipo_sexo'].",
						".$parametros['id_tipo_genero'].",
						".$parametros['id_orientacion_sexual'].",
						".$parametros['id_ingreso_mensual'].",
						".Fechas::formatearBaseDatos(str_replace("'","",$parametros['fc_nacimiento_agresor'])).",
						".$parametros['nr_hijos_agresor'].",
						".$parametros['nr_hijos_en_comun'].",
						".$parametros['nr_denuncias_por_violencia'].",
						".$_SESSION['id'].",
						now()
						)
                    ";

        if ($this->db->execQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function getByIdPaciente($id){
        $query	= "	SELECT
						a.*,
						v.gl_tipo_vinculo,
						e.gl_estado_civil,
						o.gl_tipo_ocupacion,
						act.gl_nombre_actividad,
						s.gl_tipo_sexo,
						g.gl_tipo_genero,
						os.gl_orientacion_sexual,
						date_format(fc_nacimiento_agresor,'%d-%m-%Y') as fc_nacimiento_agresor

					FROM pre_paciente_agresor a
					LEFT JOIN pre_tipo_vinculo v ON a.id_tipo_vinculo = v.id_tipo_vinculo
					LEFT JOIN pre_tipo_estado_civil e ON a.id_estado_civil = e.id_estado_civil
					LEFT JOIN pre_tipo_ocupacion o ON a.id_tipo_ocupacion = o.id_tipo_ocupacion
					LEFT JOIN pre_tipo_actividad_economica act ON a.id_actividad_economica = act.id_actividad_economica
					LEFT JOIN pre_tipo_sexo s ON a.id_tipo_sexo = s.id_tipo_sexo
					LEFT JOIN pre_tipo_genero g ON a.id_tipo_genero = g.id_tipo_genero
					LEFT JOIN pre_tipo_orientacion_sexual os ON a.id_orientacion_sexual = os.id_orientacion_sexual
					
                    
					WHERE id_paciente = ?
					ORDER BY id_agresor ASC
					LIMIT 1";

		$param	= array($id);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }
	
}

?>