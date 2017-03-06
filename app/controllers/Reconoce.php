<?php


class Reconoce extends Controller {
    
    protected $_DAORegistro;
    protected $_DAOComuna;
    protected $_DAOCasoEgreso;
    protected $_DAORegion;
    protected $_DAOPrevision;
    protected $_DAOMotivoConsulta;
    protected $_DAOUsuarios;
    protected $_DAOEstadoCaso;
    protected $_DAOInstitucion;
    protected $_DAOEventos;
    protected $_DAOEventosTipo;
    protected $_DAOAdjuntos;
    protected $_DAOAdjuntosTipo;
    protected $_DAOEmpa;
    protected $_DAOExamenRegistro;

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
        $this->_DAORegistro                 = $this->load->model("DAORegistro");
        $this->_DAOTipoOcupacion            = $this->load->model("DAOTipoOcupacion");
        $this->_DAOUsuarios                 = $this->load->model("DAOUsuarios");
        $this->_DAOTipoEscolaridad          = $this->load->model("DAOTipoEscolaridad");
        $this->_DAOEstadoCivil              = $this->load->model("DAOEstadoCivil");
        $this->_DAOTipoActividadEconomica   = $this->load->model("DAOTipoActividadEconomica");
        $this->_DAOTipoViolencia            = $this->load->model("DAOTipoViolencia");
        $this->_DAOTipoRiesgo               = $this->load->model("DAOTipoRiesgo");
    }
    
    public function identificarAgresor(){
    
    //Cargar Arrays
        $arrTipoOcupacion = $this->_DAOTipoOcupacion->getListaTipoOcupaciones();
	$this->smarty->assign("arrTipoOcupacion", $arrTipoOcupacion);
        
        $arrTipoEstadoCivil = $this->_DAOEstadoCivil->getListaTipoEstadoCivil();
	$this->smarty->assign("arrTipoEstadoCivil", $arrTipoEstadoCivil);
        
        $arrEscolaridad = $this->_DAOTipoEscolaridad->getListaTipoEscolaridad();
	$this->smarty->assign("arrEscolaridad", $arrEscolaridad);
                
        $arrActividadEconomica = $this->_DAOTipoActividadEconomica->getListaTipoActividadEconomica();
	$this->smarty->assign("arrActividadEconomica", $arrActividadEconomica);
        
        $arrTipoViolencia = $this->_DAOTipoViolencia->getListaTipoViolencia();
	$this->smarty->assign("arrTipoViolencia", $arrTipoViolencia);
        
        $arrNivelRiesgo = $this->_DAOTipoRiesgo->getListaTipoRiesgo();
	$this->smarty->assign("arrNivelRiesgo", $arrNivelRiesgo);
        
    //Obtener Datos de la BD    
        $parametros = $this->request->getParametros();
        $id_registro = $parametros[0];
        $this->smarty->assign("id_registro", $id_registro);
        $obj_registro	= $this->_DAORegistro->verInfoById($id_registro);
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