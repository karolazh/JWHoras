<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_paciente
* Plataforma	: !PHP
* Creacion		: 22/02/2017
* @name			DAOPaciente.php
* @version		1.0
* @author		Victor Retamal <victor.retamal@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<orlando.vazquez@cosof.cl>	05-06-2017	Modificadas referencias a BD antigua
*<david.guzman@cosof.cl>	07-03-2017	updatePaciente()
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOPaciente extends Model{

    protected $_tabla			= "pre_paciente";
    protected $_primaria		= "id_paciente";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getLista($parametros = null){
        $query		= "	SELECT * FROM ".$this->_tabla;
        $params = array();
        if(isset($parametros['region'])){
        	$query .= ' WHERE id_region = ?';
        	$params[] = $parametros['region'];
        }

        $result	= $this->db->getQuery($query, $params);
        //$result	= $this->db->getQuery($query);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query		= "	SELECT * FROM ".$this->_tabla."
						WHERE ".$this->_primaria." = ?";

		$param		= array($id);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

    public function getByRut($gl_rut) {

        $query	= "	SELECT 
						paciente.*,
						c.gl_nombre_comuna,
						e.gl_nombre_establecimiento as gl_centro_salud,
						date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento_vista
					FROM pre_paciente AS paciente
                        LEFT JOIN pre_comuna c ON paciente.id_comuna = c.id_comuna
                        LEFT JOIN pre_centro_salud e ON paciente.id_centro_salud = e.id_centro_salud
					WHERE gl_rut = ?";

        $param		= array($gl_rut);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return null;
        }
    }

    public function getListaDetalle(){
        $query		= "	SELECT
							paciente.id_paciente,
							paciente.gl_rut,
							paciente.gl_run_pass,
							paciente.bo_reconoce,
							paciente.bo_acepta_programa,
							paciente.gl_nombres,
							paciente.gl_apellidos,
							date_format(paciente.fc_crea,'%d-%m-%Y') as fc_crea,
							IFNULL(paciente.gl_rut,paciente.gl_run_pass) as gl_identificacion,
							i.gl_nombre_establecimiento as gl_institucion,
							c.gl_nombre_comuna,
							e.gl_nombre_estado_caso,
							e.id_paciente_estado,
							(select count(*) from pre_paciente_registro where pre_paciente_registro.id_paciente = paciente.id_paciente ) as nr_motivo_consulta,
							datediff(now(),paciente.fc_crea) as nr_dias_primera_visita
						FROM pre_paciente paciente 
							LEFT JOIN pre_centro_salud i ON i.id_centro_salud = paciente.id_institucion
							LEFT JOIN pre_comuna c ON c.id_comuna = paciente.id_comuna
							LEFT JOIN pre_paciente_estado e ON e.id_paciente_estado = paciente.id_paciente_estado";

        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
			return $result->rows;
        }else{
            return NULL;
        }
    }
    
    public function getPacienteById($id_paciente) {
        $query		= "	SELECT
							paciente.id_paciente AS id_paciente,
							paciente.gl_rut AS rut,
							paciente.bo_extranjero AS extranjero,
							paciente.gl_run_pass AS run_pass,
							paciente.gl_nombres AS nombres,
							paciente.gl_apellidos AS apellidos,
							paciente.gl_sexo AS genero,
							paciente.gl_direccion AS direccion,
							paciente.gl_fono AS fono,
							paciente.gl_email as email,
							paciente.gl_grupo_tipo AS grupo,
							paciente.bo_reconoce AS reconoce,
							paciente.bo_acepta_programa AS acepta,
							paciente.id_centro_salud AS centro_salud,
							paciente.gl_latitud AS latitud,
							paciente.gl_longitud AS longitud,
							paciente.id_usuario_crea AS usuario_crea,
							paciente.id_usuario_actualiza AS usuario_actualiza,
							date_format(paciente.fc_crea,'%d-%m-%Y') AS fc_crea,
							date_format(paciente.fc_actualiza,'%d-%m-%Y') AS fc_actualiza,
							date_format(paciente.fc_nacimiento,'%d-%m-%Y') as fc_nacimiento,
							est.gl_nombre_estado_caso AS estado,
							pre.gl_nombre_prevision AS prevision,
							gl_celular AS celular,
							rg.gl_nombre_region AS region,
							pro.gl_nombre_provincia AS provincia,
							com.gl_nombre_comuna AS comuna,
							ins.gl_nombre_establecimiento AS institucion
						FROM pre_paciente AS paciente
							LEFT JOIN pre_comuna com ON com.id_comuna = paciente.id_comuna
							LEFT JOIN pre_provincia pro ON pro.id_provincia = com.id_provincia
							LEFT JOIN pre_region rg ON rg.id_region = pro.id_region
							LEFT JOIN pre_centro_salud ins ON ins.id_centro_salud = paciente.id_institucion
							LEFT JOIN pre_prevision pre ON pre.id_prevision = paciente.id_prevision
							LEFT JOIN pre_paciente_estado est ON est.id_paciente_estado = paciente.id_paciente_estado
						WHERE paciente.id_paciente = ?";

        $param		= array($id_paciente);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows > 0) {
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

	public function verInfoById($id_paciente) {
        $query		= "	SELECT
							IFNULL(paciente.id_paciente,0) as id_paciente,
							IFNULL(paciente.id_prevision,0) as id_prevision,
							IFNULL(paciente.gl_rut,'N/D') as gl_rut,
							IFNULL(paciente.bo_extranjero,0) as bo_extranjero,
							IFNULL(paciente.gl_run_pass,'N/D') as gl_run_pass,
							IFNULL(paciente.gl_nombres,'N/D') as gl_nombres,
							IFNULL(paciente.gl_apellidos,'N/D') as gl_apellidos,
							IFNULL(paciente.fc_nacimiento,'00-00-1900') as fc_nacimiento,
							IFNULL(paciente.gl_sexo,'N/D') as gl_sexo,
							IFNULL(paciente.gl_direccion,'N/D') as gl_direccion,
							IFNULL(paciente.gl_fono,'N/D') as gl_fono,
							IFNULL(paciente.gl_celular,'N/D') as gl_celular,
							IFNULL(paciente.gl_email,'N/D') as gl_email,
							IFNULL(paciente.gl_latitud,'') as gl_latitud,
							IFNULL(paciente.gl_longitud,'') as gl_longitud,
							IFNULL(bo_reconoce,0) as bo_reconoce,
							IFNULL(bo_acepta_programa,0) as bo_acepta_programa,
							IFNULL(a.gl_path,'') as gl_path,
							IFNULL(p.gl_nombre_prevision, 'N/D') as gl_nombre_prevision,
							IFNULL(c.gl_nombre_comuna, 'N/D') as gl_nombre_comuna,
							IFNULL(r.gl_nombre_region, 'N/D') as gl_nombre_region,
							IFNULL(CONCAT(u.gl_nombres, ' ',u.gl_apellidos),'N/D') as gl_nombre_usuario_crea,
							IFNULL(ec.gl_nombre_estado_caso, 'N/D') as gl_nombre_estado_caso,
							IFNULL(i.gl_nombre_establecimiento, 'N/D') as gl_nombre_institucion
						FROM pre_paciente AS paciente
							LEFT JOIN pre_adjunto AS a on (paciente.id_paciente = a.id_paciente AND a.id_adjunto_tipo = 1)
							LEFT JOIN pre_prevision AS p USING (id_prevision)
							LEFT JOIN pre_comuna AS c USING (id_comuna)
							LEFT JOIN pre_region AS r on paciente.id_region = r.id_region
							LEFT JOIN pre_usuario AS u ON paciente.id_usuario_crea = u.id_usuario
							LEFT JOIN pre_paciente_estado AS ec USING (id_paciente_estado)
							LEFT JOIN pre_centro_salud AS i ON paciente.id_centro_salud = i.id_centro_salud
						WHERE paciente.id_paciente = ?";

        $param		= array($id_paciente);
		$result	= $this->db->getQuery($query, $param);

		if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return null;
        }
    }

	public function getByPasaporte($pasaporte) {
        $query	= "	SELECT 
						p.*,
						c.gl_nombre_comuna,
						e.gl_nombre_establecimiento as gl_centro_salud,
						date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento_vista
					FROM pre_paciente p 
                        LEFT JOIN pre_comuna c ON p.id_comuna = c.id_comuna
                        LEFT JOIN pre_centro_salud e ON p.id_centro_salud = e.id_centro_salud
					WHERE gl_run_pass = ?";

        $param		= array($pasaporte);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return null;
        }
    }

	public function countPacientesxRegion($id_region){
        $query		= "	SELECT 
						paciente.*
						FROM pre_paciente AS paciente 
						WHERE paciente.id_region = ?";

		$param		= array($id_region);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows > 0){
            return $result->numRows;
        } else {
            return 0;
        }
    }

    public function insertarPaciente($parametros){
        $query	= "	INSERT INTO pre_paciente
						(
						id_institucion,
						id_region,
						id_comuna,
						id_prevision,
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
						now(),
						".$_SESSION['id']."
						)
                    ";

        if ($this->db->execQuery($query)) {
            return $this->db->getLastId();
        } else {
            return NULL;
        }
    }
    
    public function getRegistroxId($id_paciente) {
        $query = "SELECT
                        reg.id_paciente AS id_paciente,	
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
                        ins.gl_nombre_establecimiento AS institucion,
                        reg.id_centro_salud AS centro_salud, 
                        reg.id_adjunto AS id_adjunto,
                        reg.gl_latitud AS latitud, 
                        reg.gl_longitud AS longitud,
                        date_format(reg.fc_actualiza,'%d-%m-%Y') AS fc_actualiza,
                        reg.id_usuario_crea AS usuario_crea, 
                        reg.id_usuario_actualiza AS usuario_actualiza
                    FROM pre_paciente reg
                    left join pre_comuna com on com.id_comuna = reg.id_comuna
                    left join pre_provincia pro on pro.id_provincia = com.id_provincia
                    left join pre_region rg on rg.id_region = pro.id_region
                    left join pre_centro_salud ins on ins.id_centro_salud = reg.id_institucion
                    left join pre_prevision pre on pre.id_prevision = reg.id_prevision
                    left join pre_paciente_estado est on est.id_paciente_estado = reg.id_paciente_estado
                    WHERE reg.id_paciente = ?";

        $param = array($id_paciente);
        $result = $this->db->getQuery($query, $param);


        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return NULL;
        }
    }
    
    public function getByIdPaciente($id_paciente) {
        $query = "SELECT
                        pac.id_paciente,	
                        pac.gl_rut,
                        pac.bo_extranjero, 
                        pac.gl_run_pass,
                        pac.gl_nombres, 
                        pac.gl_apellidos,
                        date_format(pac.fc_nacimiento,'%d-%m-%Y') as fc_nacimiento,
                        pac.gl_sexo, 
                        pre.gl_nombre_prevision,
                        pac.gl_direccion, 
                        pac.gl_fono, 
                        pac.gl_celular, 
                        rg.gl_nombre_region,
                        pro.gl_nombre_provincia,
                        com.gl_nombre_comuna,
                        pac.gl_email, 
                        est.gl_nombre_estado_caso,
                        pac.gl_grupo_tipo,
                        pac.bo_reconoce, 
                        pac.bo_acepta_programa,
                        date_format(pac.fc_crea,'%d-%m-%Y') AS fc_crea,
                        cs.gl_nombre_establecimiento,
                        pac.id_centro_salud, 
                        pac.gl_latitud, 
                        pac.gl_longitud,
                        date_format(pac.fc_actualiza,'%d-%m-%Y'),
                        pac.id_usuario_crea, 
                        pac.id_usuario_actualiza
                    FROM pre_paciente pac
                    left join pre_comuna com on com.id_comuna = pac.id_comuna
                    left join pre_provincia pro on pro.id_provincia = com.id_provincia
                    left join pre_region rg on rg.id_region = pro.id_region
                    left join pre_centro_salud cs on cs.id_centro_salud = pac.id_centro_salud
                    left join pre_prevision pre on pre.id_prevision = pac.id_prevision
                    left join pre_paciente_estado est on est.id_paciente_estado = pac.id_paciente_estado
                    WHERE pac.id_paciente = ?";

        $param = array($id_paciente);
        $result = $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return NULL;
        }
    }
	
	public function updatePaciente($parametros){
		$query	= "	UPDATE pre_paciente SET
						id_estado_civil					= ".$_SESSION['id_estado_civil'].",
						nr_hijos						= ".$parametros['nr_hijos'].",
						id_tipo_ocupacion				= ".$parametros['id_tipo_ocupacion'].",
						id_tipo_escolaridad				= ".$parametros['id_tipo_escolaridad'].",
						gl_acompañante					= ".$parametros['gl_acompañante'].",
						fc_actualiza					= now()
					WHERE id_paciente = ".$parametros['id_paciente']."
                    ";

        if($this->db->execQuery($query)) {
            return TRUE;
        }else{
            return FALSE;
        }
	}
	
}

?>