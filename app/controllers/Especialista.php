<?php

/**
 * ****************************************************************************
 * Sistema		: PREVENCION DE FEMICIDIOS
 * Descripcion	: Controller para las funciones del ROL Especialista
 * Plataforma	: !PHP
 * Creacion		: 08/03/2017
 * @name		Especialista.php
 * @version		1.0
 * @author		David Guzmán <david.guzman@cosof.cl>
 * =============================================================================
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * -----------------------------------------------------------------------------
 *<david.guzman@cosof.cl>		16-03-2017	index
 * -----------------------------------------------------------------------------
 * ****************************************************************************
*/

class Especialista extends Controller {

	protected $_Evento;
	protected $_DAOPaciente;
	protected $_DAOEmpa;
	protected $_DAOTipoEspecialidad;
	protected $_DAOCie10Capitulo;
	protected $_DAOCie10Seccion;
	protected $_DAOPacienteAgendaEspecialista;

	function __construct() {
		parent::__construct();
		$this->load->lib('Fechas', false);
		$this->load->lib('Boton', false);
		$this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);

		$this->_Evento						= new Evento();
		$this->_DAOPaciente					= $this->load->model("DAOPaciente");
		$this->_DAOEmpa						= $this->load->model("DAOEmpa");
		$this->_DAOTipoEspecialidad			= $this->load->model("DAOTipoEspecialidad");
		$this->_DAOPacienteAgendaEspecialista	= $this->load->model("DAOPacienteAgendaEspecialista");
		$this->_DAOCie10Capitulo			= $this->load->model("DAOCie10Capitulo");
		$this->_DAOCie10Seccion			= $this->load->model("DAOCie10Seccion");
	}

	/**
	* Descripción: Cargar Grilla
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function index() {
		Acceso::redireccionUnlogged($this->smarty);
		
		$where	= array('esp.id_especialista'=>$_SESSION['id']);
		$join[]	= array('tabla'=>'pre_paciente_agenda_especialista esp',
						'on'=>'esp.id_paciente',
						'igual'=>'paciente.id_paciente');
		$arr = $this->_DAOPaciente->getListaDetalle($where,$join);
		//$this->smarty->assign('id_usuario', $_SESSION['id']);
		$this->smarty->assign('mostrar_especialista', 1);
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('titulo', 'Pacientes derivados a Especialista');

		$this->_display('Paciente/index.tpl');
	}
	
	/**
	* Descripción: Cargar Formulario de Diagnostico
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function diagnostico(){
		Acceso::redireccionUnlogged($this->smarty);

		$parametros			= $this->request->getParametros();
		$id_paciente		= $parametros[0];
		$empa = $this->_DAOEmpa->getByIdPaciente($id_paciente);
		$arrCIE10Capitulo = $this->_DAOCie10Capitulo->getLista();
		//$resp = $this->_Evento->guardarMostrarUltimo(21,0,$id_paciente,"Plan tratamiento Modificado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		
		$this->smarty->assign("arrCIE10Capitulo", $arrCIE10Capitulo);
		$this->smarty->assign("id_empa", $empa->id_empa);
		$this->smarty->assign("id_paciente", $id_paciente);
		$this->smarty->assign("botonAyudaTratamiento", Boton::botonAyuda('Ingrese Datos del Diagnóstico.', '', 'pull-right'));

		$this->_display('Especialista/diagnostico.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/especialista/diagnostico.js");
		$this->load->javascript(STATIC_FILES . "js/lib/validador.js");
	}
	
	/**
	* Descripción: Guardar Diagnostico Especialista
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function GuardarDiagnostico(){
		header('Content-type: application/json');
		$parametros		= $this->_request->getParams();
		$correcto		= FALSE;
		$error			= FALSE;
		$bool_update = $this->_DAOPacienteAgendaEspecialista->insertAgenda($parametros);
		if ($bool_update) {
			//$resp = $this->_Evento->guardarMostrarUltimo(12,$id_empa,$id_paciente,"Empa modificado el : " . Fechas::fechaHoyVista()." por usuario ".$session->id,1,1,$_SESSION['id']);
			$correcto = TRUE;
		} else {
			$error = TRUE;
		}

		$salida = array("error" => $error,
						"correcto" => $correcto);
		$json = Zend_Json::encode($salida);

		echo $json;
		
	}
	
	public function cargarSeccion1porCie10(){
            $cie10 = $_POST['cie10'];
            //$daoRegion = $this->load->model('DAORegion');
            $seccion1 = $this->_DAOCie10Capitulo->getDetalleByIdCapitulo($cie10);
            $json = array();
            $i = 0;
            foreach($seccion1 as $seccion){
                    $json[$i]['id_indice'] = $seccion->id_indice;
                    $json[$i]['gl_codigo'] = $seccion->gl_codigo;
                    $json[$i]['gl_descripcion'] = $seccion->gl_descripcion;
                    $i++;
            }

            echo json_encode($json);
    }
	
}