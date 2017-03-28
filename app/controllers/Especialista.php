<?php

/**
******************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Controller para las funciones del ROL Especialista
* Plataforma	: !PHP
* Creacion		: 08/03/2017
* @name			Especialista.php
* @version		1.0
* @author		David Guzmán <david.guzman@cosof.cl>
* =============================================================================
* !ControlCambio
* --------------
* !cProgramador				!cFecha		!cDescripcion 
* -----------------------------------------------------------------------------
*<david.guzman@cosof.cl>		16-03-2017	index
* -----------------------------------------------------------------------------
*******************************************************************************
*/

class Especialista extends Controller {

	protected $_Evento;
	protected $_DAOPaciente;
	protected $_DAOEmpa;
	protected $_DAOTipoEspecialidad;
	protected $_DAOCie10Capitulo;
	protected $_DAOCie10Seccion;
	protected $_DAOCie10Grupo;
	protected $_DAOPacienteAgendaEspecialista;
	protected $_DAOLaboratorio;
	protected $_DAOTipoExamen;

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
		$this->_DAOCie10Capitulo				= $this->load->model("DAOCie10Capitulo");
		$this->_DAOCie10Seccion					= $this->load->model("DAOCie10Seccion");
		$this->_DAOCie10Grupo					= $this->load->model("DAOCie10Grupo");
		$this->_DAOLaboratorio					= $this->load->model("DAOLaboratorio");
		$this->_DAOTipoExamen					= $this->load->model("DAOTipoExamen");
	}

	/**
	* Descripción: Cargar Grilla
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function index() {
		Acceso::redireccionUnlogged($this->smarty);
		$id_perfil	= $_SESSION['perfil'];
		$id_region	= $_SESSION['id_region'];
		
		if($id_perfil == 1 || $id_perfil == 5){
			$where	= array('esp.id_tipo_especialidad'=>$_SESSION['id']);
		}else{
			$where	= array('esp.id_tipo_especialidad'=>$_SESSION['id_tipo_especialidad'],'paciente.id_region'=>$id_region);
		}

		$join[]		= array(
							'tabla'	=> 'pre_paciente_agenda_especialista esp',
							'on'	=> 'esp.id_paciente',
							'igual'	=> 'paciente.id_paciente'
						);
		$arr		= $this->_DAOPaciente->getListaDetalle($where,$join);

		$this->smarty->assign('mostrar_especialista', 1);
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('titulo', 'Pacientes derivados a Especialista');

		$this->_display('grilla/pacientes.tpl');
	}

	/**
	* Descripción: Cargar Formulario de Diagnostico
	* @author: David Guzmán <david.guzman@cosof.cl>
	*/
	public function diagnostico(){
		Acceso::redireccionUnlogged($this->smarty);
		$parametros			= $this->request->getParametros();
		$id_paciente		= $parametros[0];
        
		$empa				= $this->_DAOEmpa->getByIdPaciente($id_paciente);
		$arrCIE10Capitulo	= $this->_DAOCie10Capitulo->getLista();
		//$resp = $this->_Evento->guardarMostrarUltimo(21,0,$id_paciente,"Plan tratamiento Modificado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);

		$this->smarty->assign("arrCIE10Capitulo", $arrCIE10Capitulo);
		$this->smarty->assign("id_empa", $empa->id_empa);
		$this->smarty->assign("id_paciente", $id_paciente);
		$this->smarty->assign("botonAyudaTratamiento", Boton::botonAyuda('Ingrese Datos del Diagnóstico.', '', 'pull-right'));

		$this->_display('especialista/diagnostico.tpl');
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
		
		$bool_update	= $this->_DAOPacienteAgendaEspecialista->insertAgenda($parametros);

		if ($bool_update) {
			$correcto	= TRUE;
		} else {
			$error		= TRUE;
		}

		$salida	= array("error" => $error, "correcto" => $correcto);
		$json	= Zend_Json::encode($salida);

		echo $json;
	}

    /**
	 * Descripción: cargar Seccion por Capitulo
	 * @author S/N
	 */
	public function cargarSeccionporCapitulo() {
		$cie10 = $_POST['cie10'];
		$seccion1 = $this->_DAOCie10Capitulo->getDetalleByIdCapitulo($cie10);
		$json = array();
		$i = 0;

		if ($seccion1->row_0->id_seccion) {
			foreach ($seccion1 as $seccion) {
				$json[$i]['id_seccion'] = $seccion->id_seccion;
				$json[$i]['gl_codigo'] = $seccion->gl_codigo;
				$json[$i]['gl_descripcion'] = $seccion->gl_descripcion;
				$i++;
			}

			echo json_encode($json);
		}
	}

		/**
	 * Descripción: cargar Grupo por Seccion
	 * @author S/N
	 */
	public function cargarGrupoporSeccion(){
		$seccion	= $_POST['seccion'];
		$grupo1		= $this->_DAOCie10Seccion->getDetalleByIdSeccion($seccion);
		$json		= array();
		$i			= 0;
		
		if ($grupo1->row_0->id_grupo) {
			foreach ($grupo1 as $grupo) {
				$json[$i]['id_grupo'] = $grupo->id_grupo;
				$json[$i]['gl_codigo'] = $grupo->gl_codigo;
				$json[$i]['gl_descripcion'] = $grupo->gl_descripcion;
				$i++;
			}
			echo json_encode($json);
		}
    }

    /**
	 * Descripción: Cargar CIE10 por Grupo
	 * @author S/N
	 */
	public function cargarCIE10porGrupo(){
		$grupo	= $_POST['grupo'];
		$cie101	= $this->_DAOCie10Grupo->getDetalleByIdGrupo($grupo);
		$json	= array();
		$i		= 0;

		if ($cie101->row_0->id_cie10) {
			foreach($cie101 as $cie10){
				$json[$i]['id_cie10']		= $cie10->id_cie10;
				$json[$i]['gl_codigo']		= $cie10->gl_codigo;
				$json[$i]['gl_descripcion']	= $cie10->gl_descripcion;
				$i++;
			}
			echo json_encode($json);
		}
	}
	/**
	 * Descripción: ReAgendar Especialista
	 * * @author David Guzmán <david.guzman@cosof.cl>
	 */
    public function reagendar() {
        Acceso::redireccionUnlogged($this->smarty);        
        $parametros		= $this->request->getParametros();
        $id_paciente	= $parametros[0];
        $reagendar		= 1;
		$registro		= $this->_DAOPaciente->getById($id_paciente);
		
		//print_r($_SESSION); die;
        //valida si agenda examen de empa o de laboratorio
        if (isset($parametros[1])) {
            $id_empa = $parametros[1];
        } else {
            $id_empa = "";
        }
        $id_centro_salud = $registro->id_centro_salud;
        //valida si agenda examen de empa o de laboratorio
        /*if (isset($parametros[3])) {
            $id_examen = $parametros[3];
        } else {
            $id_examen = "";
        }*/
        
        $perfil = $_SESSION['perfil'];
		//"Especialista"
            $rut_esp         = $_SESSION['rut'];
            $nombre_esp      = $_SESSION['nombre'];
            $id_laboratorio  = $_SESSION['id_laboratorio'];            
            //Combo Laboratorios según tipo de usuario
            //$arrLaboratorios = $this->_DAOLaboratorio->getLista();
			$arrLaboratorios = $this->_DAOLaboratorio->getByIdCentroSalud($id_centro_salud);
        
        //Combos Tipo Examen
        $arrTipoExamen = $this->_DAOTipoExamen->getLista();
        
        $this->smarty->assign("reagendar", $reagendar);
        $this->smarty->assign("id_paciente", $id_paciente);
        $this->smarty->assign("id_empa", $id_empa);
        $this->smarty->assign("id_centro_salud", $id_centro_salud);
        $this->smarty->assign("rut_esp", $rut_esp);
        $this->smarty->assign("nombre_esp", $nombre_esp);
        //$this->smarty->assign("id_examen", $id_examen);        
        $this->smarty->assign("perfil", $perfil);
        $this->smarty->assign("id_laboratorio", $id_laboratorio);
        $this->smarty->assign('arrLaboratorios', $arrLaboratorios);
        $this->smarty->assign('arrTipoExamen', $arrTipoExamen);
        
        $this->smarty->display('agenda/agendar.tpl');
        $this->load->javascript(STATIC_FILES . 'js/templates/especialista/diagnostico.js');
    }

	public function guardarReAgendado(){
		header('Content-type: application/json');
		
        $parametros		= $this->_request->getParams();
		$bool_insert	= FALSE;
		$bool_update	= FALSE;
		//print_r($_SESSION); die;
		$parametros['id_laboratorio']	= $_SESSION['id_laboratorio'];
		$parametros['id_tipo_especialidad']	= $_SESSION['id_tipo_especialidad'];
		
		$correcto		= FALSE;
		$error			= FALSE;
		$bool_update	= $this->_DAOPacienteAgendaEspecialista->updateReAgendar($parametros);
		if ($bool_update) {
			$bool_insert	= $this->_DAOPacienteAgendaEspecialista->insertReAgendar($parametros);
		}
		
		if ($bool_insert) {
			$correcto	= TRUE;
		} else {
			$error		= TRUE;
		}

		$salida	= array("error" => $error, "correcto" => $correcto);
		$json	= Zend_Json::encode($salida);

		echo $json;
	}
	
}