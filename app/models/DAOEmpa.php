<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOEmpa.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: 
!Creacion     		: 16/02/2017
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 		: NA
=============================================================================
!ControlCambio
--------------
!cVersion !cFecha   !cProgramador   !cDescripcion 
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

class DAOEmpa extends Model{
    /**
     * @var string 
     */
    protected $_tabla			= "pre_empa";
    protected $_primaria		= "id_empa";
    protected $_transaccional           = false;
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Empa (todos)
     */
    public function getListaEmpa(){
//        $query = $this->db->select("*")->from("tab_empa");
//        $resultado = $query->getResult();
        
        $query = "select * from tab_empa";
        $resultado = $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Ver Empa
     */
    public function getEmpa($id_empa){
        $query = "select * from tab_empa 
                  where id_empa = ?";

        $consulta = $this->db->getQuery($query,array($id_empa));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }

    public function getEmpaByIdRegistro($id_registro){
        $query = "select * from pre_empa 
                  where id_registro = ?
                  and nr_orden = 1";

        $consulta = $this->db->getQuery($query,array($id_registro));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }    
    /*
     * Ver Empa para Grilla
     */
    public function getEmpaGrilla($id_registro){
        $query =    "SELECT 
                        emp.id_empa AS id_empa,
                        emp.id_registro AS id_registro,
                        date_format(emp.fc_empa,'%d-%m-%Y') AS fc_empa,
                        reg.gl_rut AS rut,
                        com.gl_nombre_comuna AS comuna,
                        ins.gl_nombre AS institucion,
                        usr.gl_rut AS rut
                    FROM pre_empa emp
                    LEFT JOIN pre_registro reg ON reg.id_registro = emp.id_registro
                    LEFT JOIN pre_comunas com ON com.id_comuna = emp.id_comuna
                    LEFT JOIN pre_institucion ins ON ins.id_institucion = emp.id_institucion
                    LEFT JOIN pre_usuarios usr ON usr.id_usuario = emp.id_usuario_crea
                    WHERE emp.id_registro =  ?
                    ORDER BY emp.fc_empa DESC";

        $consulta = $this->db->getQuery($query,array($id_registro));
        if($consulta->numRows > 0){
            return $consulta->rows;
        }else{
            return NULL;
        }
    }


    public function updateEmpa($parametros){

        $query	= "	UPDATE pre_empa SET
						id_comuna                       =       ".$_SESSION['id_comuna'].",
						id_sector                       =       ".$parametros['id_sector'].",
						id_institucion                  =       ".$_SESSION['id_institucion'].",
						nr_ficha                        =       ".$parametros['nr_ficha'].",
						fc_empa                         =       '".$parametros['fc_empa']."',
						bo_consume_alcohol              =       ".$parametros['bo_consume_alcohol'].",
						gl_puntos_audit                 =       ".$parametros['gl_puntos_audit'].",
						bo_fuma                         =       ".$parametros['bo_fuma'].",
						gl_peso                         =       '".$parametros['gl_peso']."',
						gl_estatura                     =       '".$parametros['gl_estatura']."',
						gl_imc                          =       '".$parametros['gl_imc']."',
						gl_circunferencia_abdominal     =       '".$parametros['gl_circunferencia_abdominal']."',
						id_clasificacion_imc            =       ".$parametros['id_clasificacion_imc'].",
						gl_pas                          =       '".$parametros['gl_pas']."',
						gl_pad                          =       '".$parametros['gl_pad']."',
                                                gl_glicemia                     =       '".$parametros['gl_peso']."',
						bo_glicemia_toma                =       ".$parametros['bo_glicemia_toma'].",
						bo_trabajadora_reclusa          =       ".$parametros['bo_trabajadora_reclusa'].",
						bo_vdrl                         =       ".$parametros['bo_vdrl'].",
						bo_rpr                          =       ".$parametros['bo_rpr'].",
                                                bo_tos_productiva               =       ".$parametros['bo_tos_productiva'].",
                                                bo_baciloscopia_toma            =       ".$parametros['bo_baciloscopia_toma'].",
                                                bo_pap_realizado                =       ".$parametros['bo_pap_realizado'].",
                                                fc_tomar_pap                    =       ".$parametros['fc_tomar_pap'].",
                                                fc_ultimo_pap                   =       ".$parametros['fc_ultimo_pap'].",
                                                bo_pap_vigente                  =       ".$parametros['bo_pap_vigente'].",
                                                bo_pap_toma                     =       ".$parametros['bo_pap_toma'].",
                                                gl_colesterol                   =       '".$parametros['gl_colesterol']."',
                                                bo_colesterol_toma              =       ".$parametros['bo_colesterol_toma'].",
                                                bo_mamografia_realizada         =       ".$parametros['bo_mamografia_realizada'].",
                                                bo_mamografia_vigente           =       ".$parametros['bo_mamografia_vigente'].",
                                                bo_mamografia_toma              =       ".$parametros['bo_mamografia_toma'].",
                                                gl_observaciones_empa           =       '".$parametros['gl_observaciones_empa']."',
                                                fc_actualiza                    =       '".date('Y-m-d H:i:s')."',
                                                id_usuario_act                  =       ".$_SESSION['id']."
                        WHERE id_empa   = ".$parametros['id_empa']."
                    ";
                  
        if ($this->db->execQuery($query)) {
            return true;
        } else {
            return false;
        }
    }
    
    //Parametros para usar despues mas completo con id's de examenes
    /*
                                                id_comuna                       =       ".$_SESSION['id_comuna'].",
						id_sector                       =       ".$parametros['id_sector'].",
						id_institucion                  =       ".$_SESSION['id_institucion'].",
						nr_ficha                        =       ".$parametros['nr_ficha'].",
						fc_empa                         =       '".$parametros['fc_empa']."',
						bo_consume_alcohol              =       ".$parametros['bo_consume_alcohol'].",
						gl_puntos_audit                 =       ".$parametros['gl_puntos_audit'].",
						bo_fuma                         =       ".$parametros['bo_fuma'].",
						gl_peso                         =       '".$parametros['gl_peso']."',
						gl_estatura                     =       '".$parametros['gl_estatura']."',
						gl_imc                          =       '".$parametros['gl_imc']."',
						gl_circunferencia_abdominal     =       '".$parametros['gl_circunferencia_abdominal']."',
						id_clasificacion_imc            =       '".$parametros['id_clasificacion_imc']."',
						gl_pas                          =       '".$parametros['gl_pas']."',
						gl_pad                          =       '".$parametros['gl_pad']."',
                                                gl_glicemia                     =       '".$parametros['gl_peso']."',
						bo_glicemia_toma                =       ".$parametros['bo_glicemia_toma'].",
						id_examen_glicemia              =       ".$parametros['id_examen_glicemia'].",
						bo_trabajadora_reclusa          =       ".$parametros['bo_trabajadora_reclusa'].",
						bo_vdrl                         =       ".$parametros['bo_vdrl'].",
						id_examen_vdrl                  =       ".$parametros['id_examen_vdrl'].",
						bo_rpr                          =       ".$parametros['bo_rpr'].",
						id_examen_rpr                   =       ".$parametros['id_examen_rpr'].",
                                                bo_tos_productiva               =       ".$parametros['bo_tos_productiva'].",
                                                bo_baciloscopia_toma            =       ".$parametros['bo_baciloscopia_toma'].",
                                                id_examen_baciloscopia          =       ".$parametros['id_examen_baciloscopia'].",
                                                bo_pap_realizado                =       ".$parametros['bo_pap_realizado'].",
                                                fc_ultimo_pap                   =       '".$parametros['fc_ultimo_pap']."',
                                                bo_pap_vigente                  =       ".$parametros['bo_pap_vigente'].",
                                                bo_pap_toma                     =       ".$parametros['bo_pap_toma'].",
                                                id_examen_pap                   =       ".$parametros['id_examen_pap'].",
                                                gl_colesterol                   =       '".$parametros['gl_colesterol']."',
                                                bo_colesterol_toma              =       ".$parametros['bo_colesterol_toma'].",
                                                id_examen_colesterol            =       ".$parametros['id_examen_colesterol'].",
                                                bo_mamografia_realizada         =       ".$parametros['bo_mamografia_realizada'].",
                                                bo_mamografia_vigente           =       ".$parametros['bo_mamografia_vigente'].",
                                                bo_mamografia_toma              =       ".$parametros['bo_mamografia_toma'].",
                                                id_examen_mamografia            =       ".$parametros['id_examen_mamografia'].",
                                                gl_observaciones_empa           =       '".$parametros['gl_observaciones_empa']."',
                                                fc_crea                         =       '".$parametros['fc_crea']."',
                                                fc_actualiza                    =       '".$parametros['fc_actualiza']."',
                                                id_usuario_act                  =       ".$_SESSION['id_usuario']." */
    
    	public function verInfoById($parametros) {
        $query	= "SELECT 
						
						IFNULL(e.gl_email,'N/D') as gl_email,
						IFNULL(e.gl_latitud,'') as gl_latitud,
						IFNULL(e.gl_longitud,'') as gl_longitud,
						IFNULL(bo_reconoce,0) as bo_reconoce,
						IFNULL(bo_acepta_programa,0) as bo_acepta_programa,
						IFNULL(a.gl_path,'') as gl_path,
						IFNULL(p.gl_nombre_prevision, 'N/D') as gl_nombre_prevision,
						IFNULL(c.gl_nombre_comuna, 'N/D') as gl_nombre_comuna,
						IFNULL(r.gl_nombre_region, 'N/D') as gl_nombre_region
					FROM pre_empa AS e
						LEFT JOIN pre_adjuntos AS a USING (id_adjunto)
						LEFT JOIN pre_prevision AS p USING (id_prevision)
						LEFT JOIN pre_comunas AS c USING (id_comuna)
						LEFT JOIN pre_regiones AS r USING (id_region)
						LEFT JOIN pre_usuarios AS u ON rg.id_usuario_crea = u.id_usuario
						LEFT JOIN pre_estados_caso AS ec USING (id_estado_caso)
					WHERE e.id_registro = ".$parametros['id_registro']."
                                        AND e.nr_orden = ".$parametros['nr_orden']."    ";
        $consulta = $this->db->getQuery($query, $parametros);
        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }

}
    
?>