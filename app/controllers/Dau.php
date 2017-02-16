<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Dau.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal
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
class Dau extends Controller{
	
    protected $_DAODau;

    //funcion construct
    function __construct(){
        parent::__construct();
        //Acceso::set("ADMINISTRADOR");
        $this->_DAORegion = $this->load->model("DAORegion");
        $this->_DAOComuna = $this->load->model("DAOComuna");
        $this->_DAODau = $this->load->model("DAODau");
        $this->_DAOCasoEgreso = $this->load->model("DAOCasoEgreso");
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
        $arr = $this->_DAODau->getListaDAU();
        $this->smarty->assign('arrResultado', $arr);
        
        //llamado al template
        $this->_display('DAU/index.tpl');
    }
    
    public function nuevaDau(){
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
        $this->_display('DAU/nueva_dau.tpl');
        $this->load->javascript(STATIC_FILES."js/regiones.js");
    }
    
    public function verDau(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        $parametros = $this->request->getParametros();
        $id_dau = $parametros[0];
        
        $this->smarty->assign("id_dau", $id_dau);
        
        //llamado al template
        $this->_display('DAU/ver_dau.tpl');
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