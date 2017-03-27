<?php

/**
 * *****************************************************************************
 * Sistema          : PREVENCION DE FEMICIDIOS
 * Descripcion      : Controller para Exámenes de Pacientes
 * Plataforma       : !PHP
 * Creacion         : 10/03/2017
 * @name			Laboratorio.php
 * @version         1.0
 * @author          Carolina Zamora <carolina.zamora@cosof.cl>
 * =============================================================================
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * -----------------------------------------------------------------------------
 * 
 * -----------------------------------------------------------------------------
 * *****************************************************************************
 */
class Laboratorio extends Controller {
    
    protected $_Evento;
    protected $_DAOPaciente;
    protected $_DAOPacienteExamen;
    protected $_DAOPacienteDireccion;
    protected $_DAOLaboratorio;
    protected $_DAOTipoExamen;
    protected $_DAOEmpa;

	function __construct() {
		parent::__construct();
        $this->load->lib('Boton', false);
		$this->load->lib('Fechas', false);
        $this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);
		$this->_Evento = new Evento();
		$this->_DAOEvento				= $this->load->model("DAOEvento");
        $this->_DAOPaciente				= $this->load->model("DAOPaciente");
        $this->_DAOPacienteExamen		= $this->load->model("DAOPacienteExamen");
        $this->_DAOPacienteDireccion	= $this->load->model("DAOPacienteDireccion");
        $this->_DAOLaboratorio			= $this->load->model("DAOLaboratorio");
        $this->_DAOTipoExamen			= $this->load->model("DAOTipoExamen");
        $this->_DAOEmpa					= $this->load->model("DAOEmpa");
	}

    /**
	 * Descripción: Index Laboratorio
	 * @author Carolina Zamora <carolina.zamora@cosof.cl>
	 */
	public function index() {
		Acceso::redireccionUnlogged($this->smarty);

        if (isset($_SESSION['id_laboratorio'])) {
            $arrResultado = $this->_DAOPacienteExamen->getByIdLaboratorio($_SESSION['id_laboratorio']);
        } else {
            $arrResultado = $this->_DAOPacienteExamen->getListaDetalle();
        }
		
        $this->smarty->assign('arrResultado', $arrResultado);
		$this->smarty->assign('titulo', 'Examenes');
		$this->_display('grilla/pacientes.tpl');
	}
    
    /**
	 * Descripción: Ver examenes por paciente seleccionado
	 * @author Carolina Zamora <carolina.zamora@cosof.cl>
	 */
    public function ver() {
        Acceso::redireccionUnlogged($this->smarty);
		$sesion = New Zend_Session_Namespace("usuario_carpeta");
        
        $parametros     = $this->request->getParametros();
        $id_paciente    = $parametros[0];
        $perfil         = $_SESSION['perfil'];
        
        //Combo Laboratorios
        $arrLaboratorios = $this->_DAOLaboratorio->getLista();
        //Combos Tipo Examen
        $arrTipoExamen   = $this->_DAOTipoExamen->getLista();
        //Grilla Exámenes x Paciente
        $arrExamenes     = $this->_DAOPacienteExamen->getByIdPaciente($id_paciente);
        $arrExamenesEmpa = $this->_DAOTipoExamen->getLista();
        
        //Datos de Paciente
        $detPaciente     = $this->_DAOPaciente->getByIdPaciente($id_paciente);
        if (!is_null($detPaciente)) {
            $run = "";
            if ($detPaciente->bo_extranjero == 0) {
                $run = $detPaciente->gl_rut;
            } else {
                $run = $detPaciente->gl_run_pass;
            }
            $nombres = $detPaciente->gl_nombres.' '.$detPaciente->gl_apellidos;
            $edad = Fechas::calcularEdadInv($detPaciente->fc_nacimiento);
            if ($detPaciente->gl_sexo == "F") {
                $sexo = "FEMENINO";
            } else {
                $sexo = $detPaciente->gl_sexo;
            }
            $reconoce = "NO";
            if (!is_null($detPaciente->bo_reconoce)) {
                if ($detPaciente->bo_reconoce) {
                    $reconoce = "SI";
                }
            }
            $acepta = "NO";
            if (!is_null($detPaciente->bo_acepta_programa)) {
                if ($detPaciente->bo_acepta_programa) {
                    $acepta = "SI";
                }
            }
            //Dirección Vigente de Paciente
            $direccion  = "";
            $comuna     = "";
            $provincia  = "";
            $region     = "";
            $detDireccion = $this->_DAOPacienteDireccion->getByIdDireccionVigente($id_paciente);
            if (!is_null($detDireccion)) {
                $direccion  = $detDireccion->gl_direccion;
                $comuna     = $detDireccion->gl_nombre_comuna;
                $provincia  = $detDireccion->gl_nombre_provincia;
                $region     = $detDireccion->gl_nombre_region;
            }
            
            $this->smarty->assign("id_paciente", $id_paciente);
            $this->smarty->assign("run", $run);
            $this->smarty->assign("nombres", $nombres);
            $this->smarty->assign("fc_nacimiento", $detPaciente->fc_nacimiento);
            $this->smarty->assign("edad", $edad);
            $this->smarty->assign("gl_sexo", $sexo);
            $this->smarty->assign("gl_nombre_estado_caso", $detPaciente->gl_nombre_estado_caso);
            $this->smarty->assign("gl_nombre_prevision", $detPaciente->gl_nombre_prevision);
            $this->smarty->assign("gl_grupo_tipo", $detPaciente->gl_grupo_tipo);
            $this->smarty->assign("gl_fono", $detPaciente->gl_fono);
            $this->smarty->assign("gl_celular", $detPaciente->gl_celular);
            $this->smarty->assign("gl_email", $detPaciente->gl_email);
            $this->smarty->assign("fc_crea", $detPaciente->fc_crea);
            $this->smarty->assign("bo_reconoce", $reconoce);
            $this->smarty->assign("bo_acepta_programa", $acepta);
            $this->smarty->assign("gl_nombre_comuna", $comuna);
            $this->smarty->assign("gl_nombre_provincia", $provincia);
            $this->smarty->assign("gl_nombre_region", $region);
            $this->smarty->assign("gl_direccion", $direccion);
            //Caro 17-03-2017: Agrega Centro de Salud
            $this->smarty->assign("id_centro_salud", $detPaciente->id_centro_salud);
        }
        
        $this->smarty->assign("perfil", $perfil);
        $this->smarty->assign('arrLaboratorios', $arrLaboratorios);
        $this->smarty->assign('arrTipoExamen', $arrTipoExamen);
        $this->smarty->assign('arrExamenes', $arrExamenes);
        $this->_display('laboratorio/ver.tpl');
        $this->load->javascript(STATIC_FILES . 'js/templates/laboratorio/ver.js');
	}
    
    /**
	 * Descripción: Buscar detalle de examen agendado
	 * @author Carolina Zamora <carolina.zamora@cosof.cl>
     * @return 
	 */
    public function buscar() {
        $parametros			= $this->request->getParametros();
        $accion				= $parametros[0]; //1="Ver" //2="Editar"
        $id_paciente_examen	= $parametros[1];
        $perfil				= $_SESSION['perfil'];
        
        //Detalle de Examen
        $detExamen = $this->_DAOPacienteExamen->getById($id_paciente_examen);
        if (!is_null($detExamen)) {
            $id_tipo_examen = $detExamen->id_tipo_examen;
            $id_paciente    = $detExamen->id_paciente;
            $id_laboratorio = $detExamen->id_laboratorio;
            //guarda id_empa para validar origen de examen
            if (!is_null($detExamen->id_empa)) {
                $id_empa = $detExamen->id_empa;
            } else {
                $id_empa = "";
            }
            
            if ($accion == "1") { //"Ver"
                $rut_lab    = $detExamen->gl_rut_persona_toma;
                $nombre_lab = $detExamen->gl_nombre_persona_toma;
            } else {
                $rut_lab    = $_SESSION['rut'];
                $nombre_lab = $_SESSION['nombre'];
            }
            
            //Datos de Ingreso
            $gl_folio            = $detExamen->gl_folio;
            $fc_toma             = $detExamen->fc_toma;
            $gl_hora_toma        = $detExamen->gl_hora_toma;
            $gl_observacion_toma = $detExamen->gl_observacion_toma;
            
            //Datos de registro
            $gl_resultado_0 = "";
            $gl_resultado_1 = "";
            $fc_resultado   = $detExamen->fc_resultado;
            if (($id_tipo_examen == 2) or ($id_tipo_examen == 3) or ($id_tipo_examen == 3)) {
                if ($detExamen->gl_resultado == "P") {
                    $gl_resultado_0 = "checked";
                } else if ($detExamen->gl_resultado == "N") {
                    $gl_resultado_1 = "checked";
                }
            } else {
                if ($detExamen->gl_resultado == "N") {
                    $gl_resultado_0 = "checked";
                } else if ($detExamen->gl_resultado == "A") {
                    $gl_resultado_1 = "checked";
                }
            }
            $gl_resultado_descripcion = $detExamen->gl_resultado_descripcion;
            $gl_resultado_indicacion  = $detExamen->gl_resultado_indicacion;
            $gl_pad                   = $detExamen->gl_pad;
            $gl_pas                   = $detExamen->gl_pas;
            $gl_glicemia              = $detExamen->gl_glicemia;
            $gl_colesterol            = $detExamen->gl_colesterol;
			
			//Combo Laboratorios
			$arrLaboratorios = $this->_DAOLaboratorio->getLista();
			//Combos Tipo Examen
			$arrTipoExamen   = $this->_DAOTipoExamen->getLista();
			
			$this->smarty->assign("id_paciente_examen", $id_paciente_examen);
			$this->smarty->assign("id_tipo_examen", $id_tipo_examen);
			$this->smarty->assign("id_paciente", $id_paciente);
			$this->smarty->assign("id_laboratorio", $id_laboratorio);
            $this->smarty->assign("id_empa", $id_empa);
			$this->smarty->assign("rut_lab", $rut_lab);
			$this->smarty->assign("nombre_lab", $nombre_lab);
			$this->smarty->assign("gl_folio", $gl_folio);
			$this->smarty->assign("fc_toma", $fc_toma);
			$this->smarty->assign("gl_hora_toma", $gl_hora_toma);
			$this->smarty->assign("gl_observacion_toma", $gl_observacion_toma);
			$this->smarty->assign("fc_resultado", $fc_resultado);
			$this->smarty->assign("gl_resultado_0", $gl_resultado_0);
			$this->smarty->assign("gl_resultado_1", $gl_resultado_1);
			$this->smarty->assign("gl_resultado_descripcion", $gl_resultado_descripcion);
			$this->smarty->assign("gl_resultado_indicacion", $gl_resultado_indicacion);
            $this->smarty->assign("gl_pad", $gl_pad);
            $this->smarty->assign("gl_pas", $gl_pas);
            $this->smarty->assign("gl_glicemia", $gl_glicemia);
            $this->smarty->assign("gl_colesterol", $gl_colesterol);
			$this->smarty->assign("arrLaboratorios", $arrLaboratorios);
			$this->smarty->assign("arrTipoExamen", $arrTipoExamen);
        }
		$this->smarty->assign("perfil", $perfil);
		$this->smarty->assign("accion", $accion);
        $this->smarty->display("laboratorio/datosExamen.tpl");
        $this->load->javascript(STATIC_FILES . "js/templates/laboratorio/ver.js");
    }
    
    /**
	 * Descripción: Guardar detalle de examen agendado
	 * @author Carolina Zamora <carolina.zamora@cosof.cl>
     * @return JSON
	 */
    public function guardarExamen() {
        header('Content-type: application/json');

        $correcto = false;
        $error    = true;
        
        $id_perfil  = $_SESSION['perfil'];
        $id_usuario = $_SESSION['id'];
        
        $id_paciente_examen = $_POST['id_paciente_examen'];
        $id_tipo_examen     = $_POST['id_tipo_examen'];
        $id_paciente        = $_POST['id_paciente'];
        $id_empa            = $_POST['id_empa'];
        if ($id_perfil == 7){
            $id_usuario_toma = $id_usuario;
        } else {
            $id_usuario_toma = NULL;
        }
        $gl_rut_toma        = $_POST['gl_rut_toma'];
        $gl_nombre_toma     = $_POST['gl_nombre_toma'];
        if (isset($_POST['gl_folio'])) {
            $gl_folio = $_POST['gl_folio'];
        } else {
            $gl_folio = NULL;
        }
        $fc_resultado       = $_POST['fc_resultado'];
		$fc_resultado       = str_replace("'","",Fechas::formatearBaseDatos($fc_resultado));
        $gl_glicemia        = NULL;
        $gl_colesterol      = NULL;
        $gl_pad             = NULL;
        $gl_pas             = NULL;
        if ($id_tipo_examen == 1){
            $gl_glicemia    = $_POST['gl_glicemia'];
        } elseif ($id_tipo_examen == 7){
            $gl_colesterol  = $_POST['gl_colesterol'];
        } elseif ($id_tipo_examen == 9){
            $gl_pad = $_POST['gl_pad'];
            $gl_pas = $_POST['gl_pas'];
        }
        $gl_resultado             = $_POST['gl_resultado'];
        $gl_resultado_descripcion = $_POST['gl_resultado_descripcion'];
        $gl_resultado_indicacion  = $_POST['gl_resultado_indicacion'];

        $upd_examen = $this->_DAOPacienteExamen->update(array('id_usuario_toma'          => $id_usuario_toma,
                                                              'gl_rut_persona_toma'      => $gl_rut_toma,
                                                              'gl_nombre_persona_toma'   => $gl_nombre_toma,
                                                              'gl_folio'                 => $gl_folio,
                                                              'fc_resultado'             => $fc_resultado,
                                                              'gl_glicemia'              => $gl_glicemia,
                                                              'gl_colesterol'            => $gl_colesterol,
                                                              'gl_pad'                   => $gl_pad,
                                                              'gl_pas'                   => $gl_pas,
                                                              'gl_resultado'             => $gl_resultado,
                                                              'gl_resultado_descripcion' => $gl_resultado_descripcion,
                                                              'gl_resultado_indicacion'  => $gl_resultado_indicacion,
                                                              'id_usuario_actualiza'     => $_SESSION['id']
                                                             ), $id_paciente_examen, 'id_paciente_examen');

        $resultado = NULL;
        if (true) {
            //*** Caro: Actualiza resultado de examen si fue agendado en EMPA ***//
            if ($id_empa != ""){
                if ($id_tipo_examen == 1) { $resp = $this->_DAOEmpa->update(array('gl_glicemia'   => $gl_glicemia), $id_empa, 'id_empa'); }
                if ($id_tipo_examen == 7) { $resp = $this->_DAOEmpa->update(array('gl_colesterol' => $gl_colesterol), $id_empa, 'id_empa'); }
                if ($id_tipo_examen == 9) { $resp = $this->_DAOEmpa->update(array('gl_pad'        => $gl_pad), $id_empa, 'id_empa'); 
                                            $resp = $this->_DAOEmpa->update(array('gl_pas'        => $gl_pas), $id_empa, 'id_empa'); }
                if (($id_tipo_examen == 2) || ($id_tipo_examen == 3) || ($id_tipo_examen == 4)) {
                    //Si examen es "VDRL, RPR, VIH"
                    if ($gl_resultado == "P") {
                        $resultado = 0; //POSITIVO
                    } elseif ($gl_resultado == "N") {
                        $resultado = 1; //NEGATIVO
                    }
                    //actualiza resultado según tipo de examen
                    if ($id_tipo_examen == 2) { $resp = $this->_DAOEmpa->update(array('bo_vdrl' => $resultado), $id_empa, 'id_empa'); }
                    if ($id_tipo_examen == 3) { $resp = $this->_DAOEmpa->update(array('bo_rpr'  => $resultado), $id_empa, 'id_empa'); } 
                    if ($id_tipo_examen == 4) { $resp = $this->_DAOEmpa->update(array('bo_vih'  => $resultado), $id_empa, 'id_empa'); }

                } elseif (($id_tipo_examen == 5) || ($id_tipo_examen == 6) || ($id_tipo_examen == 8)) {
                    //Si examen es "Baciloscipia"/"PAP"/"Mamografía"
                    if ($gl_resultado == "A") {
                        $resultado = 0; //ALTERADO
                    } elseif ($gl_resultado == "N") {
                        $resultado = 1; //NEGATIVO
                    }
                    //actualiza resultado según tipo de examen
                    if ($id_tipo_examen == 5) { $resp = $this->_DAOEmpa->update(array('bo_baciloscopia_resultado' => $resultado), $id_empa, 'id_empa'); }
                    if ($id_tipo_examen == 6) { $resp = $this->_DAOEmpa->update(array('bo_pap_resultado_nuevo'    => $resultado), $id_empa, 'id_empa'); }
                    if ($id_tipo_examen == 8) { $resp = $this->_DAOEmpa->update(array('bo_mamografia_resultado'   => $resultado), $id_empa, 'id_empa'); }
                }
                
                if ($resp) {
                    $correcto = true;
                } else {
                    $error = true;
                }
            } else {
                $correcto = true;
            }   
        } else {
            $error = true;
        }
        
        //Actualiza Grilla Exámenes x Paciente
        //$grilla = "";
        $arrExamenes = $this->_DAOPacienteExamen->getByIdPaciente($id_paciente);
        $this->smarty->assign('arrExamenes', $arrExamenes);
        $grilla = $this->smarty->fetch('laboratorio/grillaExamenesLaboratorio.tpl');
		
        $salida = array("error"     => $error,
                        "correcto"  => $correcto,
                        "grilla"    => $grilla);

        $this->smarty->assign("hidden", "");
        $json = Zend_Json::encode($salida);

        echo $json;
    }
}