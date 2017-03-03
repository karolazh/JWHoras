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
						r.id_registro,
						r.gl_rut,
						r.gl_run_pass,
                        r.bo_reconoce,
                        r.bo_acepta_programa,
						IFNULL(r.gl_rut,r.gl_run_pass) as gl_identificacion,
						date_format(r.fc_crea,'%d-%m-%Y') as fc_crea,
						r.gl_nombres,
						r.gl_apellidos,
						i.gl_nombre as gl_institucion,
						c.gl_nombre_comuna,
						e.gl_nombre_estado_caso,
                        e.id_estado_caso,
						(select count(*) from pre_motivo_consulta where pre_motivo_consulta.id_registro = r.id_registro ) as nr_motivo_consulta,
						datediff(now(),r.fc_crea) as nr_dias_primera_visita
					FROM pre_registro r 
						LEFT JOIN pre_institucion i ON i.id_institucion = r.id_institucion
						LEFT JOIN pre_comunas c ON c.id_comuna = r.id_comuna
						LEFT JOIN pre_estados_caso e ON e.id_estado_caso = r.id_estado_caso";

        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
			return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getRegistroById($id_registro) {
        $query	= "	SELECT
						*
					FROM pre_registro r
					WHERE id_registro = ?";

        $param = array($id_registro);
        $consulta = $this->db->getQuery($query, $param);

        if ($consulta->numRows > 0) {            
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

	public function verInfoById($id_registro) {
        $query	= "SELECT 
						IFNULL(rg.id_registro,0) as id_registro,
						IFNULL(rg.id_prevision,0) as id_prevision,
						IFNULL(rg.gl_rut,'N/D') as gl_rut,
						IFNULL(rg.bo_extranjero,0) as bo_extranjero,
						IFNULL(rg.gl_run_pass,'N/D') as gl_run_pass,
						IFNULL(rg.gl_nombres,'N/D') as gl_nombres,
						IFNULL(rg.gl_apellidos,'N/D') as gl_apellidos,
						IFNULL(rg.fc_nacimiento,'00-00-1900') as fc_nacimiento,
						IFNULL(rg.gl_sexo,'N/D') as gl_sexo,
						IFNULL(rg.gl_direccion,'N/D') as gl_direccion,
						IFNULL(rg.gl_fono,'N/D') as gl_fono,
						IFNULL(rg.gl_celular,'N/D') as gl_celular,
						IFNULL(rg.gl_email,'N/D') as gl_email,
						IFNULL(rg.gl_latitud,'') as gl_latitud,
						IFNULL(rg.gl_longitud,'') as gl_longitud,
						IFNULL(bo_reconoce,0) as bo_reconoce,
						IFNULL(bo_acepta_programa,0) as bo_acepta_programa,
						IFNULL(a.gl_path,'') as gl_path,
						IFNULL(p.gl_nombre_prevision, 'N/D') as gl_nombre_prevision,
						IFNULL(c.gl_nombre_comuna, 'N/D') as gl_nombre_comuna,
						IFNULL(r.gl_nombre_region, 'N/D') as gl_nombre_region,
                        IFNULL(CONCAT(u.gl_nombres, ' ',u.gl_apellidos),'N/D') as gl_nombre_usuario_crea,
						IFNULL(ec.gl_nombre_estado_caso, 'N/D') as gl_nombre_estado_caso,
						IFNULL(i.gl_nombre, 'N/D') as gl_nombre_institucion
					FROM pre_registro AS rg
						LEFT JOIN pre_adjuntos AS a USING (id_adjunto)
						LEFT JOIN pre_prevision AS p USING (id_prevision)
						LEFT JOIN pre_comunas AS c USING (id_comuna)
						LEFT JOIN pre_regiones AS r ON rg.id_region = r.id_region
						LEFT JOIN pre_usuarios AS u ON rg.id_usuario_crea = u.id_usuario
						LEFT JOIN pre_estados_caso AS ec USING (id_estado_caso)
                        LEFT JOIN pre_institucion AS i ON rg.id_institucion = i.id_institucion
					WHERE rg.id_registro = ?";
        $param = array($id_registro);
		$consulta = $this->db->getQuery($query, $param);
		if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

    public function getRegistroByRut($rut_registro) {

        $query	= "	SELECT 
						pre_registro.*,
						c.gl_nombre_comuna,
						e.gl_nombre_establecimiento as gl_centro_salud,
						date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento_vista
					FROM pre_registro 
                        LEFT JOIN pre_comunas c ON pre_registro.id_comuna = c.id_comuna
                        LEFT JOIN pre_establecimientos_salud e ON pre_registro.id_centro_salud = e.id_establecimiento
					WHERE gl_rut = ?";

        $param		= array($rut_registro);
        $consulta	= $this->db->getQuery($query, $param);

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }
	public function getRegistroByPasaporte($pasaporte) {
        $query	= "	SELECT 
						pre_registro.*,
						c.gl_nombre_comuna,
						e.nombre_establecimiento as gl_centro_salud,
						date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento_vista
					FROM pre_registro 
                        LEFT JOIN pre_comunas c ON pre_registro.id_comuna = c.id_comuna
                        LEFT JOIN pre_establecimientos_salud e ON pre_registro.id_centro_salud = e.id_establecimiento
					WHERE gl_run_pass = ?";

        $param		= array($pasaporte);
        $consulta	= $this->db->getQuery($query, $param);

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

    
	public function countRegistroxRegion($id_region){
        $query	= "	SELECT 
						*
					FROM pre_registro 
					WHERE id_region = ?";

		$param		= array($id_region);
        $consulta	= $this->db->getQuery($query,$param);

        if($consulta->numRows > 0){
            return $consulta->numRows;
        } else {
            return 0;
        }
    }

    public function insertarRegistro($parametros){

        $query	= "	INSERT INTO pre_registro
						(
						id_institucion,
						id_region,
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
						id_centro_salud,
						gl_latitud,
						gl_longitud,
						bo_reconoce,
						bo_acepta_programa,
						fc_crea,
						id_usuario_crea
						)
					VALUES
						(
						".$_SESSION['id_institucion'].",
						".$parametros['region'].",
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
						'".$parametros['centrosalud']."',
						'".$parametros['gl_latitud']."',
						'".$parametros['gl_longitud']."',
						'".$parametros['chkReconoce']."',
						".$parametros['chkAcepta'].",
						'".date('Y-m-d H:i:s')."',
						".$_SESSION['id']."
						)
                    ";
                  
        if ($this->db->execQuery($query)) {
            return $this->db->getLastId();
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
                        usr.gl_rut AS rut,
                        concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS funcionario
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