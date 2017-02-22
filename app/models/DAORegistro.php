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
                            date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento,
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
    
    public function getRegistroxId($id_registro) {
        $query = "SELECT
                        reg.id_registro AS id_registro,	
                        reg.gl_rut AS rut,
                        reg.bo_extranjero AS extranjero, 
                        reg.gl_run_pass AS run_pass,
                        reg.gl_nombres AS nombres, 
                        reg.gl_apellidos AS apellidos,
                        date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento,
                        reg.gl_sexo AS genero, 
                        pre.gl_nombre_prevision AS prevision,
                        reg.gl_direccion AS direccion, 
                        reg.gl_fono AS fono, 
                        gl_celular AS celular, 
                        rg.gl_nombre_region AS region,
                        pro.gl_nombre_provincia AS provincia,
                        com.gl_nombre_comuna AS comuna,
                        reg.gl_email as email, 
                        est.gl_nombre_estado_caso AS estado,
                        reg.gl_grupo_tipo AS grupo,
                        reg.bo_reconoce AS reconoce, 
                        reg.bo_acepta_programa AS acepta,
                        date_format(reg.fc_crea,'%d-%m-%Y') AS fc_crea,
                        ins.gl_nombre AS institucion,
                        reg.id_centro_salud AS centro_salud, 
                        
                        reg.id_adjunto AS id_adjunto,
                        reg.gl_latitud AS latitud, 
                        reg.gl_longitud AS longitud,
                        date_format(reg.fc_actualiza,'%d-%m-%Y') AS fc_actualiza,
                        reg.id_usuario_crea AS usuario_crea, 
                        reg.id_usuario_actualiza AS usuario_actualiza
                    FROM pre_registro reg
                    left join pre_comunas com on com.id_comuna = reg.id_comuna
                    left join pre_provincias pro on pro.id_provincia = com.id_provincia
                    left join pre_regiones rg on rg.id_region = pro.id_region
                    left join pre_institucion ins on ins.id_institucion = reg.id_institucion
                    left join pre_prevision pre on pre.id_prevision = reg.id_prevision
                    left join pre_estados_caso est on est.id_estado_caso = reg.id_estado_caso
                    WHERE reg.id_registro = ?";

        $param = array($id_registro);
        $consulta = $this->db->getQuery($query, $param);

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return NULL;
        }
    }
    
    public function getEventosRegistro($id_registro){
        $query	=   "SELECT
                        eve.id_evento AS id_evento, 
                        eve.id_evento_tipo AS id_evento_tipo, 
                        tip.gl_nombre_evento_tipo AS nombre_evento,
                        eve.id_registro AS id_registro,
                        eve.gl_descripcion AS glosa,
                        date_format(eve.fc_crea,'%d-%m-%Y') AS fc_crea,
                        usr.gl_rut AS rut
                    FROM pre_eventos eve
                    LEFT JOIN pre_eventos_tipo tip ON tip.id_evento_tipo = eve.id_evento_tipo
                    LEFT JOIN pre_usuarios usr ON usr.id_usuario = eve.id_usuario_crea 
                    WHERE eve.id_registro = ?";

	$param		= array($id_registro);
        $consulta	= $this->db->getQuery($query,$param);
        
        if($consulta->numRows>0){
            return $consulta->rows;
        }else{
            return NULL;
        }
    }
}

?>