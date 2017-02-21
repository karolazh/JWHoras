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

    //funcion construct
    function __construct(){
        parent::__construct();
        //Acceso::set("ADMINISTRADOR");
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
        
        $arrPrevision = $this->_DAOPrevision->getListaPrevision();
        $this->smarty->assign("arrPrevision",$arrPrevision);
        
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
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        $parametros = $this->request->getParametros();
        $id_registro = $parametros[0];
        
        $this->smarty->assign("id_registro", $id_registro);
        
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
    public function cargarCentroSaludporComuna(){
            $comuna = $_POST['comuna'];

            $daoComuna = $this->load->model('DAOComuna');
            $centrosalud = $daoComuna->obtCentroSaludporComuna($comuna)->rows;

            $json = array();
            $i = 0;
            foreach($centrosalud as $cSalud){
                    $json[$i]['id_establecimiento'] = $cSalud->id_establecimiento;
                    $json[$i]['nombre_establecimiento'] = $cSalud->nombre_establecimiento;
                    $i++;
            }

            echo json_encode($json);
    }    
    
    
    public function cargarRegistro(){
            header('Content-type: application/json');
            $rut = $_POST['rut'];
            //Datos de Tabla Registros
            $daoRegistro = $this->load->model('DAORegistro');
            $registro = $daoRegistro->getRegistro1($rut);
            //Datos de Tablas Comuna y Region
            $id_comuna = $registro->reg_com_id;
            $daoComuna = $this->load->model('DAOComuna');
            $comunaRegion = $daoComuna->getComunaRegion($id_comuna);
            $json = array();
                $json[0]['rut'] = $registro->reg_rut;
                $json[0]['nombres'] = $registro->reg_nombres;
                $json[0]['apellidos'] = $registro->reg_apellidos;
                $json[0]['fec_nac'] = $registro->reg_fec_nac;
                //$json[0]['edad'] = $registro->reg_edad;
                $json[0]['genero'] = $registro->reg_sexo;
                $json[0]['prevision'] = $registro->reg_prevision;
                $json[0]['convenio'] = $registro->reg_convenio;
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