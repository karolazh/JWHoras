<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Modelo para Tabla pre_empa
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 22/02/2017
 * 
 * @name             DAOEmpa.php
 * 
 * @version          1.0
 *
 * @author           David Guzman <david.guzman@cosof.cl>
 * 
 ******************************************************************************
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * ----------------------------------------------------------------------------
 * <orlando.vazquez@cosof.cl>	05-06-2017	Modificadas referencias a campos de la BD antigua
 * ----------------------------------------------------------------------------
 * ****************************************************************************
 */
class DAOEmpa extends Model{

    protected $_tabla		= "pre_empa";
    protected $_primaria	= "id_empa";
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
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene Comunas por Id de Región
	 * @author  S/N
     * @param   int $id_paciente
     * @param   int $nr_orden
	 */
    public function getByIdPaciente($id_paciente, $nr_orden=1){
        $query	=   "SELECT e.*,
							c.gl_nombre_comuna as gl_comuna,
							p.id_comuna as id_comuna_paciente,
							cs.gl_nombre_establecimiento as gl_institucion,
							p.id_centro_salud as id_institucion_paciente,
							date_format(fc_empa,'%Y-%m-%d') AS fc_empa
					FROM pre_empa e
					LEFT JOIN pre_paciente p ON p.id_paciente = e.id_paciente
					LEFT JOIN pre_comuna c ON c.id_comuna = p.id_comuna
					LEFT JOIN pre_centro_salud cs ON cs.id_centro_salud = p.id_centro_salud
                    WHERE e.id_paciente = ?
                    AND e.nr_orden = ?";

	$param	= array($id_paciente,$nr_orden);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Obtiene Lista de Empa x Id de Paciente para Grilla
	 * @author  Carolina Zamora <carolina.zamora@cosof.cl>
     * @param   int $id_paciente
     * @param   int $nr_orden
	 */
    public function getListaEmpa($id_paciente, $nr_orden=1){
        $query = "  SELECT 
                        emp.id_empa,
                        emp.bo_finalizado,
                        emp.id_paciente,
                        date_format(emp.fc_empa,'%d-%m-%Y') AS fc_empa,
                        date_format(emp.fc_crea,'%d-%m-%Y') AS fc_crea,
                        pac.gl_rut,
                        pac.bo_extranjero,
                        pac.gl_run_pass,
                        cs.gl_nombre_establecimiento,
                        cs.id_comuna,
                        com.gl_nombre_comuna,
                        usr.gl_rut,
                        concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS funcionario                        
                    FROM pre_empa emp
                    LEFT JOIN pre_paciente pac ON pac.id_paciente = emp.id_paciente
                    LEFT JOIN pre_centro_salud cs ON cs.id_centro_salud = pac.id_institucion
                    LEFT JOIN pre_comuna com ON com.id_comuna = pac.id_comuna
                    LEFT JOIN pre_usuario usr ON usr.id_usuario = emp.id_usuario_crea
                    WHERE emp.id_paciente = ?
                    AND nr_orden = ?
                    -- AND bo_finalizado = 0
                    ORDER BY emp.fc_empa DESC";

        $param	= array($id_paciente,$nr_orden);
        $result	= $this->db->getQuery($query,$param);

        if($result->numRows > 0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Actualiza tabla "pre_empa"
	 * @author  David Guzman <david.guzman@cosof.cl>
     * @param   array  $parametros
	 */
    public function updateEmpa($parametros){
        $query = "  UPDATE pre_empa SET
						gl_sector						= ".$parametros['gl_sector'].",
						nr_ficha						= ".$parametros['nr_ficha'].",
						fc_empa							= ".Fechas::formatearBaseDatos(str_replace("'","",$parametros['fc_empa'])).",
						bo_embarazo						= ".$parametros['bo_embarazo'].",
						bo_consume_alcohol				= ".$parametros['bo_consume_alcohol'].",
						gl_puntos_audit					= ".$parametros['gl_puntos_audit'].",
						bo_fuma							= ".$parametros['bo_fuma'].",
						gl_peso							= ".$parametros['gl_peso'].",
						gl_estatura						= ".$parametros['gl_estatura'].",
						gl_imc							= ".$parametros['gl_imc'].",
						gl_circunferencia_abdominal		= ".$parametros['gl_circunferencia_abdominal'].",
						id_clasificacion_imc			= ".$parametros['id_clasificacion_imc'].",
						gl_pas							= ".$parametros['gl_pas'].",
						gl_pad							= ".$parametros['gl_pad'].",
						bo_antecedente_diabetes			= ".$parametros['bo_antecedente_diabetes'].",
						gl_glicemia						= ".$parametros['gl_glicemia'].",
						bo_glicemia_toma				= ".$parametros['bo_glicemia_toma'].",
						bo_trabajadora_reclusa			= ".$parametros['bo_trabajadora_reclusa'].",
						bo_vdrl							= ".$parametros['bo_vdrl'].",
						bo_rpr							= ".$parametros['bo_rpr'].",
						bo_vih							= ".$parametros['bo_vih'].",	
						bo_tos_productiva				= ".$parametros['bo_tos_productiva'].",
						bo_baciloscopia_toma			= ".$parametros['bo_baciloscopia_toma'].",
						bo_pap_realizado				= ".$parametros['bo_pap_realizado'].",
						bo_pap_resultado				= ".$parametros['bo_pap_resultado'].",
						fc_ultimo_pap_ano				= ".$parametros['fc_ultimo_pap_ano'].",	
						fc_ultimo_pap_mes				= ".$parametros['fc_ultimo_pap_mes'].",	
						bo_pap_vigente					= ".$parametros['bo_pap_vigente'].",
						bo_pap_toma						= ".$parametros['bo_pap_toma'].",
						gl_colesterol					= ".$parametros['gl_colesterol'].",
						bo_colesterol_toma				= ".$parametros['bo_colesterol_toma'].",
						bo_mamografia_realizada			= ".$parametros['bo_mamografia_realizada'].",
						bo_mamografia_resultado_pasado	= ".$parametros['bo_mamografia_resultado_pasado'].",
						bo_mamografia_resultado			= ".$parametros['bo_mamografia_resultado'].",
						fc_mamografia_ano				= ".$parametros['fc_mamografia_ano'].",	
						fc_mamografia_mes				= ".$parametros['fc_mamografia_mes'].",	
						bo_mamografia_vigente			= ".$parametros['bo_mamografia_vigente'].",
						bo_mamografia_toma				= ".$parametros['bo_mamografia_toma'].",
						bo_mamografia_requiere			= ".$parametros['bo_mamografia_requiere'].",
						gl_observaciones_empa			= ".$parametros['gl_observaciones_empa'].",
						bo_finalizado					= 0,
						fc_actualiza					= now(),
						id_usuario_actualiza			= ".$_SESSION['id']."
					WHERE id_empa = ".$parametros['id_empa']."";

        if($this->db->execQuery($query)) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /** 
     * Parametros para usar despues mas completo con id's de examenes
     	id_examen_glicemia              =       ".$parametros['id_examen_glicemia'].",
		id_examen_vdrl                  =       ".$parametros['id_examen_vdrl'].",
		id_examen_rpr                   =       ".$parametros['id_examen_rpr'].",
		id_examen_baciloscopia          =       ".$parametros['id_examen_baciloscopia'].",
		id_examen_pap                   =       ".$parametros['id_examen_pap'].",
		id_examen_colesterol            =       ".$parametros['id_examen_colesterol'].",
		id_examen_mamografia            =       ".$parametros['id_examen_mamografia'].",
	*/
    
    /**
	 * Descripción : Obtiene información de Empa por Id
	 * @author  S/N
     * @param   int $id_empa
	 */
	public function verInfoById($id_empa) {
        $query = "  SELECT 
						pre_empa.*,
						IFNULL(gl_sector,0) as gl_sector,
						IFNULL(fc_mamografia,0) as fc_mamografia,
						IFNULL(bo_embarazo,-1) as bo_embarazo,
						IFNULL(bo_consume_alcohol,-1) as bo_consume_alcohol,
						IFNULL(bo_fuma,-1) as bo_fuma,
						IFNULL(bo_trabajadora_reclusa,-1) as bo_trabajadora_reclusa,
						IFNULL(bo_vdrl,-1) as bo_vdrl,
						IFNULL(bo_rpr,-1) as bo_rpr,
						IFNULL(bo_tos_productiva,-1) as bo_tos_productiva,
						IFNULL(bo_baciloscopia_toma,-1) as bo_baciloscopia_toma,
						IFNULL(bo_antecedente_diabetes,-1) as bo_antecedente_diabetes,
						IFNULL(bo_pap_realizado,-1) as bo_pap_realizado,
						IFNULL(bo_pap_resultado,-1) as bo_pap_resultado,
						IFNULL(bo_pap_vigente,-1) as bo_pap_vigente,
						IFNULL(bo_pap_toma,-1) as bo_pap_toma,
						IFNULL(bo_mamografia_realizada,-1) as bo_mamografia_realizada,
						IFNULL(bo_mamografia_resultado_pasado,-1) as bo_mamografia_resultado_pasado,
						IFNULL(bo_mamografia_resultado,-1) as bo_mamografia_resultado,
						IFNULL(bo_mamografia_vigente,-1) as bo_mamografia_vigente,
						IFNULL(bo_mamografia_requiere,-1) as bo_mamografia_requiere
					FROM pre_empa
					WHERE id_empa = ?";

		$param	= array($id_empa);
        $result	= $this->db->getQuery($query, $param);

        if($result->numRows > 0) {
			return $result->rows->row_0;
        }else{
			return NULL;
        }
    }
	
    /**
	 * Descripción : Actualiza estado de Empa (Finalizado)
	 * @author  David Guzman <david.guzman@cosof.cl>
     * @param   array  $parametros
	 */
	public function updateFinalizado($parametros){
        $query = "  UPDATE pre_empa 
                    SET bo_finalizado	= 1
					WHERE id_empa = ".$parametros['id_empa']."";

        if($this->db->execQuery($query)) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

}
    
?>