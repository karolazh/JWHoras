<?php

/**
 * ****************************************************************************
 * Sistema		: PREVENCION DE FEMICIDIOS
 * Descripcion	: Controller para las funciones del ROL Gestor
 * Plataforma	: !PHP
 * Creacion		: 20/03/2017
 * @name		Gestor.php
 * @version		1.0
 * @author		David Guzmán <david.guzman@cosof.cl>
 * =============================================================================
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * -----------------------------------------------------------------------------
 *<david.guzman@cosof.cl>		16-03-2017	nacional
 * -----------------------------------------------------------------------------
 * ****************************************************************************
*/

class Gestor extends Controller {

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
	* Descripción: Cargar Grilla Gestor Nacional
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function nacional() {
		Acceso::redireccionUnlogged($this->smarty);
		
		$where	= array('paciente.gl_grupo_tipo'=>'Tratamiento');
		$arr = $this->_DAOPaciente->getListaDetalle($where);
		//$this->smarty->assign('id_usuario', $_SESSION['id']);
		$this->smarty->assign('mostrar_gestor', 1);
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('titulo', 'Pacientes Gestor Nacional');

		$this->_display('Paciente/index.tpl');
	}

	/**
	* Descripción: Cargar Grilla Gestor Regional
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function regional() {
		Acceso::redireccionUnlogged($this->smarty);
		
		$where	= array('paciente.gl_grupo_tipo'=>'Tratamiento');
		$arr = $this->_DAOPaciente->getListaDetalle($where);
		//$this->smarty->assign('id_usuario', $_SESSION['id']);
		$this->smarty->assign('mostrar_gestor', 1);
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('titulo', 'Pacientes Gestor Regional');

		$this->_display('Paciente/index.tpl');
	}
	
	/**
	* Descripción: Cargar Grilla Gestor Regional
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function seguimiento() {
		Acceso::redireccionUnlogged($this->smarty);
		
		

		$this->_display('Gestor/seguimiento.tpl');
	}
	
}