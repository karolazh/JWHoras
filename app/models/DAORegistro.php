<?php

class DAORegistro extends Model{

    protected $_tabla			= "pre_registro";
    protected $_primaria		= "id_registro";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Registro
     */
    public function getListaRegistro(){
        $query	= "	SELECT
						id_registro,
						gl_rut,
						gl_nombres,
						gl_apellidos
					FROM pre_registro r ";

        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getRegistroById($id_registro) {
        $query	= "	SELECT
						pre_registro.*,
						date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento
					FROM pre_registro 
					WHERE id_registro = ?";

        $param = array($id_registro);
        $consulta = $this->db->getQuery($query, $param);

        if ($consulta->numRows > 0) {            
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }
   
    //funcion repetida, usar getRegistroById
	/*
    public function getRegistro($id_registro){
        $query	= "	SELECT
						pre_registro.*,
						date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento
					FROM pre_registro
					WHERE id_registro = ?";

		$param		= array($id_registro);
        $resultado	= $this->db->getQuery($query,$param);
		
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }
	*/


    public function getRegistroxRut($rut_registro){
        $query	= "SELECT 
						pre_registro.*,
						date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento
					FROM pre_registro 
					WHERE gl_rut = ?";

		$param		= array($rut_registro);
        $consulta	= $this->db->getQuery($query,$param);

        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

    
    public function insertarRegistro($parametros){

        $query	= "	INSERT INTO pre_registro
						(
						id_institucion,
						id_comuna,
						id_prevision,
						id_adjunto,
						gl_grupo_tipo,
						gl_rut,
						bo_extranjero,
						gl_run_pass,
						gl_nombres,
						gl_apellidos,
						fc_nacimiento,
						gl_direccion,
						gl_fono,
						gl_celular,
						gl_email,
						gl_latitud,
						gl_longitud,
						bo_reconoce,
						bo_acepta_programa,
						fc_crea,
						id_usuario_crea
						)
					VALUES
						(
						".$parametros['centrosalud'].",
						".$parametros['comuna'].",
						".$parametros['prevision'].",
						0,
						'".$parametros['gl_grupo_tipo']."',
						'".$parametros['rut']."',
						'".$parametros['chkextranjero']."',
						'".$parametros['inputextranjero']."',
						'".$parametros['nombres']."',
						'".$parametros['apellidos']."',
						'".$parametros['fc_nacimiento']."',
						'".$parametros['direccion']."',
						'".$parametros['fono']."',
						'".$parametros['celular']."',
						'".$parametros['email']."',
						'".$parametros['gl_latitud']."',
						'".$parametros['gl_longitud']."',
						0,
						".$parametros['chkAcepta'].",
						'".date('Y-m-d H:i:s')."',
						".$_SESSION['id']."
						)

                    ";
                  
        if ($this->db->execQuery($query)) {
            return true;
        } else {
            return false;
        }
    }
}

?>