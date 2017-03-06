<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion           : Controller para Registro de Paciente
* Plataforma            : !PHP
* Creacion		: 14/02/2017
* @name			Home.php
* @version		1.0
* @author		Orlando Vazquez <orlando.vazquez@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<david.guzman@cosof.cl>	06-03-2017	modificacion nombres DAO y funciones
*
*-----------------------------------------------------------------------------
*****************************************************************************
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
        $this->_DAOPaciente = $this->load->model("DAOPaciente"); 
        $this->_DAOPacienteEstado = $this->load->model("DAOPacienteEstado"); 
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
        
        $jscode = '';
        if($_SESSION['perfil'] == 4 or $_SESSION['perfil'] == 5){

            $template = 'home/dashboard_gestor_casos.tpl';


        }else{
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
            
            $template = 'home/dashboard.tpl';
            $jscode = 'Home.graficoEstadosNacional('.json_encode($arr_estados).');';
            $jscode += 'Home.graficoReconoceAbuso('.json_encode($arr_abuso).');';
            $jscode += 'Home.graficoAceptaPrograma('.json_encode($arr_programa).');';
        }

        
        

        $this->_display($template);
        
        $this->load->javascript(STATIC_FILES.'js/plugins/amcharts/amcharts.js');
        $this->load->javascript(STATIC_FILES.'js/plugins/amcharts/pie.js');
        $this->load->javascript(STATIC_FILES.'js/plugins/amcharts/serial.js');
        $this->load->javascript(STATIC_FILES.'js/templates/home/home.js');
        $this->load->javascript(STATIC_FILES.'js/formulario.js');
        $this->load->javascript($jscode);
    }



    public function pacientesMapaDashboard(){
        $daoPacientes = $this->load->model('DAOPaciente');

        $response = array();

        if($_SESSION['perfil'] == 5){
            $pacientes =  $daoPacientes->getLista();
        }else{
            $id_region = $_SESSION['id_region'];
            $pacientes =  $daoPacientes->getLista(array('region' => $id_region));
        }

        //$pacientes =  $daoPacientes->getLista();

        if($pacientes){
            foreach($pacientes as $paciente){
                $response['pacientes'][] = array(
                    'id' => $paciente->id_paciente,
                    'latitud' => $paciente->gl_latitud,
                    'longitud' => $paciente->gl_longitud
                    );
            }
        }

        echo json_encode($response);
    }

}

?>