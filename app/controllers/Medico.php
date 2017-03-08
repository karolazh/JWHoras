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
 * 
 * -----------------------------------------------------------------------------
 * ****************************************************************************
*/

class Medico extends Controller {

	protected $_DAOPaciente;
	protected $_DAOEmpa;

	function __construct() {
		parent::__construct();
		$this->load->lib('Fechas', false);
		$this->load->lib('Boton', false);
		$this->load->lib('Seguridad', false);

		$this->_DAOPaciente				= $this->load->model("DAOPaciente");
		$this->_DAOEmpa					= $this->load->model("DAOEmpa");
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

}