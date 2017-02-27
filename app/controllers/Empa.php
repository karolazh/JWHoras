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
        $this->_DAOEmpa             = $this->load->model("DAOEmpa");
        $this->_DAOUsuarios         = $this->load->model("DAOUsuarios");
        $this->_DAOComuna           = $this->load->model("DAOComuna");
        $this->_DAOInstitucion      = $this->load->model("DAOInstitucion");
        $this->_DAORegistro         = $this->load->model("DAORegistro");
        $this->_DAOAlcoholismo      = $this->load->model("DAOAlcoholismo");
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
        
        $arrResultado = $this->_DAORegistro->getListaRegistro();
        $this->smarty->assign("arrResultado", $arrResultado);
        
        $this->_display('Empa/index.tpl');
    }
    
    public function nuevo(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        $parametros = $this->request->getParametros();
        $id_registro = $parametros[0];
        $this->smarty->assign("id_registro", $id_registro);
        /* Obtener id de paciente a través de id de dau */
        $id_pac = 1;
        //Cargar Datos Enfermera
        $gl_comuna          = $this->_DAOComuna->getComuna($_SESSION['id_comuna']);
        $gl_institucion     = $this->_DAOInstitucion->getInstitucion($_SESSION['id_institucion']);
        
        
        $this->smarty->assign("gl_comuna", $gl_comuna->gl_nombre_comuna);
        $this->smarty->assign("gl_institucion",  $gl_institucion->gl_nombre);
        $this->smarty->assign("fc_emp", date('Y-m-d'));
        
        //Cargar Datos Paciente
        $registro          = $this->_DAORegistro->getRegistroById($id_registro);
        $this->smarty->assign("gl_rut", $registro->gl_rut);
        $this->smarty->assign("gl_nombres", $registro->gl_nombres);
        $this->smarty->assign("gl_apellidos", $registro->gl_apellidos);
        $this->smarty->assign("fc_nacimiento", $registro->fc_nacimiento);
        $reconoce = $registro->bo_reconoce;
        
        //Cargar Datos DAU Examen
        //$param = array("id_registro" => $id_registro);
        //$obj_empa	= $this->_DAOEmpa->verInfoById($param);
        //$this->smarty->assign("gl_peso", $obj_empa->gl_peso);
        
        if ($reconoce == 1){
            $check ="checked disabled";
        }else{
            $check="";
        }
        $this->smarty->assign("check", $check);
            //calculo edad
            $fc_nacimiento = $registro->fc_nacimiento;
            list($Y, $m, $d ) = explode("-", $fc_nacimiento);
            $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
        $this->smarty->assign("edad", $edad);
        //Mostrar/Ocultar Panel Dislipidemia segun Edad
        if ($edad > 40) {
            $dislipidemia = "display: block";
            $diabetes = "display: block";
            $antecedentes = "display: none";
        } else {
            $dislipidemia = "display: none";
            $diabetes = "display: none";
            $antecedentes = "display: block";
        }
        if ($edad > 24 && $edad < 65){
            $pap = "display: block";
        } else {
            $pap = "display: none";
        }
        $this->smarty->assign("pap", $pap);
        $this->smarty->assign("diabetes", $diabetes);
        $this->smarty->assign("antecedentes", $antecedentes);
        $this->smarty->assign("dislipidemia", $dislipidemia);
        $this->smarty->assign("gl_fono", $registro->gl_fono);
        $this->smarty->assign("gl_celular", $registro->gl_celular);
        $this->smarty->assign("gl_email", $registro->gl_email);
        $this->smarty->assign("gl_direccion", $registro->gl_direccion);

        //llamado al template
        $this->_display('Empa/nuevo.tpl');
        $this->load->javascript(STATIC_FILES . "js/templates/empa/nuevo.js");
        $this->load->javascript(STATIC_FILES . "js/lib/validador.js");
    }
    
    public function nuevoEmpa2(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        //llamado al template
        $this->_display('Empa/nuevo_empa2.tpl');
    }
    
    public function ver(){
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
        
        //llamado al template
        $this->_display('Empa/ver.tpl');
    }
    
    public function audit() {
        Acceso::redireccionUnlogged($this->smarty);
        $registro = $this->_DAOAlcoholismo->getAll();
        $this->smarty->assign("registro", $registro);
        $this->smarty->display('Empa/audit.tpl');
        $this->load->javascript(STATIC_FILES . "js/templates/empa/nuevo.js");
    }

    public function guardar(){
        header('Content-type: application/json');
        $parametros		= $this->_request->getParams();
	$correcto		= false;
        $error			= false;
        //$id_registro            = $this->_DAOEmpa->updateEmpa($parametros);
        $id_registro            = false;
        if($id_registro){
			$correcto       = true;
        }else{
            $error		= true;
        }

        $salida	= array("error" => $error,
                        "correcto" => $correcto);
        $this->smarty->assign("hidden", "");
        $json	= Zend_Json::encode($salida);

        echo $json;
    }
}