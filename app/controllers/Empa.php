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
        $this->load->lib('Boton', false);
        $this->_DAOEmpa             = $this->load->model("DAOEmpa");
		$this->_DAOEmpaAudit        = $this->load->model("DAOEmpaAudit");
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
        $id_empa    = $this->_DAOEmpa->getEmpaByIdRegistro($id_registro);
        $this->smarty->assign("id_empa", $id_empa -> id_empa);
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
        $fc_nacimiento = $registro->fc_nacimiento;
        $fc_nacimiento = date("d/m/Y", strtotime($fc_nacimiento));
        $this->smarty->assign("fc_nacimiento", $fc_nacimiento);
        $reconoce = $registro->bo_reconoce;
        
        //Cargar Datos DAU Examen
        //INICIO
        $empa	= $this->_DAOEmpa->verInfoById($id_empa -> id_empa);
        if($empa->gl_peso){
            $gl_peso = intval($empa->gl_peso);
            $this->smarty->assign("gl_peso", $gl_peso);
        }
        if($empa->gl_estatura){
            $gl_estatura = str_replace('.','',$empa->gl_estatura);
            $this->smarty->assign("gl_estatura", $gl_estatura);
        }
        if($empa->gl_circunferencia_abdominal){
            $gl_circunferencia_abdominal = intval($empa->gl_circunferencia_abdominal);
             $this->smarty->assign("gl_circunferencia_abdominal", $gl_circunferencia_abdominal);
        }
        if($empa->bo_consume_alcohol == 1){
            $this->smarty->assign("bo_consume_alcohol_1", 'checked');
        }else if($empa->bo_consume_alcohol == 0){
            $this->smarty->assign("bo_consume_alcohol_0", 'checked');
        }
        
        if($empa->bo_fuma == 1){
            $this->smarty->assign("bo_fuma_1", 'checked');
        }else if($empa->bo_fuma == 0){
            $this->smarty->assign("bo_fuma_0", 'checked');
        }
        
        $this->smarty->assign("gl_puntos_audit", $empa->gl_puntos_audit);
        $this->smarty->assign("gl_imc", $empa->gl_imc);
        $this->smarty->assign("id_clasificacion_imc", $empa->id_clasificacion_imc);
        $this->smarty->assign("gl_pas", $empa->gl_pas);
        $this->smarty->assign("gl_pad", $empa->gl_pad);
        $this->smarty->assign("gl_glicemia", $empa->gl_glicemia);
        if($empa->bo_glicemia_toma == 1){
            $this->smarty->assign("bo_glicemia_toma", 'checked');
        }
        
        if($empa->bo_trabajadora_reclusa == 1){
            $this->smarty->assign("bo_trabajadora_reclusa_1", 'checked');
        }else if($empa->bo_trabajadora_reclusa == 0){
            $this->smarty->assign("bo_trabajadora_reclusa_0", 'checked');
        }
        
        if($empa->bo_rpr == 1){
            $this->smarty->assign("bo_rpr_1", 'checked');
        }else if($empa->bo_rpr == 0){
            $this->smarty->assign("bo_rpr_0", 'checked');
        }
        
        if($empa->bo_vdrl == 1){
            $this->smarty->assign("bo_vdrl_1", 'checked');
        }else if($empa->bo_vdrl == 0){
            $this->smarty->assign("bo_vdrl_0", 'checked');
        }
        
        if($empa->bo_tos_productiva == 1){
            $this->smarty->assign("bo_tos_productiva_1", 'checked');
        }else if($empa->bo_tos_productiva == 0){
            $this->smarty->assign("bo_tos_productiva_0", 'checked');
        }
        
        if($empa->bo_baciloscopia_toma == 1){
            $this->smarty->assign("bo_baciloscopia_toma_1", 'checked');
        }else if($empa->bo_baciloscopia_toma == 0){
            $this->smarty->assign("bo_baciloscopia_toma_0", 'checked');
        }
        
        if($empa->bo_pap_realizado == 1){
            $this->smarty->assign("bo_pap_realizado_1", 'checked');
        }else if($empa->bo_pap_realizado == 0){
            $this->smarty->assign("bo_pap_realizado_0", 'checked');
        }
        
        $this->smarty->assign("fc_ultimo_pap", $empa->fc_ultimo_pap);
        $this->smarty->assign("fc_tomar_pap", $empa->fc_tomar_pap);
        
        if($empa->bo_pap_vigente == 1){
            $this->smarty->assign("bo_pap_vigente_1", 'checked');
        }else if($empa->bo_pap_vigente == 0){
            $this->smarty->assign("bo_pap_vigente_0", 'checked');
        }
        
        if($empa->bo_pap_toma == 1){
            $this->smarty->assign("bo_pap_toma_1", 'checked');
        }else if($empa->bo_pap_toma == 0){
            $this->smarty->assign("bo_pap_toma_0", 'checked');
        }
        
        $this->smarty->assign("gl_colesterol", $empa->gl_colesterol);
        
        if($empa->bo_colesterol_toma == 1){
            $this->smarty->assign("bo_colesterol_toma", 'checked');
        }
        
        if($empa->bo_mamografia_realizada == 1){
            $this->smarty->assign("bo_mamografia_realizada_1", 'checked');
        }else if($empa->bo_mamografia_realizada == 0){
            $this->smarty->assign("bo_mamografia_realizada_0", 'checked');
        }
        
        if($empa->bo_mamografia_vigente == 1){
            $this->smarty->assign("bo_mamografia_vigente_1", 'checked');
        }else if($empa->bo_mamografia_vigente == 0){
            $this->smarty->assign("bo_mamografia_vigente_0", 'checked');
        }
        
        if($empa->bo_mamografia_toma == 1){
            $this->smarty->assign("bo_mamografia_toma", 'checked');
        }
        
        $this->smarty->assign("fc_mamografia", $empa->fc_mamografia);
        $this->smarty->assign("gl_observaciones_empa", $empa->gl_observaciones_empa);
        //FIN
        
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
		$this->smarty->assign("botonAyudaAlcoholico", Boton::botonAyuda("Evitar el uso de bebidas alcohólicas","Consejería","pull-left","btn-danger"));
		$this->smarty->assign("botonAyudaFumador", Boton::botonAyuda("Evitar el uso de tabaco","Consejería","pull-left","btn-danger"));
		$this->smarty->assign("botonAyudaCircunferenciaAbdominal", Boton::botonAyuda("Punto medio entre margen inferior de la ultima costilla y la cresta iliaca.","Información","pull-left","btn-info"));
		$this->smarty->assign("botonAyudaIMC", Boton::botonAyuda("Medida de asociación entre la masa y la talla de un individuo","Información","pull-left","btn-info"));        
		$this->smarty->assign("botonAyudaPAS", Boton::botonAyuda("si >= 140 es hipertensión","Información","pull-left","btn-info"));
		$this->smarty->assign("botonAyudaPAD", Boton::botonAyuda("si >= 90 es hipertensión","Información","pull-left","btn-info"));
		$this->smarty->assign("botonAyudaGlicemia", Boton::botonAyuda("en ayunas de 8 horas como mínimo","Indicaciones","pull-left","btn-warning"));
		$this->smarty->assign("botonConsejeriaGlicemia", Boton::botonAyuda("Reducir ingesta de azúcares y realizar actividad física (controlada)","Consejería","pull-right","btn-danger"));
		$this->smarty->assign("botonAyudaBasiloscopia", Boton::botonAyuda("1ra muestra de inmediato y entrega de una caja para muestra del día siguiente al despertar","Indicaciones","pull-left","btn-warning"));
		$this->smarty->assign("botonAyudaPAPVigente", Boton::botonAyuda("Fecha de vigencia: Menor o igual de 3 años","Información","pull-left","btn-info"));
		$this->smarty->assign("botonAyudaMamografiaVigente", Boton::botonAyuda("Fecha de vigencia: Menor o igual de 3 años","Información","pull-left","btn-info"));
		$this->smarty->assign("botonConsejeriaColesterol", Boton::botonAyuda("Reducir ingesta calorías y realizar actividad física (controlada)","Consejería","pull-right","btn-danger"));
		$this->smarty->assign("botonInformacionAgenda", Boton::botonAyuda("Referir confirmación diagnóstica con profesional de la salud.","Consejeria","pull-right","btn-danger"));
		$this->smarty->assign("botonInformacionAgendaITS", Boton::botonAyuda("Referir a profesional de ITS.","Consejeria","pull-right","btn-danger"));
		$this->smarty->assign("botonInformacionAgendaMamografia", Boton::botonAyuda("Agendar nueva mamografía.","Información","pull-right","btn-info"));
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
		$params = $this->request->getParametros();
        $id_empa = $params[0];
        $arrPreguntas = $this->_DAOAlcoholismo->getAll();
		$arrAudit = $this->_DAOEmpaAudit->getAuditByEMPA($id_empa);
		$total = 0;
		foreach($arrAudit as $item){
                if(is_null($item->nr_valor)){
//                    print_r($item->nr_valor);
//					print_r('<br>');
					$item->nr_valor = 0;
                    $total +=  $item->nr_valor;
                }else{
                    $total +=  $item->nr_valor;
					 //print_r($item->nr_valor);
					 //print_r('<br>');
                }
            }
//			print_r($total); die();
		$this->smarty->assign("total", $total);
		$this->smarty->assign("arrAudit", $arrAudit);
        $this->smarty->assign("arrPreguntas", $arrPreguntas);
        $this->smarty->display('Empa/audit.tpl');
    }

    public function guardar(){
        header('Content-type: application/json');
       /*  Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);
		*/
        
        $parametros		= $this->_request->getParams();
		$correcto		= false;
        $error			= false;
        $id_empa                = $this->_DAOEmpa->updateEmpa($parametros);
        if($id_empa){
            $correcto           = true;
        }else{
            $error		= true;
        }

        $salida	= array("error" => $error,
                        "correcto" => $correcto);
        $json	= Zend_Json::encode($salida);

        echo $json;
    }
}