<?php

/**
 * *****************************************************************************
 * Sistema          : PREVENCION DE FEMICIDIOS
 * Descripcion      : Controller para Exámenes de Pacientes
 * Plataforma       : !PHP
 * Creacion         : 15/03/2017
 * @name			Agenda.php
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
class Agenda extends Controller {
    
    protected $_DAOPaciente;
    protected $_DAOPacienteExamen;
    protected $_DAOPacienteDireccion;
    protected $_DAOLaboratorio;
    protected $_DAOTipoExamen;

	function __construct() {
		parent::__construct();
        $this->load->lib('Fechas', false);
        $this->load->lib('Seguridad', false);
		$this->_DAOPaciente				= $this->load->model("DAOPaciente");
        $this->_DAOPacienteExamen		= $this->load->model("DAOPacienteExamen");
        $this->_DAOPacienteDireccion	= $this->load->model("DAOPacienteDireccion");
        $this->_DAOLaboratorio			= $this->load->model("DAOLaboratorio");
        $this->_DAOTipoExamen			= $this->load->model("DAOTipoExamen");
	}

    /**
	 * Descripción: Index Agenda
	 * @author Carolina Zamora Hormazábal
	 */
	public function index() {
		Acceso::redireccionUnlogged($this->smarty);
        //
	}
    
    /**
	 * Descripción: Ver Agenda de Examenes
	 * @author Carolina Zamora Hormazábal
	 */
    public function ver() {
        Acceso::redireccionUnlogged($this->smarty);
		$sesion = New Zend_Session_Namespace("usuario_carpeta");
        
        $parametros = $this->request->getParametros();
        $id_paciente = $parametros[0];
        
        //Grilla Exámenes x Paciente
        $arrExamenes = $this->_DAOPacienteExamen->getByIdPaciente($id_paciente);
        
        //Datos de Paciente
        $detPaciente = $this->_DAOPaciente->getByIdPaciente($id_paciente);        
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
            $direccion = "";
            $comuna = "";
            $provincia = "";
            $region = "";
            $detDireccion = $this->_DAOPacienteDireccion->getByIdDireccionVigente($id_paciente);
            if (!is_null($detDireccion)) {
                $direccion = $detDireccion->gl_direccion;
                $comuna = $detDireccion->gl_nombre_comuna;
                $provincia = $detDireccion->gl_nombre_provincia;
                $region = $detDireccion->gl_nombre_region;
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
        }
        
        $this->smarty->assign('arrExamenes', $arrExamenes);
        $this->smarty->display('agenda/ver.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/agenda/agenda.js");
	}
    
    /**
	 * Descripción: Ver Agenda de Examenes
	 * @author Carolina Zamora Hormazábal
	 */
    public function agendar() {
        Acceso::redireccionUnlogged($this->smarty);
		$sesion = New Zend_Session_Namespace("usuario_carpeta");
        
        $parametros = $this->request->getParametros();
        $id_paciente = $parametros[0];
        $id_examen = $parametros[1];
        if (isset($parametros[2])) {
            $id_empa = $parametros[2]; //$_SESSION['id_empa']; //""; //
        } else {
            $id_empa = "";
        }
        
        //Combo Laboratorios
        $arrLaboratorios = $this->_DAOLaboratorio->getLista();
        //Combos Tipo Examen
        $arrTipoExamen = $this->_DAOTipoExamen->getLista();
        
        $this->smarty->assign("id_paciente", $id_paciente);
        $this->smarty->assign("id_examen", $id_examen);
        $this->smarty->assign("id_empa", $id_empa);
        
        $this->smarty->assign('arrLaboratorios', $arrLaboratorios);
        $this->smarty->assign('arrTipoExamen', $arrTipoExamen);
        $this->smarty->display('agenda/agendar.tpl');
        $this->load->javascript(STATIC_FILES . 'js/templates/agenda/ver.js');        
    }
    
    /**
	 * Descripción: Guardar Fecha/Hora Paciente en Agenda
	 * @author Carolina Zamora Hormazábal
     * @return JSON
	 */
    public function guardarAgenda() {
        header('Content-type: application/json');

        $correcto = false;
        $error = true;
        
        $id_examen = $_POST['id_examen'];
        $id_paciente = $_POST['id_paciente'];
        if ($_POST['id_empa'] != "") { 
            $id_empa = $_POST['id_empa'];
        } else {
            $id_empa = NULL;
        }
        $fecha_agenda = $_POST['fecha_agenda'];
        if ($_POST['hora_agenda'] != "") {
            $hora_agenda = $_POST['hora_agenda'];
        } else {
            $hora_agenda = NULL;
        }
        $observacion = $_POST['observacion'];
        
        $ins_agenda = array('id_tipo_examen' => $id_examen,
                            'id_paciente' => $id_paciente,
                            'id_empa' => $id_empa,
                            'fc_toma' => $fecha_agenda,
                            'gl_hora_toma' => $hora_agenda,
                            'gl_observacion_toma' => $observacion,
                            'fc_crea' => date('Y-m-d h:m:s'),
                            'id_usuario_crea' => $_SESSION['id'],
                        );

        $id_agenda = $this->_DAOPacienteExamen->insert($ins_agenda);
        if ($id_agenda) {
            $correcto = true;
        } else {
            $error = true;
        }

        $salida = array("error"    => $error,
                        "correcto" => $correcto);

        $this->smarty->assign("hidden", "");
        $json = Zend_Json::encode($salida);

        echo $json;
    }
}