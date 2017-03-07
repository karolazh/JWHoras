<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_paciente_registro
* Plataforma	: !PHP
* Creacion		: 03/03/2017
* @name			DAOPacienteRegistro.php
* @version		1.0
* @author		Victor Retamal <victor.retamal@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<orlando.vazquez@cosof.cl>	05-06-2017	Modificadas referencias a campos de la BD antigua
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOPacienteRegistro extends Model{

    protected $_tabla			= "pre_paciente_registro";
    protected $_primaria		= "id_registro";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getLista(){
        $query		= "	SELECT * FROM ".$this->_tabla;
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query		= "	SELECT * FROM ".$this->_tabla."
						WHERE ".$this->_primaria." = ?";

		$param		= array($id);
        $resultado	= $this->db->getQuery($query,$param);
		
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        }else{
            return null;
        }
    }

    public function getByIdPaciente($id_paciente) {
        $query		= "	SELECT 
							registro.id_registro,
							registro.id_paciente,
							registro.id_institucion,
							date_format(registro.fc_ingreso, '%d-%m-%Y') as fc_ingreso,
							registro.gl_hora_ingreso, 
							registro.gl_motivo_consulta,
							date_format(registro.fc_crea,'%d-%m-%Y') AS fc_crea,
							registro.id_usuario_crea AS id_usuario_crea,
							usu.gl_nombres,
							usu.gl_apellidos,
							usu.gl_rut AS rut,
							concat_ws(' ' , usu.gl_nombres, usu.gl_apellidos) AS funcionario,
							ins.gl_nombre_establecimiento as gl_nombre_institucion,
							registro.fc_ingreso as fecha_ingreso 
						FROM pre_paciente_registro registro
							LEFT JOIN pre_usuario usu ON registro.id_usuario_crea = usu.id_usuario
							LEFT JOIN pre_centro_salud ins ON registro.id_institucion = ins.id_centro_salud
						WHERE id_paciente = ?;
						ORDER BY registro.id_registro DESC";

        $params		= array($id_paciente);
        $resultado	= $this->db->getQuery($query, $params);

        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return null;
        }
    }

    public function insertarRegistro($parametros, $id_paciente) {
        $query	= "INSERT INTO pre_paciente_registro
						(
						id_paciente,
						id_institucion,
						fc_ingreso,
						gl_hora_ingreso,
						gl_motivo_consulta,
						fc_crea,
						id_usuario_crea
						)
					VALUES  
						(
						" .$id_paciente . ",
						" .$_SESSION['id_institucion']. ",
						'".$parametros['fechaingreso']. "',
						'".$parametros['horaingreso']. "',
						'".$parametros['motivoconsulta']. "',
						now(),
						'" . $_SESSION['id'] . "'
						)";

		if ($this->db->execQuery($query)) {
            return $this->db->getLastId();
		}else{
            return false;
		}
    }

}