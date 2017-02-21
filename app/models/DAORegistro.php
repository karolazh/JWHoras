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

	/*
	public function getListaRegistroById($id_registro){
        $query	= "	SELECT 
						date_format(r.reg_fec_ingreso,'%d-%m-%Y') as reg_fec_ingreso,
						date_format(r.reg_hora_ingreso,'%H:%i:%s') as reg_hora_ingreso,
						r.reg_motivo_consulta,
						r.reg_historia_enfermedad,
						r.reg_diagnostico,
						r.reg_indicacion_medica
					FROM tab_registro r 
						INNER JOIN tab_pacientes p ON p.pac_id= r.reg_pac_id 
					WHERE p.pac_id = ? " ;

		$param		= array($id_registro);
        $resultado	= $this->db->getQuery($query,$param);

        if($resultado->numRows>0){
            return $resultado->rows;
        } else {
            return NULL;
        }
    }

	*/
    public function getRegistroById($id_registro) {
        $query = "select "
                . "id_registro, "
                . "gl_rut, "
                . "bo_extranjero, "
                . "gl_run_pass, "
                . "gl_nombres, "
                . "gl_apellidos, "
                . "date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento, "
                . "gl_sexo, "
                . "id_prevision, "
                . "gl_direccion, "
                . "id_comuna, "
                . "gl_fono, "
                . "gl_celular, "
                . "gl_email, "
                . "fc_actualiza, "
                . "gl_latitud, "
                . "gl_longitud, "
                . "bo_reconoce, "
                . "bo_acepta_programa, "
                . "id_adjunto, "
                . "id_estado_caso, "
                . "id_institucion,"
                . "id_usuario_crea, "
                . "fc_crea "
                . "from pre_registro "
                . "where id_registro = ?";
        $param = array($id_registro);
        $consulta = $this->db->getQuery($query, $param);

        if ($consulta->numRows > 0) {            
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }
    /*
     * Ver Registro
     */	
    //funcion repetida
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

    public function getRegistroByRut($rut_registro) {

        $query = "	SELECT 
                            id_registro,
                            gl_nombres,
                            gl_apellidos,
                            date_format(fc_nac,'%d-%m-%Y') as fc_nac,
                            id_prevision,
                            gl_direccion,
                            gl_fono,
                            gl_email,
                            gl_celular
                        FROM pre_registro 
                        WHERE gl_rut = ?";


        $param = array($rut_registro);
        $consulta = $this->db->getQuery($query, $param);


        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }
            //funcion repetida
    public function getRegistroxRut($rut_registro){
        $query	= "	SELECT 
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
        $query = "INSERT INTO pre_registro
                    (gl_rut, gl_nombres, gl_apellidos, fc_nacimiento, gl_sexo, id_prevision, gl_direccion,
                    id_comuna, gl_fono, gl_celular, gl_email, id_institucion, gl_latitud, gl_longitud)
                    VALUES('".$parametros['rut']."','".$parametros['nombres']."','".$parametros['apellidos']."',
                            '".$parametros['fc_nacimiento']."','F',".$parametros['prevision'].",
                            '".$parametros['direccion']."',".$parametros['comuna'].",".$parametros['fono'].",
                            ".$parametros['celular'].",'".$parametros['email']."',".$parametros['centrosalud'].",
                            '".$parametros['gl_latitud']."','".$parametros['gl_longitud']."')
                    ";
                  
        if ($this->db->execQuery($query)) {
            return true;
        } else {
            return false;
        }
    }
}

?>