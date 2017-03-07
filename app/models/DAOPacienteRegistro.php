<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion           : Modelo para Tabla pre_paciente_registro
* Plataforma            : !PHP
* Creacion		: 27/02/2017
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

    protected $_tabla		= "pre_paciente_registro";
    protected $_primaria	= "id_registro";
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

    public function getListaPacienteRegistro($id_paciente) {
        $query	=   "SELECT 
                        registro.id_registro,
                        registro.id_paciente,
                        registro.id_institucion,
                        date_format(registro.fc_ingreso, '%d-%m-%Y') AS fc_ingreso,
                        registro.gl_hora_ingreso, 
                        registro.gl_motivo_consulta,
                        date_format(registro.fc_crea,'%d-%m-%Y') AS fc_crea,
                        registro.id_usuario_crea AS id_usuario_crea,
                        usu.gl_nombres,
                        usu.gl_apellidos,
                        usu.gl_rut AS rut,
                        concat_ws(' ' , usu.gl_nombres, usu.gl_apellidos) AS funcionario,
                        cs.gl_nombre_establecimiento
                    FROM pre_paciente_registro registro
                    LEFT JOIN pre_usuario usu ON usu.id_usuario = registro.id_usuario_crea
                    LEFT JOIN pre_centro_salud cs ON cs.id_centro_salud = registro.id_institucion
                    WHERE id_paciente = ?;
                    ORDER BY registro.id_registro DESC";

        $params	= array($id_paciente);
        $result	= $this->db->getQuery($query, $params);

        if ($result->numRows > 0) {
            return $result->rows;
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

?>