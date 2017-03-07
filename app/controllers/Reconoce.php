
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
*
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

    /**
     * Descripción: Constructor
     * @author: 
     */
    function __construct() {
        parent::__construct();
        $this->load->lib('Fechas', false);
        $this->load->lib('Boton', false);
        $this->load->lib('Seguridad', false);

        $this->_DAORegion                   = $this->load->model("DAORegion");
        $this->_DAOComuna                   = $this->load->model("DAOComuna");
        $this->_DAOPaciente                 = $this->load->model("DAOPaciente");
        $this->_DAOTipoOcupacion            = $this->load->model("DAOTipoOcupacion");
        $this->_DAOUsuario                  = $this->load->model("DAOUsuario");
        $this->_DAOTipoEscolaridad          = $this->load->model("DAOTipoEscolaridad");
        $this->_DAOEstadoCivil              = $this->load->model("DAOEstadoCivil");
        $this->_DAOTipoActividadEconomica   = $this->load->model("DAOTipoActividadEconomica");
        $this->_DAOTipoViolencia            = $this->load->model("DAOTipoViolencia");
        $this->_DAOTipoRiesgo               = $this->load->model("DAOTipoRiesgo");
		$this->_DAOTipoVinculo              = $this->load->model("DAOTipoVinculo");
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
        $arrTipoOcupacion = $this->_DAOTipoOcupacion->getLista();
	$this->smarty->assign("arrTipoOcupacion", $arrTipoOcupacion);
        
        $arrTipoEstadoCivil = $this->_DAOEstadoCivil->getLista();
	$this->smarty->assign("arrTipoEstadoCivil", $arrTipoEstadoCivil);
        
        $arrEscolaridad = $this->_DAOTipoEscolaridad->getLista();
	$this->smarty->assign("arrEscolaridad", $arrEscolaridad);
                
        $arrActividadEconomica = $this->_DAOTipoActividadEconomica->getLista();
	$this->smarty->assign("arrActividadEconomica", $arrActividadEconomica);
        
        $arrTipoViolencia = $this->_DAOTipoViolencia->getLista();
	$this->smarty->assign("arrTipoViolencia", $arrTipoViolencia);
        
        $arrNivelRiesgo = $this->_DAOTipoRiesgo->getLista();
	$this->smarty->assign("arrNivelRiesgo", $arrNivelRiesgo);
	
		$arrTipoVinculo = $this->_DAOTipoVinculo->getLista();
	$this->smarty->assign("arrTipoVinculo", $arrTipoVinculo);
        
    //Obtener Datos de la BD    
        $parametros = $this->request->getParametros();
        $id_registro = $parametros[0];
        $this->smarty->assign("id_registro", $id_registro);
        $obj_registro	= $this->_DAOPaciente->verInfoById($id_registro);
        $fc_nacimiento = $obj_registro->fc_nacimiento;
        list($Y, $m, $d ) = explode("-", $fc_nacimiento);
        $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
            
        $this->smarty->assign('gl_rut', $obj_registro->gl_rut);
        $this->smarty->assign('gl_run_pass', $obj_registro->gl_run_pass);
        $this->smarty->assign('gl_nombres', $obj_registro->gl_nombres);
        $this->smarty->assign('gl_apellidos', $obj_registro->gl_apellidos);
        $this->smarty->assign('fc_nacimiento', $obj_registro->fc_nacimiento);
        $this->smarty->assign('gl_direccion', $obj_registro->gl_direccion);
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
        $this->load->javascript(STATIC_FILES . "js/templates/reconoce/identificar_agresor.js");
        $this->load->javascript(STATIC_FILES . "js/lib/validador.js");
    }
    
}