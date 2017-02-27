<?php

class DAOMotivoConsulta extends Model{

    protected $_tabla			= "pre_motivo_consulta";
    protected $_primaria		= "id_motivo_consulta";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getListaMotivoConsulta(){
        $query		= "	SELECT * FROM pre_motivo_consulta";
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getMotivoConsulta($id_motivo_consulta){
        $query	= "	SELECT * FROM pre_motivo_consulta
					WHERE id_motivo_consulta = ?";

		$param		= array($id_motivo_consulta);
        $resultado	= $this->db->getQuery($query,$param);
		
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        }else{
            return null;
        }
    }

    public function getListaMotivoConsultaByRegistro($id_registro) {
        $query = "SELECT 
                        mot.id_motivo_consulta, 
                        date_format(mot.fc_ingreso, '%d-%m-%Y') as fc_ingreso,
                        mot.gl_hora_ingreso, 
                        mot.gl_motivo_consulta,
                        mot.fc_crea, 
                        usu.gl_nombres,
                        usu.gl_apellidos,
						ins.gl_nombre as gl_nombre_institucion
                    FROM ".$this->_tabla." mot
                    LEFT JOIN pre_usuarios usu ON mot.id_usuario_crea = usu.id_usuario
					LEFT JOIN pre_institucion ins ON mot.id_institucion = ins.id_institucion
                    WHERE id_registro = ?;";
                

        $params = array($id_registro);
        $resultado = $this->db->getQuery($query, $params);
        if ($resultado->numRows > 0) {
            return $resultado->rows;
        } else {
            return null;
        }
    }

    public function insertarMotivoConsulta($parametros, $id_registro) {
        $query	= "INSERT INTO pre_motivo_consulta
							(
							id_registro,
							id_institucion,
							fc_ingreso,
							gl_hora_ingreso,
							gl_motivo_consulta,
							fc_crea,
							id_usuario_crea
							)
					VALUES  (
							" . $id_registro . ",
							" .$_SESSION['id_institucion']. ",
							'" . $parametros['fechaingreso'] . "',
							'" . $parametros['horaingreso'] . "',
							'" . $parametros['motivoconsulta'] . "',
							now(),
							'" . $_SESSION['id'] . "'
							)";

		if ($this->db->execQuery($query)) {
            return true;
		}else{
            return false;
		}
    }

    /*
     * Ver Motivos para Grilla
     */
    public function getMotivosConsultaGrilla($id_registro){
        $query =    "SELECT
                        mot.id_motivo_consulta AS id_motivo,
                        mot.id_registro AS id_registro,
                        mot.id_institucion AS id_institucion,
                        ins.gl_nombre AS institucion,
                        mot.fc_ingreso AS fc_ingreso,
                        mot.gl_hora_ingreso AS hora_ingreso,
                        mot.gl_motivo_consulta AS motivo_consulta,
                        mot.fc_crea AS fc_crea,
                        mot.id_usuario_crea AS id_usuario_crea,
                        usr.gl_rut AS rut
                    FROM pre_motivo_consulta mot
                    LEFT JOIN pre_institucion ins ON ins.id_institucion = mot.id_institucion
                    LEFT JOIN pre_usuarios usr ON usr.id_usuario = mot.id_usuario_crea
                    WHERE mot.id_registro = ?
                    ORDER BY mot.fc_ingreso DESC";

        $params		= array($id_registro);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
}