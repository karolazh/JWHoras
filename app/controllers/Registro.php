<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Registro.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal, Orlando Vázquez
!Creacion     		: 14/02/2017
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 		: NA
=============================================================================
!ControlCambio
--------------
!cVersion !cFecha   !cProgramador   !cDescripcion 
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

//** clase Admnistracion ***//
class Registro extends Controller{
	
    protected $_DAORegistro;
    protected $_DAOComuna;
    protected $_DAOCasoEgreso;
    protected $_DAORegion;
    protected $_DAOPrevision;
    
    //funcion construct
    function __construct(){
        parent::__construct();
        //Acceso::set("ADMINISTRADOR");
        $this->load->lib('Fechas', false);
        $this->_DAORegion = $this->load->model("DAORegion");
        $this->_DAOComuna = $this->load->model("DAOComuna");
        $this->_DAORegistro = $this->load->model("DAORegistro");
        $this->_DAOCasoEgreso = $this->load->model("DAOCasoEgreso");
        $this->_DAOPrevision = $this->load->model("DAOPrevision");
    }
    
    /*
     * Index
     */
    public function index(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        /*
         * Si tengo perfil 1="ADMIN" / 3="GESTOR NACIONAL" puedo ver todas las DAU
         * Si tengo perfil 2="ENFERMERA" puedo ver solo las DAU ingresadas en mi institución
         * Si tengo perfil 4="GESTOR REGIONAL" puedo ver solo las DAU correspondientes a la región
         * REALIZAR FUNCIÓN PARA LISTAR SEGÚN PERFIL
         */
        $arr = $this->_DAORegistro->getListaRegistro();
        print_r($arr);
        $this->smarty->assign('arrResultado', $arr);
        
        //llamado al template
        $this->_display('Registro/index.tpl');
    }
    
    public function nuevo(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        $arrRegiones = $this->_DAORegion->getListaRegiones();
        $this->smarty->assign("arrRegiones",$arrRegiones);
        
        $arrCasoEgreso = $this->_DAOCasoEgreso->getListaCasoEgreso();
        $this->smarty->assign("arrCasoEgreso",$arrCasoEgreso);
        
        //llamado al template
        $this->_display('Registro/nuevo.tpl');
        $this->load->javascript(STATIC_FILES."js/regiones.js");
        $this->load->javascript(STATIC_FILES."js/templates/registro/formulario.js");
        $this->load->javascript(STATIC_FILES."js/templates/registro/nuevo.js");
        $this->load->javascript(STATIC_FILES."js/lib/validador.js");
    }
    
    public function ver(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        $parametros = $this->request->getParametros();
        $id_registro = $parametros[0];
        $this->smarty->assign("id_registro", $id_registro);
        $registro = $this->_DAORegistro->getRegistro($id_registro);
        $prevision = $this->_DAOPrevision->getPrevision($registro->reg_id_prev);
        $comuna = $this->_DAOComuna->getComuna($registro->reg_com_id);
        $comuna_region = $this->_DAOComuna->getComunaRegion($comuna->com_id);
        $id_region = $comuna_region->id_region;
        $region = $this->_DAORegion->getRegion($id_region);
        $edad = Fechas::calcularEdadInv($registro->reg_fec_nac);
        
        $this->smarty->assign('registro', $registro);
        $this->smarty->assign('previson', $prevision->prev_nombre);
        $this->smarty->assign('comuna', $comuna->com_nombre);
        $this->smarty->assign('region', $region->gl_nombre);
        $this->smarty->assign('edad', $edad);
//llamado al template
        $this->_display('Registro/ver.tpl');
    }
    
    public function cargarComunasPorRegion(){
            $region = $_POST['region'];

            $daoRegion = $this->load->model('DAORegion');
            $comunas = $daoRegion->obtComunasPorRegion($region)->rows;

            $json = array();
            $i = 0;
            foreach($comunas as $comuna){
                    $json[$i]['id_comuna'] = $comuna->com_id;
                    $json[$i]['nombre_comuna'] = $comuna->com_nombre;
                    $i++;
            }

            echo json_encode($json);
    }
    
    public function cargarPaciente(){
            header('Content-type: application/json');
            $rut = $_POST['rut'];
            //Datos de Tabla Pacientes
            $daoPaciente = $this->load->model('DAOPaciente');
            $paciente = $daoPaciente->getPaciente($rut);
            //Datos de Tablas Comuna y Region
            $id_comuna = $paciente->pac_com_id;
            $daoComuna = $this->load->model('DAOComuna');
            $comunaRegion = $daoComuna->getComunaRegion($id_comuna);
            $json = array();
                $json[0]['rut'] = $paciente->pac_rut;
                $json[0]['nombres'] = $paciente->pac_nombres;
                $json[0]['apellidos'] = $paciente->pac_apellidos;
                $json[0]['fec_nac'] = $paciente->pac_fec_nac;
                //$json[0]['edad'] = $paciente->pac_edad;
                $json[0]['genero'] = $paciente->pac_sexo;
                $json[0]['prevision'] = $paciente->pac_prevision;
                $json[0]['convenio'] = $paciente->pac_convenio;
                $json[0]['region'] = $comunaRegion->reg_id;
                $json[0]['comuna'] = $comunaRegion->com_id;

            echo json_encode($json);
    }
    
    //*** REGIONES ***//
//    public function regiones(){
//        $sesion = New Zend_Session_Namespace("usuario_carpeta");        
//        $this->smarty->assign("id_usuario", $sesion->id);
//        $this->smarty->assign("rut", $sesion->rut);
//        $this->smarty->assign("usuario", $sesion->usuario);
//        
//        //llamada al _DAOAdministracion para listar regiones
//        $arr = $this->_DAOAdministracion->getListaRegiones();
//        $this->smarty->assign('arrResultado', $arr);
//        
//        //llamado al template
//        $this->_display('Administracion/Regiones/index.tpl');
//    }
    
    //creada por BC
//    public function guardarRegion(){
//            $session = New Zend_Session_Namespace("usuario_carpeta");
//            $data = array();
//            parse_str($_POST['data'], $data);
//
//            $this->load->lib('Constantes', false);
//
//            $json = array();
//            $datos = $data;
//            $datos['nr_estado'] =1;
//            $insertar = $this->_DAOAdministracion->insRegion($datos);
//
//            if ($insertar) {
//                $id_solicitud = $insertar;
//                $json['estado'] = true;
//                $json['mensaje'] = 'Proyecto ingresado correctamente';
//            }
//            echo json_encode($json);
//    }	
}