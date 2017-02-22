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
                        usu.gl_apellidos
                    FROM ".$this->_tabla." mot
                    LEFT JOIN pre_usuarios usu ON mot.id_usuario_crea = usu.id_usuario
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


        $query = "INSERT INTO pre_motivo_consulta
                                        (   id_registro,
                                            id_institucion,
                                            fc_ingreso,
                                            gl_hora_ingreso,
                                            gl_motivo_consulta,
                                            fc_crea,
                                            id_usuario_crea
                                        )
                                VALUES  (   " . $id_registro . ",
                                            " . $parametros['centrosalud'] . ",
                                            '" . $parametros['fechaingreso'] . "',
                                            '" . $parametros['horaingreso'] . "',
                                            '" . $parametros['motivoconsulta'] . "',
                                            now(),
                                            '" . $_SESSION['id'] . "')";

		if ($this->db->execQuery($query)) {
            return true;
		}else{
            return false;
		}
    }

}
