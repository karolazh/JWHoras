<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

class Home extends Controller{

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
        //Acceso::set("ALL");
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/home/plugins/");
        
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        
//        $this->_DAOComuna 	= $this->load->model("DAOComuna");
//        $this->_DAOInstalacion 	= $this->load->model("DAOInstalacion");
//        $this->_DAODatosRemoto  = $this->load->model("DAODatosRemotos");
//        $this->_DAOSolicitudes  = $this->load->model("DAOSolicitudes");
        
        //$this->smarty->addPluginsDir(APP_PATH . "views/templates/mantenedor_avanzados/grilla_grafico_usuario/plugins/");
    }

    /**
     * Index
     */
    public function index(){
        
    }

    /**
     * Inicio
     */
    public function dashboard(){
        //validar session...
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        
//        $arr = $this->_DAONoticias->getListaNoticias();
//        $this->smarty->assign('arrResultado', $arr);
        
        //llamado al template
        $this->_display('home/dashboard.tpl');
        
//        if ($_SESSION['perfil'] == 1) {
            
//            $this->load->lib('Fechas',false);
//
//            $_DAODocumento = $this->load->model('DAODocumento');
//            $creadas = $_DAODocumento->getTicketsPorEstado(1)->numRows;
//            $recibidas = $_DAODocumento->getTicketsPorEstado(2)->numRows;
//            $desarrollo = $_DAODocumento->getTicketsPorEstado(3)->numRows;
//            $finalizadas = $_DAODocumento->getTicketsPorEstado(4)->numRows;
//            $derivadas = $_DAODocumento->getTicketsPorEstado(5)->numRows;
//            $archivadas = $_DAODocumento->getTicketsPorEstado(6)->numRows;
//
//            $cero_ocho=$_DAODocumento->diferenciaDiasFechas(0,-8)->numRows;
//            $nueve_quince=$_DAODocumento->diferenciaDiasFechas(-9,-15)->numRows;
//            $dieciseis_treinta=$_DAODocumento->diferenciaDiasFechas(-16,-30)->numRows;
//            $treinta_mas=$_DAODocumento->diferenciaDiasFechas(-30,-1000)->numRows;
//            $arr = $_DAODocumento->getDocumentosAsignados();
//            
//            $estados = array(
//                'creadas' => $creadas,
//                'recibidas' => $recibidas,
//                'desarrollo' => $desarrollo,
//                'finalizadas' => $finalizadas,
//                'derivadas' => $derivadas,
//                'archivadas' => $archivadas
//            );
//
//            $atrasos = array(
//                'cero_ocho' => $cero_ocho,
//                'nueve_quince' => $nueve_quince,
//                'dieciseis_treinta' => $dieciseis_treinta,
//                'treinta_mas' => $treinta_mas
//            );
//
//            /*if ($_SESSION['perfil'] == 1) {
//                $arr = $_DAODocumento->getDocumentosAsignados();
//            } else {
//                $session = New Zend_Session_Namespace("usuario_carpeta");
//                $arr = $_DAODocumento->getDocumentosAsignados($session->id);
//            }*/
//
//            $rangos = array(
//                'rango_a' => 0,
//                'rango_b' => 0,
//                'rango_c' => 0,
//                'rango_d' => 0
//            );
//            
//            foreach ($arr as $item) {
//                if ($item->cd_estado_solicitud == 0) {
//                    $dias_bandeja = Fechas::diffDias(date('Y-m-d'), $item->fc_fecha_ingreso_partes_solicitud, true) - $item->total_dias_feriados;
//                    if($dias_bandeja < 9){
//                        $rangos['rango_a'] = $rangos['rango_a'] + 1;
//                    }elseif ($dias_bandeja < 16){
//                        $rangos['rango_b'] = $rangos['rango_b'] + 1;
//                    }elseif ($dias_bandeja < 31){
//                        $rangos['rango_c'] = $rangos['rango_c'] + 1;
//                    }else{
//                        $rangos['rango_d'] = $rangos['rango_d'] + 1;
//                    }
//                }
//            }
//
//            //$this->smarty->assign("FOLDER",'acceso');	
//            /*$this->smarty->assign("ocultar_tour",$_SESSION['usuario']['gl_ocultar_tour']);	*/
//            
//            $this->load->javascript(STATIC_FILES.'js/plugins/Chart.js/Chart.js');
//            $this->load->javascript(STATIC_FILES.'js/templates/home/home.js');
//            $this->load->javascript('Home.graficoEstados('.json_encode($estados).');');
//            $this->load->javascript('Home.graficoEstados1('.json_encode($atrasos).');');
//            //$this->load->javascript('Home.graficoRangos('.json_encode($rangos).');');
            
//            //$this->_display('home/dashboard.tpl');
//        }
//        # usuarios no administradores
//        else{
//            $_DAODocumento = $this->load->model('DAODocumento');
//            $session = New Zend_Session_Namespace("usuario_carpeta");
//
//            $this->load->lib('Fechas',false);
//            $creadas = $_DAODocumento->getTicketsPorUsuario($session->id,1)->numRows;
//            $recibidas = $_DAODocumento->getTicketsPorUsuario($session->id,2)->numRows;
//            $desarrollo = $_DAODocumento->getTicketsPorUsuario($session->id,3)->numRows;
//            $finalizadas = $_DAODocumento->getTicketsPorUsuario($session->id,4)->numRows;
//            $derivadas = $_DAODocumento->getTicketsPorUsuario($session->id,5)->numRows;
//            $archivadas = $_DAODocumento->getTicketsPorUsuario($session->id,6)->numRows;
//
//            $cero_ocho=$_DAODocumento->diferenciaDiasFechasUsuario($session->id,0,-8)->numRows;
//            $nueve_quince=$_DAODocumento->diferenciaDiasFechasUsuario($session->id,-9,-15)->numRows;
//            $dieciseis_treinta=$_DAODocumento->diferenciaDiasFechasUsuario($session->id,-16,-30)->numRows;
//            $treinta_mas=$_DAODocumento->diferenciaDiasFechasUsuario($session->id,-30,-1000)->numRows;
//            $arr = '';//$_DAODocumento->getDocumentosAsignados($session->id);
//
//            $estados = array(
//                'creadas' => $creadas,
//                'recibidas' => $recibidas,
//                'desarrollo' => $desarrollo,
//                'finalizadas' => $finalizadas,
//                'derivadas' => $derivadas,
//                'archivadas' => $archivadas
//            );
//
//            $atrasos = array(
//                'cero_ocho' => $cero_ocho,
//                'nueve_quince' => $nueve_quince,
//                'dieciseis_treinta' => $dieciseis_treinta,
//                'treinta_mas' => $treinta_mas
//            );
//
//            $rangos = array(
//                'rango_a' => 0,
//                'rango_b' => 0,
//                'rango_c' => 0,
//                'rango_d' => 0
//            );
//
//            //$this->smarty->assign("FOLDER",'acceso');   
//            /*$this->smarty->assign("ocultar_tour",$_SESSION['usuario']['gl_ocultar_tour']);    */
//
//            $this->load->javascript(STATIC_FILES.'js/plugins/Chart.js/Chart.js');
//            $this->load->javascript(STATIC_FILES.'js/templates/home/home.js');
//            $this->load->javascript('Home.graficoEstados('.json_encode($estados).');');
//            $this->load->javascript('Home.graficoEstados1('.json_encode($atrasos).');');
//            //$this->load->javascript('Home.graficoRangos('.json_encode($rangos).');');
            
            //$this->_display('home/dashboard.tpl');
//        }
    }
    
    /*
    public function ocultarTour(){
        $this->_DAOUsuarios->update(array("gl_ocultar_tour" => "1"), $_SESSION['usuario']['id']);
        $_SESSION['usuario']['gl_ocultar_tour'] = 1;
    }
    */

    /*
    public function ocultarTourSession(){
	$_SESSION['usuario']['gl_ocultar_tour'] = 1;
    }
    */
    
    /*
    public function buscarRut(){
        $arrComunicacion[0] = "OK";
        $arrComunicacion['rut']	= trim($_POST['rut']);	
        //echo "http://localhost/sipresa/jsonp/BuscarRut.php?rut=".$arrComunicacion['rut'];
        $arrBusqueda = get_data("http://200.55.194.54/programacion/jsonp/BuscarRut.php?rut=".$arrComunicacion['rut']);		
        $arrBusqueda = json_decode($arrBusqueda);	
        
        $this->smarty->assign("arrResultado",$arrBusqueda);
        $this->smarty->display('home/tabla_buscar_rut.tpl');
    }
    */
    
    /*
    public function buscarDireccion(){
        //Obtener parametros desde

        //print_r($_POST);

        $arr[0] = "OK";
        $arr['region'] 			= trim($_POST['region']); 
        $arr['comuna'] 			= trim($_POST['id_comuna']);
        $arr['calle'] 			= trim($_POST['gl_calle']);
        $arr['numero'] 			= trim($_POST['nr_numero']);
        $arr['rut']				= trim($_POST['gl_rut']);	
        $arr['nombre_fantasia']	= trim($_POST['gl_nombre_fantasia']);	
        $arr['razon_social']	= trim($_POST['gl_razon']);	

        //error_reporting(E_ALL);
        //ini_set('display_errors', '1');

        //Obtener datos desde SIPRESA
        $arrBusqueda = get_data_encrypt("http://200.55.194.54/programacion/jsonp/BuscarDireccion.php",$arr);			

        //print_r($arrBusqueda);

        //Obtener registros de BD local
        //$arrBusqueda = $this->_DAOInstalacion->queryBusqueda($arr);

        $this->smarty->assign("arrResultado",$arrBusqueda);
        $this->smarty->display('home/tabla_buscar_rut.tpl');

    }
    */
}

?>