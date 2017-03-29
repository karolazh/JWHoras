<?php

/**
******************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Controller para las funciones del ROL Gestor
* Plataforma        : !PHP
* Creacion          : 20/03/2017
* @name             Gestor.php
* @version          1.0
* @author           David Guzmán <david.guzman@cosof.cl>
* =============================================================================
* !ControlCambio
* --------------
* !cProgramador				!cFecha		!cDescripcion 
* -----------------------------------------------------------------------------
*<david.guzman@cosof.cl>		16-03-2017	nacional
* -----------------------------------------------------------------------------
*******************************************************************************
*/

class Gestor extends Controller {

	protected $_Evento;
	protected $_DAOPaciente;
	protected $_DAOEmpa;
	protected $_DAOTipoEspecialidad;
	protected $_DAOPacienteAgendaEspecialista;
	protected $_DAOPacienteDireccion;
	protected $_DAOPacienteAlarma;

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
		$this->_DAOPacienteDireccion			= $this->load->model("DAOPacienteDireccion");
		$this->_DAOPacienteAgendaEspecialista	= $this->load->model("DAOPacienteAgendaEspecialista");
		$this->_DAOPacienteAlarma				= $this->load->model("DAOPacienteAlarma");
	}

	/**
	* Descripción: Cargar Grilla Gestor Nacional
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function nacional() {
		Acceso::redireccionUnlogged($this->smarty);
		
		$where	= array('paciente.gl_grupo_tipo'=>'Tratamiento');
		$arr = $this->_DAOPaciente->getListaDetalle($where);
		$this->smarty->assign('mostrar_gestor', 1);
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('bandeja', 'Gestor');
		$this->smarty->assign('origen', 'Pacientes Gestor Nacional');

		$this->_display('grilla/pacientes.tpl');
	}

	/**
	* Descripción: Cargar Grilla Gestor Regional
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function regional() {
		Acceso::redireccionUnlogged($this->smarty);
		
		$where	= array('paciente.gl_grupo_tipo'=> 'Tratamiento',
						'paciente.id_region'	=> $_SESSION['id_region']);
		$arr = $this->_DAOPaciente->getListaDetalle($where);
		$this->smarty->assign('mostrar_gestor', 1);
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('bandeja', 'Gestor');
		$this->smarty->assign('origen', 'Pacientes Gestor Regional');

		$this->_display('grilla/pacientes.tpl');
	}
	
	/**
	* Descripción: Cargar Grilla Gestor Regional
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function seguimiento() {
		Acceso::redireccionUnlogged($this->smarty);
		
		$parametros		= $this->request->getParametros();
		$id_paciente	= $parametros[0];
		
		//Cargar Datos Paciente
		$id_empa		= $this->_DAOEmpa->getByIdPaciente($id_paciente);
		$registro		= $this->_DAOPaciente->getById($id_paciente);
		$direccion		= $this->_DAOPacienteDireccion->getByIdPaciente($id_paciente);
		$alarmas		= $this->_DAOPacienteAlarma->getByIdPaciente($id_paciente);
		
		if($_SESSION['perfil'] == 5){
                $pacientes = $this->_DAOPaciente->getListaDetalle();    
            }else{
                $pacientes = $this->_DAOPaciente->getListaDetalle(array('paciente.id_region' => $_SESSION['id_region']));
            }
		
		$fc_nacimiento = date("d/m/Y", strtotime($registro->fc_nacimiento));
		//calculo edad
		$fc_nacimiento = str_replace("'","",Fechas::formatearBaseDatos($fc_nacimiento));
		list($Y, $m, $d ) = explode("-", $fc_nacimiento);
		$edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
		
		if ($registro->gl_rut != ""){
			$this->smarty->assign("gl_rut", $registro->gl_rut);
		} else {
		$this->smarty->assign("gl_rut", $registro->gl_run_pass);
		}
		$this->smarty->assign("id_paciente", $id_paciente);
		$this->smarty->assign("id_empa", $id_empa->id_empa);
		$this->smarty->assign("gl_nombres", $registro->gl_nombres);
		$this->smarty->assign("gl_apellidos", $registro->gl_apellidos);
		$this->smarty->assign("fc_nacimiento", $fc_nacimiento);
		$this->smarty->assign("edad", $edad);
		$this->smarty->assign("gl_fono", $registro->gl_fono);
		$this->smarty->assign("gl_celular", $registro->gl_celular);
		$this->smarty->assign("gl_email", $registro->gl_email);
		$this->smarty->assign("gl_direccion", $direccion->gl_direccion);
		$this->smarty->assign("alarmas", $alarmas);
		
		
		$this->_display('gestor/seguimiento.tpl');
	}
	
}