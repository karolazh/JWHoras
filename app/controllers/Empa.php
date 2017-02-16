<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Empa.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: 
!Creacion     		: 16/02/2017
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

class Empa extends Controller{
	
    protected $_DAOEmpa;

    //funcion construct
    function __construct(){
        parent::__construct();
        //Acceso::set("ADMINISTRADOR");
        $this->_DAOEmpa = $this->load->model("DAOEmpa");
    }
    
    /*
     * Index
     */
    public function index(){
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
        //$arr = $this->_DAODau->getListaDAU();
        //$this->smarty->assign('arrResultado', $arr);
        
        //llamado al template
        $this->_display('Empa/index.tpl');
    }
    
    public function nuevoEmpa(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        //llamado al template
        $this->_display('Empa/nuevo_empa.tpl');
    }
    
    public function verEmpa(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        //llamado al template
        $this->_display('Empa/ver_empa.tpl');
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