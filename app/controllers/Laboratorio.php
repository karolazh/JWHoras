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
	}

    /**
	 * Descripción: Index Laboratorio
	 * @author Carolina Zamora Hormazábal
	 */
	public function index() {
		Acceso::redireccionUnlogged($this->smarty);

		$arr = $this->_DAOPacienteExamen->getListaDetalle();
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('titulo', 'Examenes');

		$this->_display('laboratorio/index.tpl');
	}
    
    public function ver() {
        Acceso::redireccionUnlogged($this->smarty);
		$sesion = New Zend_Session_Namespace("usuario_carpeta");
        
        $parametros = $this->request->getParametros();
        $id_paciente = $parametros[0];
        
        //Combo Laboratorios
        $arrLaboratorios = $this->_DAOLaboratorio->getLista();
        //Combos Tipo Examen
        $arrTipoExamen = $this->_DAOTipoExamen->getLista();
        //Grilla Exámenes x Paciente
        $arrExamenes = $this->_DAOPacienteExamen->getByIdPaciente($id_paciente);
        //*Pendiente Filtrar por exámenes de paciente*
        $arrExamenesEmpa = $this->_DAOTipoExamen->getLista();
        
        //Datos toma examen
        //Si perfil es "LABORATORIO"
        if ($_SESSION['perfil'] == "7")
        {
            $rut_lab = $_SESSION['rut'];
            $nombre_lab = $_SESSION['nombre'];
        }
        
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
        
        $this->smarty->assign('arrLaboratorios', $arrLaboratorios);
        $this->smarty->assign('arrTipoExamen', $arrTipoExamen);
        $this->smarty->assign('arrExamenes', $arrExamenes);
        $this->smarty->assign("botonNuevoExamen", Boton::botonAyuda("Ingreso de Nuevo Examen", "Ayuda", "", "btn-warning"));        
        //$this->smarty->display('laboratorio/ver.tpl');
        $this->_display('laboratorio/ver.tpl');
        $this->load->javascript(STATIC_FILES . 'js/templates/laboratorio/ver.js');        
		//$this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        //$this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
		//$this->load->javascript('$(".datepicker").datepicker({ todayBtn: true,language: "es",   todayHighlight: true,autoclose: true});');
	}
    
    public function buscarExamen() {
        header('Content-type: application/json');

        $correcto = true;
        $error = false;
        
        //...

        $salida = array("error"    => $error,
                        "correcto" => $correcto);

        $this->smarty->assign("hidden", "");
        $json = Zend_Json::encode($salida);

        echo $json;
    }
}