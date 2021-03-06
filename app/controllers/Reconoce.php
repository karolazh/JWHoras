<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Maneja los casos de violencia a la mujer
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 03/03/2017
 * 
 * @name             Reconoce.php
 * 
 * @version          1.0
 *
 * @author           David Guzmán <david.guzman@cosof.cl>
 * 
 ******************************************************************************
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * ----------------------------------------------------------------------------
 * <david.guzman@cosof.cl>      07-03-2017  Function identificarAgresor mejoras,
 * 
 * <orlando.vazquez@cosof.cl>   08-03-2017  Agregados Eventos
 * ----------------------------------------------------------------------------
 * ****************************************************************************
 */
class Reconoce extends Controller {
    
    protected $_DAOPaciente;
    protected $_DAOComuna;
    protected $_DAOCasoEgreso;
    protected $_DAORegion;
    protected $_DAOPrevision;
    protected $_DAOPacienteRegistro;
    protected $_DAOUsuario;
    protected $_DAOEstadoCaso;
    protected $_DAOEventoTipo;
    protected $_DAOAdjunto;
    protected $_DAOAdjuntoTipo;
    protected $_DAOEmpa;
    protected $_DAOPacienteExamen;
	protected $_DAOTipoVinculo;
	protected $_DAOTipoRiesgo;
	protected $_DAOTipoGenero;
	protected $_DAOTipoOrientacionSexual;
	protected $_DAOTipoSexo;
	protected $_DAOPacienteAgresor;
	protected $_DAOPacienteDireccion;
	protected $_DAOPacienteAgresorViolencia;
	protected $_Evento;
	protected $_DAOTipoIngresoMensual;

    function __construct() {
        parent::__construct();
        $this->load->lib('Fechas', false);
        $this->load->lib('Boton', false);
        $this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);

		$this->_Evento						= new Evento();
        $this->_DAORegion                   = $this->load->model("DAORegion");
        $this->_DAOComuna                   = $this->load->model("DAOComuna");
        $this->_DAOPaciente                 = $this->load->model("DAOPaciente");
        $this->_DAOPacienteAgresor          = $this->load->model("DAOPacienteAgresor");
        $this->_DAOTipoOcupacion            = $this->load->model("DAOTipoOcupacion");
        $this->_DAOUsuario                  = $this->load->model("DAOUsuario");
        $this->_DAOTipoEscolaridad          = $this->load->model("DAOTipoEscolaridad");
        $this->_DAOEstadoCivil              = $this->load->model("DAOEstadoCivil");
        $this->_DAOTipoActividadEconomica   = $this->load->model("DAOTipoActividadEconomica");
        $this->_DAOTipoViolencia            = $this->load->model("DAOTipoViolencia");
        $this->_DAOTipoRiesgo               = $this->load->model("DAOTipoRiesgo");
		$this->_DAOTipoVinculo              = $this->load->model("DAOTipoVinculo");
		$this->_DAOTipoGenero               = $this->load->model("DAOTipoGenero");
		$this->_DAOTipoOrientacionSexual    = $this->load->model("DAOTipoOrientacionSexual");
		$this->_DAOTipoSexo					= $this->load->model("DAOTipoSexo");
		$this->_DAOPacienteDireccion		= $this->load->model("DAOPacienteDireccion");
		$this->_DAOPacienteAgresorViolencia	= $this->load->model("DAOPacienteAgresorViolencia");
		$this->_DAOTipoIngresoMensual		= $this->load->model("DAOTipoIngresoMensual");
    }
	
	/**
	* Descripción: Genera los Array y Datos respectivos de la BD para luego 
    * llenar con Smarty el "identificar_agresor.tpl" y cargar finalmente 
    * la vista junto con los .js  "validador.js" y "identificar_agresor.js".
	* @author   David Guzmán <david.guzman@cosof.cl>	07-03-2017
	* @return   Smarty  identificar_agresor.tpl
	*/    
    public function identificarAgresor(){
		Acceso::redireccionUnlogged($this->smarty);
		$parametros				= $this->request->getParametros();
		$id_paciente			= $parametros[0];

        $paciente				= $this->_DAOPaciente->verInfoById($id_paciente);
        $arrTipoOcupacion		= $this->_DAOTipoOcupacion->getLista();
        $arrTipoEstadoCivil		= $this->_DAOEstadoCivil->getLista();
        $arrEscolaridad			= $this->_DAOTipoEscolaridad->getLista();
		$arrComuna				= $this->_DAOComuna->getLista();
        $arrActividadEconomica	= $this->_DAOTipoActividadEconomica->getLista();
        $arrTipoRiesgo			= $this->_DAOTipoRiesgo->getLista();
		$arrSexo				= $this->_DAOTipoSexo->getLista();
		$arrGenero				= $this->_DAOTipoGenero->getLista();
		$arrOrientacion			= $this->_DAOTipoOrientacionSexual->getLista();
		$arrTipoVinculo			= $this->_DAOTipoVinculo->getLista();
		$direccion				= $this->_DAOPacienteDireccion->getByIdPaciente($id_paciente);
        $arrTipoViolencia		= $this->_DAOTipoViolencia->getLista();
		$arrPuntos				= $this->_DAOPacienteAgresorViolencia->getByIdPaciente($id_paciente);
		$arrIngresosMensuales	= $this->_DAOTipoIngresoMensual->getLista();

		$this->smarty->assign("id_paciente", $id_paciente);
		$this->smarty->assign("gl_rut", $paciente->gl_identificacion);
		$this->smarty->assign("arrTipoOcupacion", $arrTipoOcupacion);
		$this->smarty->assign("arrTipoEstadoCivil", $arrTipoEstadoCivil);
		$this->smarty->assign("arrEscolaridad", $arrEscolaridad);
		$this->smarty->assign("arrComuna", $arrComuna);
		$this->smarty->assign("arrActividadEconomica", $arrActividadEconomica);
		$this->smarty->assign("arrTipoRiesgo", $arrTipoRiesgo);
		$this->smarty->assign("arrSexo", $arrSexo);
		$this->smarty->assign("arrGenero", $arrGenero);
		$this->smarty->assign("arrOrientacion", $arrOrientacion);
		$this->smarty->assign("arrTipoVinculo", $arrTipoVinculo);
		$this->smarty->assign("arrTipoViolencia", $arrTipoViolencia);
		$this->smarty->assign("arrPuntos", $arrPuntos);
        $this->smarty->assign('gl_nombres', $paciente->gl_nombres);
        $this->smarty->assign('gl_apellidos', $paciente->gl_apellidos);
        $this->smarty->assign('fc_nacimiento', $paciente->fc_nacimiento);
		$edad = Fechas::calcularEdadInv($paciente->fc_nacimiento);
        $this->smarty->assign('gl_direccion', $direccion->gl_direccion);
        $this->smarty->assign('edad', $edad);
        $this->smarty->assign('fc_reconoce', Fechas::fechaHoy());
        $this->smarty->assign('fc_hora', date('h:i'));
        $this->smarty->assign('arrIngresosMensuales', $arrIngresosMensuales);

        $this->smarty->assign("botonAyudaPaciente", Boton::botonAyuda('Ingrese Datos del Paciente.','','pull-right'));
        $this->smarty->assign("botonAyudaViolencia", Boton::botonAyuda('Seleccione el o los tipos de violencia que la víctima vive o ha vivido de parte del agresor.','','pull-right'));
        $this->smarty->assign("botonAyudaAgresor", Boton::botonAyuda('Vínculo con el Agresor e Identificación del Agresor.','','pull-right'));

        $this->_display('reconoce/identificar_agresor.tpl');
        $this->load->javascript(STATIC_FILES . "js/templates/reconoce/identificar_agresor.js");
        $this->load->javascript(STATIC_FILES . "js/lib/validador.js");
    }
	
	/**
	* Descripción: Inserta datos del Agresor de la Paciente y hace un Update con
    *  nuevos Datos de Paciente
	* @author   David Guzmán <david.guzman@cosof.cl>	08-03-2017
	* @return   JSON
	*/   
	public function guardar(){
		header('Content-type: application/json');
		$parametros		= $this->_request->getParams();
		$correcto		= FALSE;
		$error			= FALSE;
		$cant_preguntas	= $parametros['cant_pre'];
		$id_paciente	= $parametros['id_paciente'];

		for ($i = 1; $i <= $cant_preguntas; $i++) {
			$id_pregunta	= $i;
			$valor			= $parametros['id_tipo_violencia_' . $i];
			$bool_existe	= $this->_DAOPacienteAgresorViolencia->getByIdPacientePregunta($id_paciente,$id_pregunta);
			if (!$bool_existe){
				$bool_violencia	= $this->_DAOPacienteAgresorViolencia->insertViolencia($id_paciente, $id_pregunta, $valor);
				$resp			= $this->_Evento->guardarMostrarUltimo(17,0,$id_paciente,"Paciente Agresor Violencia creada el : " . Fechas::fechaHoyVista(),1,0,$_SESSION['id']);
			}else{
				$bool_violencia	= $this->_DAOPacienteAgresorViolencia->updateViolencia($id_paciente, $id_pregunta, $valor);
				$resp			= $this->_Evento->guardarMostrarUltimo(18,0,$id_paciente,"Paciente Agresor Violencia modificada el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
			}
		}

		$bool_insert	= $this->_DAOPacienteAgresor->insertarAgresor($parametros);
		$resp			= $this->_Evento->guardarMostrarUltimo(19,0,$id_paciente," Agresor creado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		$bool_update	= $this->_DAOPaciente->updatePaciente($parametros);
		$resp			= $this->_Evento->guardarMostrarUltimo(5,0,$id_paciente,"Paciente Reconoce Violencia el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);

		if($bool_update && $bool_insert) {
			$resp		= $this->_Evento->guardarMostrarUltimo(12,0,$id_paciente,"Reconoce Agresor : " . Fechas::fechaHoy(),1,1,$_SESSION['id']);
			$correcto	= TRUE;
		}else{
			$error		= TRUE;
		}

		$salida	= array("error" => $error, "correcto" => $correcto);
		$json	= Zend_Json::encode($salida);

		echo $json;
	}

}