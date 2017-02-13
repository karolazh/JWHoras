<?php

/*
  !IniHeaderDoc
 * ****************************************************************************
  !NombreObjeto 		: Zoonosis.php
  !Sistema 	  	: SIRAM
  !Modulo 	  	: NA
  !Descripcion  		:
  !Plataforma   		: !PHP
  !Perfil       		:
  !Itinerado    		: NA
  !Uso          		: NA
  !Autor        		: David Guzmán
  !Creacion     		: 06/02/2017
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
 * ****************************************************************************
  !EndHeaderDoc
 */

class Zoonosis extends Controller {

    protected $_DAORegion;
    
    function __construct() {
        parent::__construct();
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/home/plugins/");
        $this->_DAORegion = $this->load->model("DAORegion");
        $this->_DAOPatologia = $this->load->model("DAOPatologia");
        $this->_DAOEspecie = $this->load->model("DAOEspecie");
    }

    public function notificacion() {
        
        $arrRegiones = $this->_DAORegion->getListaRegiones();
        
        $this->smarty->assign("arrRegiones",$arrRegiones);
        
        $this->_display('Zoonosis/zoonosis.tpl');
        
    }

    public function notificar() {
        
        $arrPatologia = $this->_DAOPatologia->getListaPatologias();
        $this->smarty->assign("arrPatologia",$arrPatologia);
        
        $arrEspecie = $this->_DAOEspecie->getListaEspecies();
        $this->smarty->assign("arrEspecie",$arrEspecie);
        
        $this->_display('Zoonosis/notificar_zoonosis.tpl');
    }
    
    
    
    private $_combobox;
        public function index() {
            $this->_view->country = $this->_combobox->country();
            $this->_view->title = 'Blinusy combo';
            $this->_view->render('index','combobox');
        }

}
