<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_tipo_egreso
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
*
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
						gl_rut_agresor,
						id_comuna_vive,
						id_comuna_trabaja,
						id_estado_civil,
						id_tipo_ocupacion,
						id_actividad_economica,
						id_tipo_sexo,
						id_tipo_genero,
						id_orientacion_sexual,
						nr_ingreso_mensual,
						gl_nombres_agresor,
						gl_apellidos_agresor,
						fc_nacimiento_agresor,
						nr_hijos,
						nr_hijos_en_comun,
						nr_denuncias_por_violencia,
						id_usuario_crea,
						fc_crea
						)
					VALUES
						(
						".$_SESSION['id_paciente'].",
						".$parametros['id_tipo_vinculo'].",
						".$parametros['gl_rut_agresor'].",
						".$parametros['id_comuna_vive'].",
						'".$parametros['id_comuna_trabaja']."',
						'".$parametros['id_estado_civil']."',
						'".$parametros['id_tipo_ocupacion']."',
						'".$parametros['id_actividad_economica']."',
						'".$parametros['id_tipo_sexo']."',
						'".$parametros['id_tipo_genero']."',
						'".$parametros['id_orientacion_sexual']."',
						'".$parametros['nr_ingreso_mensual']."',
						'".$parametros['gl_nombres_agresor']."',
						'".$parametros['gl_apellidos_agresor']."',
						'".$parametros['fc_nacimiento_agresor']."',
						'".$parametros['nr_hijos']."',
						'".$parametros['nr_hijos_en_comun']."',
						'".$parametros['nr_denuncias_por_violencia']."',
						".$_SESSION['id'].",
						now()
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