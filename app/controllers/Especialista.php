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
		$this->load->javascript(STATIC_FILES . "js/templates/especialista/diagnostico.js");
	}
	
	/**
	* Descripción: Cargar Formulario de Diagnostico
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function diagnostico(){
		Acceso::redireccionUnlogged($this->smarty);

		$parametros			= $this->request->getParametros();
		$id_paciente		= $parametros[0];
		
		//$resp = $this->_Evento->guardarMostrarUltimo(21,0,$id_paciente,"Plan tratamiento Modificado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		
		$this->smarty->assign("id_paciente", $id_paciente);
		$this->smarty->assign("botonAyudaTratamiento", Boton::botonAyuda('Ingrese Datos del Diagnóstico.', '', 'pull-right'));

		$this->_display('Especialista/diagnostico.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/medico/nuevo.js");
		$this->load->javascript(STATIC_FILES . "js/lib/validador.js");
	}
	
	public function GuardarDiagnostico(){
		
	}
	
}