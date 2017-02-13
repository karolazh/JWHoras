<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Vacunas.php
!Sistema 	  	: SIRAM
!Modulo 	  	: NA
!Descripcion  		: 
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal
!Creacion     		: 03/02/2017
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

class Vacunas extends Controller{
	
    protected $_DAOVacunas;
    protected $_DAORegion;
    protected $_DAOProvincias;
    protected $_DAOComuna;

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
        $this->_DAOVacunas = $this->load->model("DAOVacunas");
        $this->_DAORegion = $this->load->model("DAORegion");
        $this->_DAOProvincias = $this->load->model("DAOProvincias");
        $this->_DAOComuna = $this->load->model("DAOComuna");
    }
    
    /*
     * Buscar Vacunas
     */
    public function buscar(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
//        $this->smarty->assign("id_usuario", $sesion->id);
//        $this->smarty->assign("rut", $sesion->rut);
//        $this->smarty->assign("usuario", $sesion->usuario);
//        
//        //llamada al _DAOAdministracion para listar regiones
//        $arr = $this->_DAOAdministracion->getListaRegiones();
//        $this->smarty->assign('arrResultado', $arr);
        
        $arr = $this->_DAOVacunas->getListaVacunas();
        $this->smarty->assign('arrResultado', $arr);
        
        $this->_display('Vacunas/buscar.tpl');
    }
    
    /*
     * Registrar Mordedores
     */
    public function registrar(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
//        $this->smarty->assign("id_usuario", $sesion->id);
//        $this->smarty->assign("rut", $sesion->rut);
//        $this->smarty->assign("usuario", $sesion->usuario);
//        
//        //llamada al _DAOAdministracion para listar regiones
//        $arr = $this->_DAOAdministracion->getListaRegiones();
//        $this->smarty->assign('arrResultado', $arr);
        
        $this->_display('Vacunas/registrar.tpl');
    }
    
    /*
     * Ver Detalle de Vacuna
     */
    public function verRegistro(){
        $parametros = $this->request->getParametros();
        
        $id_vacuna = $parametros[0];
        $institucion = "";
        $responsable = "";
        $especie = "";
        $cantidad = "";
        $periodo = "";
        $agno = "";
        $comuna = "";
        $provincia = "";
        $region = "";
        
        $result = $this->_DAOVacunas->getVacuna($id_vacuna);
        if ($result){
            $institucion = $result->ins_nombre;
            $responsable = $result->usr_nombres." ".$result->usr_apellidos;
            $especie = $result->esp_nombre;
            $cantidad = $result->vac_cantidad;
            if ($result->vac_periodo = "1")
            {
                $periodo = "Primer Semestre";
            }
            else{
                if ($result->vac_periodo = "2")
                {
                    $periodo = "Segundo Semestre";
                }
            }
            $agno = $result->vac_agno;
            $comuna = $result->com_nombre;
            $provincia = $result->pro_nombre;
            $region = $result->reg_nombre;
            
            $this->smarty->assign("institucion",$institucion);
            $this->smarty->assign("responsable",$responsable);
            $this->smarty->assign("especie",$especie);
            $this->smarty->assign("cantidad",$cantidad);
            $this->smarty->assign("periodo",$periodo);
            $this->smarty->assign("agno",$agno);
            $this->smarty->assign("comuna",$comuna);
            $this->smarty->assign("provincia",$provincia);
            $this->smarty->assign("region",$region);
            
            $this->smarty->assign("hidden","hidden");
        }
           
        $this->_display('Vacunas/ver_registro.tpl');
    }
    
    public function listadovacunas(){
        $this->_display('Vacunas/vacunas.tpl');
    }
}