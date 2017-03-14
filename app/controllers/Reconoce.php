
<?php
/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Maneja los casos de violencia a la mujer
* Plataforma	: !PHP
* Creacion		: 03/03/2017
* @name			Reconoce.php
* @version		1.0
* @author		David Guzmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<orlando.vazquez@cosof.cl>	06-03-2017	Incluida la información del autor en la cabecera, 
*<david.guzman@cosof.cl>	07-03-2017	Function identificarAgresor mejoras,
*<orlando.vazquez@cosof.cl>	08-03-2017	Agregados Eventos
*-----------------------------------------------------------------------------
*****************************************************************************
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

    /**
     * Descripción: Constructor
     * @author: 
     */
    function __construct() {
        parent::__construct();
        $this->load->lib('Fechas', false);
        $this->load->lib('Boton', false);
        $this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);
		$this->_Evento = new Evento();
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
    }
	
	/**
	* identificarAgresor()
	* Genera los Array y Datos respectivos de la BD para luego llenar con Smarty 
	* el "identificar_agresor.tpl" y cargar finalmente la vista junto con 
	* los .js  "validador.js" y "identificar_agresor.js". 
	* 
	* @author	<david.guzman@cosof.cl>	07-03-2017
	* 
	* @param -
	*
	* @return valores con Smarty a identificar_agresor.tpl
	*/    
    public function identificarAgresor(){
	
    //Cargar Arrays
		$parametros = $this->request->getParametros();
		$id_paciente = $parametros[0];
		$this->smarty->assign("id_paciente", $id_paciente);
		
        $arrTipoOcupacion = $this->_DAOTipoOcupacion->getLista();
		$this->smarty->assign("arrTipoOcupacion", $arrTipoOcupacion);
        
        $arrTipoEstadoCivil = $this->_DAOEstadoCivil->getLista();
		$this->smarty->assign("arrTipoEstadoCivil", $arrTipoEstadoCivil);
        
        $arrEscolaridad = $this->_DAOTipoEscolaridad->getLista();
		$this->smarty->assign("arrEscolaridad", $arrEscolaridad);
		
		$arrComuna = $this->_DAOComuna->getLista();
		$this->smarty->assign("arrComuna", $arrComuna);
                
        $arrActividadEconomica = $this->_DAOTipoActividadEconomica->getLista();
		$this->smarty->assign("arrActividadEconomica", $arrActividadEconomica);
        
        $arrTipoRiesgo = $this->_DAOTipoRiesgo->getLista();
		$this->smarty->assign("arrTipoRiesgo", $arrTipoRiesgo);
		
		$arrSexo = $this->_DAOTipoSexo->getLista();
		$this->smarty->assign("arrSexo", $arrSexo);
		
		$arrGenero = $this->_DAOTipoGenero->getLista();
		$this->smarty->assign("arrGenero", $arrGenero);
		
		$arrOrientacion = $this->_DAOTipoOrientacionSexual->getLista();
		$this->smarty->assign("arrOrientacion", $arrOrientacion);
	
		$arrTipoVinculo = $this->_DAOTipoVinculo->getLista();
		$this->smarty->assign("arrTipoVinculo", $arrTipoVinculo);
        
		$direccion = $this->_DAOPacienteDireccion->getByIdPaciente($id_paciente);
		
        $arrTipoViolencia = $this->_DAOTipoViolencia->getLista();
		$this->smarty->assign("arrTipoViolencia", $arrTipoViolencia);
		
		$arrPuntos = $this->_DAOPacienteAgresorViolencia->getByIdPaciente($id_paciente);
		if (!is_null($arrPuntos)) {
			foreach ($arrPuntos as $item) {
				if (is_null($item->nr_valor)) {
					$item->nr_valor = 0;
				}
			}
		}
		$this->smarty->assign("arrPuntos", $arrPuntos);
		
    //Obtener Datos de la BD    
        $parametros = $this->request->getParametros();
        $id_registro = $parametros[0];
        $this->smarty->assign("id_registro", $id_registro);
        $obj_registro	= $this->_DAOPaciente->verInfoById($id_registro);
        $fc_nacimiento = $obj_registro->fc_nacimiento;
        list($Y, $m, $d ) = explode("-", $fc_nacimiento);
        $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
        
		if ($obj_registro->gl_rut != ""){
			$this->smarty->assign("gl_rut", $obj_registro->gl_rut);
		} else {
		$this->smarty->assign("gl_rut", $obj_registro->gl_run_pass);
		}
		
        $this->smarty->assign('gl_nombres', $obj_registro->gl_nombres);
        $this->smarty->assign('gl_apellidos', $obj_registro->gl_apellidos);
        $this->smarty->assign('fc_nacimiento', $obj_registro->fc_nacimiento);
        $this->smarty->assign('gl_direccion', $direccion->gl_direccion);
        $this->smarty->assign('edad', $edad);
        $this->smarty->assign('fc_reconoce', Fechas::fechaHoy());
        $this->smarty->assign('fc_hora', date('h:i'));
        
    //Botones
        $this->smarty->assign("botonAyudaPaciente", Boton::botonAyuda('Ingrese Datos del Paciente.','','pull-right'));
        $this->smarty->assign("botonAyudaViolencia", Boton::botonAyuda('Seleccione el o los tipos de violencia que la víctima vive o ha vivido de parte del agresor.','','pull-right'));
        $this->smarty->assign("botonAyudaAgresor", Boton::botonAyuda('Vínculo con el Agresor e Identificación del Agresor.','','pull-right'));
        
    //Llamado al template
        $this->_display('Reconoce/identificar_agresor.tpl');
    //Llamado al Javascript
		$this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
		$this->load->javascript('$(".datepicker").datepicker({ todayBtn: true,language: "es",   todayHighlight: true,autoclose: true});');
        $this->load->javascript(STATIC_FILES . "js/templates/reconoce/identificar_agresor.js");
        $this->load->javascript(STATIC_FILES . "js/lib/validador.js");
    }
	
	/**
	* guardar()
	* Inserta datos del Agresor de la Paciente
	* Y hace un Update con nuevos Datos de Paciente
	* 
	* @author	<david.guzman@cosof.cl>	08-03-2017
	* 
	* @param -
	*
	* @return booleanos -> correcto o error
	*/   
	public function guardar(){
		header('Content-type: application/json');
		$parametros = $this->_request->getParams();
		$correcto = FALSE;
		$error = FALSE;
		$cant_preguntas = $parametros['cant_pre'];
		$id_paciente = $parametros['id_paciente'];
		for ($i = 1; $i <= $cant_preguntas; $i++) {
			$id_pregunta = $i;
			$valor = $parametros['id_tipo_violencia_' . $i];
			$bool_existe = $this->_DAOPacienteAgresorViolencia->getByIdPacientePregunta($id_paciente,$id_pregunta);
			if (!$bool_existe){
					$bool_violencia = $this->_DAOPacienteAgresorViolencia->insertViolencia($id_paciente, $id_pregunta, $valor);
					$resp = $this->_Evento->guardarMostrarUltimo(17,0,$id_paciente,"Paciente Agresor Violencia creada el : " . Fechas::fechaHoyVista(),1,0,$_SESSION['id']);
			} else {
					$bool_violencia = $this->_DAOPacienteAgresorViolencia->updateViolencia($id_paciente, $id_pregunta, $valor);
					$resp = $this->_Evento->guardarMostrarUltimo(18,0,$id_paciente,"Paciente Agresor Violencia modificada el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
			}
		}
		
		$bool_insert = $this->_DAOPacienteAgresor->insertarAgresor($parametros);
		$resp = $this->_Evento->guardarMostrarUltimo(19,0,$id_paciente," Agresor creado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		$bool_update = $this->_DAOPaciente->updatePaciente($parametros);
		$resp = $this->_Evento->guardarMostrarUltimo(5,0,$id_paciente,"Paciente Reconoce Violencia el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
		if ($bool_update && $bool_insert) {
			$resp = $this->_Evento->guardarMostrarUltimo(12,0,$id_paciente,"Reconoce Agresor : " . Fechas::fechaHoy(),1,1,$_SESSION['id']);
			if ($resp) {
				$correcto = TRUE;
			} else {
				$error = TRUE;
			}
		} else {
			$error = TRUE;
		}

		$salida = array("error" => $error,
			"correcto" => $correcto);
		$json = Zend_Json::encode($salida);

		echo $json;
		
		
	}
    
}