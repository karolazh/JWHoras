<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: Home.php
!Sistema 	  		: PREVENCION DE FEMICIDIOS
!Modulo 	  		: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Orlando Vazquez <orlando.vazquez@cosof.cl>
!Creacion     		: 20/02/2017
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 			: NA
=============================================================================
!ControlCambio
--------------
!cVersion !cFecha   !cProgramador   !cDescripcion 
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

class Home extends Controller{

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/home/plugins/");        
        $this->_DAOUsuario = $this->load->model("DAOUsuario");       
    }

    public function index(){
        
    }

    /**
     * Inicio
     */
    public function dashboard(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");

        $daoPaciente = $this->load->model('DAOPaciente');
        $daoPacienteEstado = $this->load->model('DAOPacienteEstado');

        $arr_estados = array();
        $arr_abuso = array(0,0);
        $arr_programa = array(0,0);

        $estados = $daoPacienteEstado->getLista();
        $arr_estados[0]['total'] = 0;
        $arr_estados[0]['nombre'] = 'Sin Estado';
        foreach($estados as $estado){
            $arr_estados[$estado->id_paciente_estado]['total'] = 0;
            $arr_estados[$estado->id_paciente_estado]['nombre'] = $estado->gl_nombre_estado_caso;
        }

        $registros = $daoPaciente->getLista();
        if(!is_null($registros)){
            foreach($registros as $registro){

                if($registro->bo_reconoce){
                    $arr_abuso[1] = $arr_abuso[1] + 1; 
                }else{
                    $arr_abuso[0] = $arr_abuso[0] + 1; 
                }

                if($registro->bo_acepta_programa){
                    $arr_programa[1] = $arr_programa[1] + 1; 
                }else{
                    $arr_programa[0] = $arr_programa[0] + 1; 
                }

                if(!empty($registro->id_paciente_estado))
                    $arr_estados[$registro->id_paciente_estado]['total'] = $arr_estados[$registro->id_paciente_estado]['total'] + 1; 
                else
                    $arr_estados[0]['total'] = $arr_estados[0]['total'] + 1; 
            }
        }
        

        $this->_display('home/dashboard.tpl');
        
        $this->load->javascript(STATIC_FILES.'js/plugins/amcharts/amcharts.js');
        $this->load->javascript(STATIC_FILES.'js/plugins/amcharts/pie.js');
        $this->load->javascript(STATIC_FILES.'js/plugins/amcharts/serial.js');
        $this->load->javascript(STATIC_FILES.'js/templates/home/home.js');
        $this->load->javascript('Home.graficoEstadosNacional('.json_encode($arr_estados).');');
        $this->load->javascript('Home.graficoReconoceAbuso('.json_encode($arr_abuso).');');
        $this->load->javascript('Home.graficoAceptaPrograma('.json_encode($arr_programa).');');
    }
}

?>