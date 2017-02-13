<?php
/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: RegistroMordedores.php
!Sistema 	  	: SIRAM
!Modulo 	  	: NA
!Descripcion  		: 
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal
!Creacion     		: 02/02/2017
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

class RegistroMordedores extends Controller{
	
    protected $_DAORegistroMordedores;

    /*
     * Constructor
     */
    function __construct(){
        parent::__construct();
        $this->_DAORegistroMordedores = $this->load->model("DAORegistroMordedores");
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
        
        $this->_display('RegistroMordedores/Registrar/registrar.tpl');
    }
    
    /*
     * Buscar Mordedores
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
        
        $arr = $this->_DAORegistroMordedores->getListaIncidentes();
        $this->smarty->assign('arrResultado', $arr);
        
        $this->_display('RegistroMordedores/Buscar/buscar.tpl');
    }
    
    /*
     * Ver Detalle Noticia
     */
    public function verRegistro(){
        $parametros = $this->request->getParametros();
        
        $id_noticia = $parametros[0];
        $titulo = "";
        $resumen = "";
        $cuerpo = "";
        $id_cat = "";
        $id_usr = "";
        $id_img = "";
        
        $result = $this->_DAONoticias->getNoticia($id_noticia);
        if ($result){
            $titulo = $result->not_titulo;
            $resumen = $result->not_resumen;
            $cuerpo = $result->not_cuerpo;
            $id_cat = $result->not_cat_id;
            $id_usr = $result->not_usr_id;
            $id_img = $result->not_med_id_img;
            
            $this->smarty->assign("titulo",$titulo);
            $this->smarty->assign("resumen",$resumen);
            $this->smarty->assign("cuerpo",$cuerpo);
            //falta categoria
            //falta imagen
            //falta usuario
            
            $this->smarty->assign("hidden","hidden");
        }
           
        $this->_display('home/ver_noticia.tpl');
    }
    
    /*
     * Tareas
     */
    public function tareas(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
//        $this->smarty->assign("id_usuario", $sesion->id);
//        $this->smarty->assign("rut", $sesion->rut);
//        $this->smarty->assign("usuario", $sesion->usuario);
//        
//        //llamada al _DAOAdministracion para listar regiones
//        $arr = $this->_DAOAdministracion->getListaRegiones();
//        $this->smarty->assign('arrResultado', $arr);
        
        $this->_display('RegistroMordedores/Tareas/tareas.tpl');
    }
    
    /*
     * Reportes Mordedores
     */
    public function reportesMordedores(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
//        $this->smarty->assign("id_usuario", $sesion->id);
//        $this->smarty->assign("rut", $sesion->rut);
//        $this->smarty->assign("usuario", $sesion->usuario);
//        
//        //llamada al _DAOAdministracion para listar regiones
//        $arr = $this->_DAOAdministracion->getListaRegiones();
//        $this->smarty->assign('arrResultado', $arr);
        
        $this->_display('RegistroMordedores/Reportes/reportes_mordedores.tpl');
    }
    
    /*
     * Reportes Vacunas
     */
    public function reportesVacunas(){
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
//        $this->smarty->assign("id_usuario", $sesion->id);
//        $this->smarty->assign("rut", $sesion->rut);
//        $this->smarty->assign("usuario", $sesion->usuario);
//        
//        //llamada al _DAOAdministracion para listar regiones
//        $arr = $this->_DAOAdministracion->getListaRegiones();
//        $this->smarty->assign('arrResultado', $arr);
        
        $this->_display('RegistroMordedores/Reportes/reportes_vacunas.tpl');
    }
    
    /*//creada por BC
    public function guardarRegion(){
            $session = New Zend_Session_Namespace("usuario_carpeta");
            $data = array();
            parse_str($_POST['data'], $data);

            $this->load->lib('Constantes', false);

            $json = array();
            $datos = $data;
            $datos['nr_estado'] =1;
            $insertar = $this->_DAOAdministracion->insRegion($datos);

            if ($insertar) {
                $id_solicitud = $insertar;
                $json['estado'] = true;
                $json['mensaje'] = 'Proyecto ingresado correctamente';
            }
            echo json_encode($json);
    }
    */
}