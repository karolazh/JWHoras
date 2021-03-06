 <?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Modelo para Tabla pre_paciente
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 22/02/2017
 * 
 * @name             DAOPaciente.php
 * 
 * @version          1.0
 *
 * @author           Victor Retamal <victor.retamal@cosof.cl>
 * 
 ******************************************************************************
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * ----------------------------------------------------------------------------
 * <orlando.vazquez@cosof.cl>   05-06-2017  Modificadas referencias a BD antigua
 * 
 * <david.guzman@cosof.cl>      07-03-2017  updatePaciente()
 * ----------------------------------------------------------------------------
 * ****************************************************************************
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
        $query		= "	SELECT	*,
								date_format(fc_nacimiento,'%d-%m-%Y') as fc_nacimiento
						FROM ".$this->_tabla."
						WHERE ".$this->_primaria." = ?";

		$param		= array($id);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene detalle de Paciente por Rut
	 * @author  S/N
     * @param   string $gl_rut 
	 */
    public function getByRut($gl_rut) {

        $query = "  SELECT 
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

    /**
	 * Descripción : Obtiene Lista de Pacientes para Grilla
	 * @author  S/N
     * @param   array  $parametros
     * @param   array  $join
	 */
    public function getListaDetalle($parametros=array(),$join=array()){
        $query = "  SELECT
                        paciente.id_paciente,
                        paciente.gl_rut,
                        paciente.gl_run_pass,
                        paciente.bo_reconoce,
                        paciente.bo_acepta_programa,
                        paciente.gl_nombres,
                        paciente.gl_apellidos,
                        date_format(paciente.fc_crea,'%d-%m-%Y') as fc_crea,
                        IF(paciente.bo_extranjero=1,paciente.gl_run_pass,paciente.gl_rut) AS gl_identificacion,
                        i.gl_nombre_establecimiento as gl_institucion,
                        centro.gl_nombre_establecimiento as gl_centro_salud,
                        c.gl_nombre_comuna,
                        e.gl_nombre_estado_caso,
                        e.id_paciente_estado,
                        (SELECT COUNT(*) FROM pre_paciente_registro 
						 WHERE pre_paciente_registro.id_paciente = paciente.id_paciente) AS nr_motivo_consulta,
                        (SELECT COUNT(*) FROM pre_paciente_examen paciente_examen 
                         WHERE paciente_examen.id_paciente = paciente.id_paciente
                         AND paciente_examen.gl_resultado = 'A') AS nr_examen_alterado,
                        datediff(now(),paciente.fc_crea) as nr_dias_primera_visita,
                        (SELECT COUNT(*) FROM pre_empa empa 
                         WHERE empa.bo_finalizado = 0
                         AND empa.id_paciente = paciente.id_paciente
                         AND (empa.bo_pap_resultado = 0 OR empa.bo_mamografia_resultado_pasado = 0)) AS gl_examen_alterado_externo
                    FROM pre_paciente paciente 
                    LEFT JOIN pre_centro_salud i ON i.id_centro_salud = paciente.id_institucion
                    LEFT JOIN pre_centro_salud centro ON centro.id_centro_salud = paciente.id_centro_salud
                    LEFT JOIN pre_comuna c ON c.id_comuna = paciente.id_comuna
                    LEFT JOIN pre_paciente_estado e ON e.id_paciente_estado = paciente.id_paciente_estado";

        $params = array();
		if (!empty($join)) {
			foreach($join as $campo=>$valor){
				$query .= ' LEFT JOIN '.$valor['tabla'].' ON '.$valor['on'].' = '.$valor['igual'];
			}
		}

		if(!empty($parametros)){
            $where	= ' WHERE ';
			foreach($parametros as $campo=>$valor){
				$where		.= ' '.$campo.' = ? AND';
				$params[]	= $valor;
			}
            $where	= trim($where,'AND');
            $query	.= $where;
		}

		$query	.= ' GROUP BY paciente.id_paciente';
        $result	= $this->db->getQuery($query,$params);

        if($result->numRows>0){
			return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene Lista de Pacientes para Grilla x Id de Región
     * //Usar getListaDetalle pasando $parametros el id_region (ver Medico.php)
	 * @author  S/N
     * @param   int $id_region
	 */
	public function getListaDetalleRegion($id_region){
        $query = "  SELECT
                        paciente.id_paciente,
                        paciente.gl_rut,
                        paciente.gl_run_pass,
                        paciente.bo_reconoce,
                        paciente.bo_acepta_programa,
                        paciente.gl_nombres,
                        paciente.gl_apellidos,
                        date_format(paciente.fc_crea,'%d-%m-%Y') as fc_crea,
                        IF(paciente.bo_extranjero=1,paciente.gl_run_pass,paciente.gl_rut) as gl_identificacion,
                        i.gl_nombre_establecimiento as gl_institucion,
                        c.gl_nombre_comuna,
                        e.gl_nombre_estado_caso,
                        e.id_paciente_estado,
                        (select count(*) from pre_paciente_registro where pre_paciente_registro.id_paciente = paciente.id_paciente ) as nr_motivo_consulta,
                        (SELECT COUNT(*) FROM pre_paciente_examen paciente_examen 
                         WHERE paciente_examen.id_paciente = paciente.id_paciente
                         AND paciente_examen.gl_resultado = 'A') AS nr_examen_alterado,
                        datediff(now(),paciente.fc_crea) as nr_dias_primera_visita
                    FROM pre_paciente paciente 
                    LEFT JOIN pre_centro_salud i ON i.id_centro_salud = paciente.id_institucion
                    LEFT JOIN pre_comuna c ON c.id_comuna = paciente.id_comuna
                    LEFT JOIN pre_paciente_estado e ON e.id_paciente_estado = paciente.id_paciente_estado
					WHERE c.id_region = ".$id_region;
        
        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
			return $result->rows;
        }else{
            return NULL;
        }
    }
    
    /**
	 * Descripción : Ver Información de Paciente por Id
	 * @author  S/N
     * @param   int $id_paciente
	 */
	public function verInfoById($id_paciente) {
        $query = "  SELECT
                        IFNULL(paciente.id_paciente,0) as id_paciente,
                        IFNULL(paciente.id_prevision,0) as id_prevision,
                        IFNULL(paciente.gl_rut,'N/D') as gl_rut,
                        IFNULL(paciente.bo_extranjero,0) as bo_extranjero,
                        IFNULL(paciente.gl_run_pass,'N/D') as gl_run_pass,
                        IFNULL(paciente.gl_nombres,'N/D') as gl_nombres,
                        IFNULL(paciente.gl_apellidos,'N/D') as gl_apellidos,
                        date_format(paciente.fc_nacimiento,'%d-%m-%Y') as fc_nacimiento,
                        IFNULL(paciente.gl_sexo,'N/D') as gl_sexo,
                        IFNULL(paciente.gl_direccion,'N/D') as gl_direccion,
                        IFNULL(paciente.gl_fono,'N/D') as gl_fono,
                        IFNULL(paciente.gl_celular,'N/D') as gl_celular,
                        IFNULL(paciente.gl_email,'N/D') as gl_email,
                        IFNULL(paciente.gl_latitud,'') as gl_latitud,
                        IFNULL(paciente.gl_longitud,'') as gl_longitud,
                        IFNULL(paciente.bo_fono_seguro,0) as bo_fono_seguro,
                        IFNULL(bo_reconoce,0) as bo_reconoce,
                        IFNULL(bo_acepta_programa,0) as bo_acepta_programa,
                        IFNULL(a.gl_path,'') as gl_path,
                        IFNULL(p.gl_nombre_prevision, 'N/D') as gl_nombre_prevision,
                        IFNULL(c.gl_nombre_comuna, 'N/D') as gl_nombre_comuna,
                        IFNULL(r.gl_nombre_region, 'N/D') as gl_nombre_region,
                        IFNULL(CONCAT(u.gl_nombres, ' ',u.gl_apellidos),'N/D') as gl_nombre_usuario_crea,
                        IFNULL(ec.gl_nombre_estado_caso, 'N/D') as gl_nombre_estado_caso,
                        IFNULL(i.gl_nombre_establecimiento, 'N/D') as gl_nombre_institucion,
                        IF(paciente.bo_extranjero=1,paciente.gl_run_pass,paciente.gl_rut) AS gl_identificacion
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

    /**
	 * Descripción : Obtiene Información de Paciente Extranjero
	 * @author  S/N
     * @param   string $pasaporte
	 */
	public function getByPasaporte($pasaporte) {
        $query = "  SELECT 
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

    /**
	 * Descripción : Obtiene cantida de Pacientes por Id de Región
	 * @author  S/N
     * @param   int $id_region
	 */
	public function countPacientesxRegion($id_region){
        $query = "  SELECT 
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

    /**
	 * Descripción : Insertar Paciente
	 * @author  S/N
     * @param   array  $parametros
	 */
    public function insertarPaciente($parametros){
        $query	= "	INSERT INTO pre_paciente (
						id_institucion,
						id_region,
						id_comuna,
						id_prevision,
						id_tipo_grupo,
						gl_grupo_tipo,
						gl_rut,
						bo_extranjero,
						gl_run_pass,
						gl_nombres,
						gl_apellidos,
						fc_nacimiento,
						gl_direccion,
						gl_fono,
						bo_fono_seguro,
						gl_celular,
						gl_email,
						id_centro_salud,
						gl_latitud,
						gl_longitud,
						bo_reconoce,
						bo_acepta_programa,
						gl_codigo_fonasa,
						fc_crea,
						id_usuario_crea
                    ) VALUES (
						".$_SESSION['id_institucion'].",
						".$parametros['region'].",
						".$parametros['comuna'].",
						".$parametros['prevision'].",
						'".$parametros['id_tipo_grupo']."',
						'".$parametros['gl_grupo_tipo']."',
						'".$parametros['rut']."',
						'".$parametros['chkextranjero']."',
						'".$parametros['inputextranjero']."',
						'".$parametros['nombres']."',
						'".$parametros['apellidos']."',
						".Fechas::formatearBaseDatos(str_replace("'","",$parametros['fc_nacimiento'])).",
						'".$parametros['direccion']."',
						'".$parametros['fono']."',
						".$parametros['fono_seguro'].",
						'".$parametros['celular']."',
						'".$parametros['email']."',
						'".$parametros['centrosalud']."',
						'".$parametros['gl_latitud']."',
						'".$parametros['gl_longitud']."',
						'".$parametros['chkReconoce']."',
						".$parametros['chkAcepta'].",
						'".$parametros['gl_codigo_fonasa']."',
						now(),
						".$_SESSION['id']."
					)";
        
        if ($this->db->execQuery($query)) {
            return $this->db->getLastId();
        } else {
            return NULL;
        }
    }
    
    /**
	 * Descripción : Obtiene Información de Paciente por Id
	 * @author  S/N
     * @param   int $id_paciente
	 */
    public function getByIdPaciente($id_paciente) {
        $query = "  SELECT
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
                        pac.bo_fono_seguro,
                        date_format(pac.fc_crea,'%d-%m-%Y') AS fc_crea,
                        cs.gl_nombre_establecimiento,
                        pac.id_centro_salud, 
                        pac.gl_latitud, 
                        pac.gl_longitud,
                        date_format(pac.fc_actualiza,'%d-%m-%Y'),
                        pac.id_usuario_crea, 
                        pac.id_usuario_actualiza
                    FROM pre_paciente pac
                    LEFT JOIN pre_comuna com on com.id_comuna = pac.id_comuna
                    LEFT JOIN pre_provincia pro on pro.id_provincia = com.id_provincia
                    LEFT JOIN pre_region rg on rg.id_region = pro.id_region
                    LEFT JOIN pre_centro_salud cs on cs.id_centro_salud = pac.id_centro_salud
                    LEFT JOIN pre_prevision pre on pre.id_prevision = pac.id_prevision
                    LEFT JOIN pre_paciente_estado est on est.id_paciente_estado = pac.id_paciente_estado
                    WHERE pac.id_paciente = ?";

        $param = array($id_paciente);
        $result = $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows->row_0;
        } else {
            return NULL;
        }
    }
	
    /**
	 * Descripción : Actualiza Paciente
	 * @author  S/N
     * @param   array  $parametros
	 */
	public function updatePaciente($parametros){
		$query = "  UPDATE pre_paciente 
                    SET gl_nacionalidad				= ".$parametros['gl_nacionalidad'].",
						gl_direccion_alternativa    = ".$parametros['gl_direccion_alternativa'].",
						id_estado_civil				= ".$parametros['id_estado_civil'].",
						nr_hijos					= ".$parametros['nr_hijos'].",
						id_tipo_ocupacion			= ".$parametros['id_tipo_ocupacion'].",
						id_tipo_escolaridad			= ".$parametros['id_tipo_escolaridad'].",
						fc_reconoce					= ".Fechas::formatearBaseDatos(str_replace("'","",$parametros['fc_reconoce'])).",
						fc_hora_reconoce			= ".$parametros['fc_hora_reconoce'].",
						gl_acompañante				= ".$parametros['gl_acompañante'].",
						bo_reconoce					= 1,
						fc_actualiza				= now()
					WHERE id_paciente = ".$parametros['id_paciente']."";

        if($this->db->execQuery($query)) {
            return TRUE;
        }else{
            return FALSE;
        }
	}
	
    /**
	 * Descripción : Busca Paciente
	 * @author  S/N
     * @param   array  $parametros
	 */
	public function buscarPaciente($parametros){
		$query = "  SELECT
						paciente.id_paciente,
                        paciente.gl_rut,
                        paciente.gl_run_pass,
                        paciente.bo_reconoce,
                        paciente.bo_acepta_programa,
                        paciente.gl_nombres,
                        paciente.gl_apellidos,
                        date_format(paciente.fc_crea,'%d-%m-%Y') as fc_crea,
                        IF(paciente.bo_extranjero=1,paciente.gl_run_pass,paciente.gl_rut) as gl_identificacion,
                        i.gl_nombre_establecimiento as gl_institucion,
                        c.gl_nombre_comuna,
                        e.gl_nombre_estado_caso,
                        e.id_paciente_estado,
                        (select count(*) from pre_paciente_registro where pre_paciente_registro.id_paciente = paciente.id_paciente ) as nr_motivo_consulta,
                        (SELECT COUNT(*) FROM pre_paciente_examen paciente_examen 
                         WHERE paciente_examen.id_paciente = paciente.id_paciente
                         AND paciente_examen.gl_resultado = 'A') AS nr_examen_alterado,
                        datediff(now(),paciente.fc_crea) as nr_dias_primera_visita
					FROM pre_paciente paciente
					LEFT JOIN pre_centro_salud i ON i.id_centro_salud = paciente.id_institucion
                    LEFT JOIN pre_comuna c ON c.id_comuna = paciente.id_comuna
                    LEFT JOIN pre_paciente_estado e ON e.id_paciente_estado = paciente.id_paciente_estado
					WHERE 1 ";

		if(!empty($parametros["rut"])){
				$query	.= " AND paciente.gl_rut = '" . $parametros["rut"] . "'";
		}
		if(!empty($parametros["pasaporte"])){
				$query	.= " AND paciente.gl_run_pass LIKE '%" . $parametros["pasaporte"] . "%'";
		}
		if(!empty($parametros["nombres"])){
				$query	.= " AND paciente.gl_nombres LIKE '%" . $parametros["nombres"] . "%'";
		}
		if(!empty($parametros["apellidos"])){
				$query	.= " AND paciente.gl_apellidos LIKE '%" . $parametros["apellidos"] . "%'";
		}
		if(!empty($parametros["cod_fonasa"])){
				$query	.= " AND paciente.gl_codigo_fonasa LIKE '%" . $parametros["cod_fonasa"] . "%'";
		}
		if(!empty($parametros["centro_salud"])){
				$query	.= " AND paciente.id_institucion = " . $parametros["centro_salud"];
		}
		if(!empty($parametros["region"])){
				$query	.= " AND paciente.id_region = " . $parametros["region"];
		}
		if(!empty($parametros["comuna"])){
				$query	.= " AND paciente.id_comuna = " . $parametros["comuna"];
		}

		$result	= $this->db->getQuery($query);

		if($result->numRows>0){
			return $result->rows;
		}else{
			return NULL;
		}
	}
    
}

?>