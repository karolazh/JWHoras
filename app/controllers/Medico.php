<?php

/**
 * ****************************************************************************
 * Sistema		: PREVENCION DE FEMICIDIOS
 * Descripcion	: Controller para las funciones del ROL Medico
 * Plataforma	: !PHP
 * Creacion		: 08/03/2017
 * @name		Medico.php
 * @version		1.0
 * @author		Victor Retamal <victor.retamal@cosof.co>
 * =============================================================================
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * -----------------------------------------------------------------------------
 *<orlando.vazquez@cosof.cl>	08-03-2017	Agregado Evento
 * -----------------------------------------------------------------------------
 * ****************************************************************************
*/

class Medico extends Controller {

	protected $_Evento;
	protected $_DAOPaciente;
	protected $_DAOEmpa;
	protected $DAOTipoEspecialidad;

	function __construct() {
		parent::__construct();
		$this->load->lib('Fechas', false);
		$this->load->lib('Boton', false);
		$this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);

		$this->_Evento				= new Evento();
		$this->_DAOPaciente			= $this->load->model("DAOPaciente");
		$this->_DAOEmpa				= $this->load->model("DAOEmpa");
		$this->_DAOTipoEspecialidad	= $this->load->model("DAOTipoEspecialidad");
	}

	public function index() {
		Acceso::redireccionUnlogged($this->smarty);

		$where[]	= array('campo'=>'bo_acepta_programa','valor'=>1);
		$arr = $this->_DAOPaciente->getListaDetalle($where);
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('titulo', 'Evaluación');
		$this->smarty->assign('mostrar_plan', 1);

		$this->_display('Paciente/index.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/Paciente/index.js");
	}

	public function plan_tratamiento(){
		Acceso::redireccionUnlogged($this->smarty);

		$parametros			= $this->request->getParametros();
		$id_paciente		= $parametros[0];
		$arrEspecialidad	= $this->_DAOTipoEspecialidad->getLista();
		
		$resp = $this->_Evento->guardarMostrarUltimo(20,0,$id_paciente,"Plan tratamiento Iniciado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		//$resp = $this->_Evento->guardarMostrarUltimo(21,0,$id_paciente,"Plan tratamiento Modificado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		
		$this->smarty->assign("id_paciente", $id_paciente);
		$this->smarty->assign("arrEspecialidad", $arrEspecialidad);
		$this->smarty->assign("botonAyudaTratamiento", Boton::botonAyuda('Ingrese Datos del Tratamiento.', '', 'pull-right'));
		
		$this->_display('medico/tratamiento.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/medico/nuevo.js");
		$this->load->javascript(STATIC_FILES . "js/lib/validador.js");
	}

}