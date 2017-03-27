<?php

/**
******************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Controller para las funciones del ROL Medico
* Plataforma	: !PHP
* Creacion		: 08/03/2017
* @name			Medico.php
* @version		1.0
* @author		Victor Retamal <victor.retamal@cosof.cl>
* =============================================================================
* !ControlCambio
* --------------
* !cProgramador				!cFecha		!cDescripcion 
* -----------------------------------------------------------------------------
*<orlando.vazquez@cosof.cl>	08-03-2017	Agregado Evento
* -----------------------------------------------------------------------------
******************************************************************************
*/

class Medico extends Controller {

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

		$this->_Evento							= new Evento();
		$this->_DAOPaciente						= $this->load->model("DAOPaciente");
		$this->_DAOEmpa							= $this->load->model("DAOEmpa");
		$this->_DAOTipoEspecialidad				= $this->load->model("DAOTipoEspecialidad");
		$this->_DAOPacienteAgendaEspecialista	= $this->load->model("DAOPacienteAgendaEspecialista");
	}

	/**
	* Descripción: Cargar Grilla
	* @author: Victor Retamal <victor.retamal@cosof.cl>
	*/
	public function index() {
		Acceso::redireccionUnlogged($this->smarty);
		$id_perfil 		= $_SESSION['perfil'];
		$id_region 		= $_SESSION['id_region'];

		if($id_perfil == 1 || $id_perfil == 5){
			$where	= array('pre_empa.nr_orden' => 1, 'pre_empa.bo_finalizado' => 1);
		} else {
			$where	= array('pre_empa.nr_orden' => 1, 'pre_empa.bo_finalizado' => 1, 'paciente.id_region' => $id_region);
		}
		$join[]	= array('tabla'	=> 'pre_empa',
						'on'	=> 'pre_empa.id_paciente',
						'igual'	=> 'paciente.id_paciente'
						);
		$arr	= $this->_DAOPaciente->getListaDetalle($where,$join);

		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('titulo', 'Evaluación');
		$this->smarty->assign('mostrar_plan', 1);

		$this->_display('grilla/pacientes.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/Paciente/index.js");
	}

	/**
	* Descripción: Cargar Formulario de Plan de Tratamiento
	* @author: Victor Retamal <victor.retamal@cosof.cl>
	*/
	public function plan_tratamiento(){
		Acceso::redireccionUnlogged($this->smarty);

		$parametros			= $this->request->getParametros();
		$id_paciente		= $parametros[0];
		$arrEspecialidad	= $this->_DAOTipoEspecialidad->getLista();
		$arr_plan			= $this->_DAOPacienteAgendaEspecialista->getByIdPaciente($id_paciente);
		
		//$resp = $this->_Evento->guardarMostrarUltimo(21,0,$id_paciente,"Plan tratamiento Modificado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		
		$this->smarty->assign("id_paciente", $id_paciente);
		$this->smarty->assign("arr_plan", $arr_plan);
		$this->smarty->assign("arrEspecialidad", $arrEspecialidad);
		$this->smarty->assign("botonAyudaTratamiento", Boton::botonAyuda('Ingrese Datos del Tratamiento.', '', 'pull-right'));

		$this->_display('medico/tratamiento.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/medico/nuevo.js");
		$this->load->javascript(STATIC_FILES . "js/lib/validador.js");
	}

	/**
	* Descripción: Guardar Plan de Tratamiento
	* @author: Victor Retamal <victor.retamal@cosof.cl>
	*/
	public function GuardarPlan(){
		$parametros						= $this->_request->getParams();
		$parametros['id_usuario_crea']	= $_SESSION['id'];
		$correcto						= false;
		$id_paciente					= $parametros['id_paciente'];
		
		$id_plan						= $this->_DAOPacienteAgendaEspecialista->insert($parametros);
		if($id_plan) {
			$correcto			= true;
			$arrEspecialidad	= $this->_DAOTipoEspecialidad->getById($parametros['id_tipo_especialidad']);
			$resp				= $this->_Evento->guardarMostrarUltimo(20,0,$id_paciente,"Plan de Tratamiento con ".$arrEspecialidad->gl_nombre_especialidad." Iniciado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		}
			
		$salida			= array("correcto" => $correcto);
		$json			= Zend_Json::encode($salida);

		echo $json;
	}

}