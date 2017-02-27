<?php

/*
  !IniHeaderDoc
 * ****************************************************************************
  !NombreObjeto 		: Registro.php
  !Sistema 	  	: PREVENCIÓN
  !Modulo 	  	: NA
  !Descripcion  		:
  !Plataforma   		: !PHP
  !Perfil       		:
  !Itinerado    		: NA
  !Uso          		: NA
  !Autor        		: Carolina Zamora Hormazábal, Orlando Vázquez
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
 * ****************************************************************************
  !EndHeaderDoc
 */

//** clase Admnistracion ***//
class Registro extends Controller {

    protected $_DAORegistro;
    protected $_DAOComuna;
    protected $_DAOCasoEgreso;
    protected $_DAORegion;
    protected $_DAOPrevision;
    protected $_DAOMotivoConsulta;
    protected $_DAOUsuarios;
    protected $_DAOEstadoCaso;
    protected $_DAOInstitucion;
	protected $_DAOEventos;
    protected $_DAOEventosTipo;
    protected $_DAOAdjuntos;
    protected $_DAOAdjuntosTipo;
    protected $_DAOEmpa;
    protected $_DAOExamenRegistro;

    function __construct() {
        parent::__construct();
        $this->load->lib('Fechas', false);
        $this->load->lib('Boton', false);
        $this->_DAORegion			= $this->load->model("DAORegion");
        $this->_DAOComuna			= $this->load->model("DAOComuna");
        $this->_DAORegistro			= $this->load->model("DAORegistro");
        $this->_DAOCasoEgreso		= $this->load->model("DAOCasoEgreso");
        $this->_DAOEstadoCaso		= $this->load->model("DAOEstadoCaso");
        $this->_DAOPrevision		= $this->load->model("DAOPrevision");
        $this->_DAOMotivoConsulta	= $this->load->model("DAOMotivoConsulta");
        $this->_DAOUsuarios			= $this->load->model("DAOUsuarios");
        $this->_DAOInstitucion		= $this->load->model("DAOInstitucion");
        $this->_DAOEventosTipo		= $this->load->model("DAOEventosTipo");
		$this->_DAOEventos			= $this->load->model("DAOEventos");
        $this->_DAOAdjuntos			= $this->load->model("DAOAdjuntos");
        $this->_DAOAdjuntosTipo		= $this->load->model("DAOAdjuntosTipo");
        $this->_DAOEmpa				= $this->load->model("DAOEmpa");
        $this->_DAOExamenRegistro	= $this->load->model("DAOExamenRegistro");
    }

    /*
     * Index
     */

    public function index() {
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
        $arr = $this->_DAORegistro->getListaRegistro();
        $this->smarty->assign('arrResultado', $arr);

        //llamado al template
        $this->_display('Registro/index.tpl');
        $this->load->javascript(STATIC_FILES . "js/templates/registro/formulario.js");

    }

    public function bitacora() {

        $parametros = $this->request->getParametros();
        $idReg = $parametros[0];
        $detReg = $this->_DAORegistro->getRegistroxId($idReg);
        
        if (!is_null($detReg)) {
            //$this->smarty->assign("detReg", $detReg);
            
            $this->smarty->assign("idreg", $idReg);
            
            //Datos de Registro
            $run = "";
            $ext = "NO";
            if (!is_null($detReg->rut))
            {
                $run = $detReg->rut;
            }
            else {
                $run = $detReg->run_pass;
                $ext = "SI";
            }
            $this->smarty->assign("run", $run);
            $this->smarty->assign("ext", $ext);
            //$this->smarty->assign("nombres", $detReg->nombres);
            //$this->smarty->assign("apellidos", $detReg->apellidos);
            $nombres = $detReg->nombres.' '.$detReg->apellidos;
            $this->smarty->assign("nombres", $nombres);
            
            //$edad = "";
            $edad = Fechas::calcularEdadInv($detReg->fc_nacimiento);
            $this->smarty->assign("fecha_nac", $detReg->fc_nacimiento);
            $this->smarty->assign("edad", $edad);
            
            $genero = "FEMENINO"; //obtener de BD y validad a futuro
            $this->smarty->assign("genero", $genero);
            $this->smarty->assign("estado", $detReg->estado);
            
            $this->smarty->assign("prevision", $detReg->prevision);
            $this->smarty->assign("grupo", $detReg->grupo);
            
            $this->smarty->assign("direccion", $detReg->direccion);
            $this->smarty->assign("fono", $detReg->fono);
            
            $this->smarty->assign("celular", $detReg->celular);
            $this->smarty->assign("email", $detReg->email);
            
            $this->smarty->assign("comuna", $detReg->comuna);
            $this->smarty->assign("provincia", $detReg->provincia);
            
            $this->smarty->assign("region", $detReg->region);
            $this->smarty->assign("fecha_reg", $detReg->fc_crea);
            
            $reconoce = "NO";
            if (!is_null($detReg->reconoce))
            {
                if ($detReg->reconoce)
                {
                    $reconoce = "SI";
                }                
            }
            $acepta = "NO";
            if (!is_null($detReg->acepta))
            {
                if ($detReg->acepta)
                {
                    $acepta = "SI";
                }                
            }
            $this->smarty->assign("reconoce", $reconoce);
            $this->smarty->assign("acepta", $acepta);
            
            //Grilla Motivos de Consulta
            $arrConsultas = $this->_DAOMotivoConsulta->getMotivosConsultaGrilla($idReg);
            $this->smarty->assign('arrConsultas', $arrConsultas);
            
            //Grilla Empa
            $arrEmpa = $this->_DAOEmpa->getEmpaGrilla($idReg);
            $this->smarty->assign('arrEmpa', $arrEmpa);
            
            //Grilla Exámenes x Registro
            $arrExamenes = $this->_DAOExamenRegistro->getListaExamenRegistroxId($idReg);
            $this->smarty->assign('arrExamenes', $arrExamenes);
            
            //Tipos de Eventos
            $arrTipoEvento = $this->_DAOEventosTipo->getListaEventosTipo();
            $this->smarty->assign('arrTipoEvento', $arrTipoEvento);
            
            //Grilla Bitácora
            $arrHistorial = $this->_DAORegistro->getEventosRegistro($idReg);
            $this->smarty->assign('arrHistorial', $arrHistorial);
            
            //Tipos de Adjuntos
            $arrTipoDocumento = $this->_DAOAdjuntosTipo->getListaAdjuntosTipo();
            $this->smarty->assign('arrTipoDocumento', $arrTipoDocumento);
            
            //Grilla Adjuntos
            $arrAdjuntos = $this->_DAOAdjuntos->getListaAdjuntosRegistro($idReg);
            $this->smarty->assign('arrAdjuntos', $arrAdjuntos);
            
			$this->smarty->assign("botonAyudaPaciente", Boton::botonAyuda('Datos personales y de exámenes del paciente.','Información'));
			
            //muestra template
            $this->smarty->display('Registro/bitacora.tpl');
            $this->_addJavascript(STATIC_FILES . 'js/templates/registro/bitacora.js');
        } else {
            throw new Exception("El historial que está buscando no existe");
        }
    }

    public function nuevo() {
        Acceso::redireccionUnlogged($this->smarty);
        $sesion = New Zend_Session_Namespace("usuario_carpeta");
        $this->smarty->assign("id_usuario", $sesion->id);
        $this->smarty->assign("rut", $sesion->rut);
        $this->smarty->assign("usuario", $sesion->usuario);

        $arrRegiones = $this->_DAORegion->getListaRegiones();
        $this->smarty->assign("arrRegiones", $arrRegiones);

        $arrPrevision = $this->_DAOPrevision->getListaPrevision();
        $this->smarty->assign("arrPrevision", $arrPrevision);

        $arrCasoEgreso = $this->_DAOCasoEgreso->getListaCasoEgreso();
        $this->smarty->assign("arrCasoEgreso", $arrCasoEgreso);
		
        $this->smarty->assign("botonAyudaPaciente", Boton::botonAyuda('Ingrese datos personales del paciente.','Ayuda'));
		$this->smarty->assign("botonAyudaContacto", Boton::botonAyuda('Ingrese datos de contacto del paciente.','Ayuda'));
        //llamado al template
        $this->_display('Registro/nuevo.tpl');
        $this->load->javascript(STATIC_FILES . "js/regiones.js");
        $this->load->javascript(STATIC_FILES . "js/templates/registro/formulario.js");
        $this->load->javascript(STATIC_FILES . "js/templates/registro/nuevo.js");
        $this->load->javascript(STATIC_FILES . "js/lib/validador.js");
    }

    public function GuardarRegistro() {
        header('Content-type: application/json');
        $parametros		= $this->_request->getParams();
		$correcto		= false;
        $error			= false;
		$gl_grupo_tipo	= 'Control';
		$datos_evento	= array(); 
        $count			= $this->_DAORegistro->countRegistroxRegion($_SESSION['id_region']);

		if($parametros['edad'] > 15 AND $_SESSION['gl_grupo_tipo'] == 'Seguimiento' AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50){
			$gl_grupo_tipo	= 'Seguimiento';
		}
		$parametros['gl_grupo_tipo']	= $gl_grupo_tipo;

        $id_registro	= $this->_DAORegistro->insertarRegistro($parametros);
        if($id_registro){

			$correcto						= true;
			$resultado2						= $this->_DAOMotivoConsulta->insertarMotivoConsulta($parametros,$id_registro);
			$resultado3						= $this->_DAOEmpa->insert(array('id_registro'=>$id_registro,'nr_orden'=>1));
			$resultado4						= $this->_DAOEmpa->insert(array('id_registro'=>$id_registro,'nr_orden'=>2));

			$session						= New Zend_Session_Namespace("usuario_carpeta");
			$datos_evento['eventos_tipo']	= 1;
			$datos_evento['id_registro']	= $id_registro;
			$datos_evento['gl_descripcion']	= "Registro creado el : ".Fechas::fechaHoy(); 
			$datos_evento['bo_estado']		= 1; 
			$datos_evento['id_usuario_crea']= $session->id;
			$resp							= $this->_DAOEventos->insEvento($datos_evento);

			if ($parametros['chkAcepta']){
				$datos_evento['eventos_tipo']	= 4;
				$datos_evento['gl_descripcion']	= "Acepta el programa con fecha : ".Fechas::fechaHoy();
				$resp							= $this->_DAOEventos->insEvento($datos_evento);
			}
			if ($parametros['chkReconoce']){
				$datos_evento['eventos_tipo']	= 5;
				$datos_evento['gl_descripcion']	= "Reconoce violencia con fecha : ".Fechas::fechaHoy();
				$resp							= $this->_DAOEventos->insEvento($datos_evento);
			}
        }else{
            $error		= true;
        }

        $salida	= array("error" => $error,
            "correcto" => $correcto);
        $this->smarty->assign("hidden", "");
        $json	= Zend_Json::encode($salida);

        echo $json;
    }

    public function ver() {
        $parametros		= $this->request->getParametros();
        $id_registro	= $parametros[0];
        $obj_registro	= $this->_DAORegistro->verInfoById($id_registro);
		
        if (!is_null($obj_registro)) {
            $edad				= Fechas::calcularEdadInv($obj_registro->fc_nacimiento);
            $arrMotivosConsulta	= $this->_DAOMotivoConsulta->getListaMotivoConsultaByRegistro($obj_registro->id_registro);
        }
        $this->smarty->assign('id_registro', $obj_registro->id_registro);
        $this->smarty->assign('rut', $obj_registro->gl_rut);
        $this->smarty->assign('extranjero', $obj_registro->bo_extranjero);
        $this->smarty->assign('run_pass', $obj_registro->gl_run_pass);
        $this->smarty->assign('nombres', $obj_registro->gl_nombres);
        $this->smarty->assign('apellidos', $obj_registro->gl_apellidos);
        $this->smarty->assign('fecha_nacimiento', $obj_registro->fc_nacimiento);
        $this->smarty->assign('sexo', $obj_registro->gl_sexo);
        $this->smarty->assign('direccion', $obj_registro->gl_direccion);
        $this->smarty->assign('fono', $obj_registro->gl_fono);
        $this->smarty->assign('celular', $obj_registro->gl_celular);
        $this->smarty->assign('email', $obj_registro->gl_email);
        $this->smarty->assign('latitud', $obj_registro->gl_latitud);
        $this->smarty->assign('longitud', $obj_registro->gl_longitud);
        $this->smarty->assign('reconoce', $obj_registro->bo_reconoce);
        $this->smarty->assign('acepta', $obj_registro->bo_acepta_programa);
        $this->smarty->assign('prevision', $obj_registro->gl_nombre_prevision);
        $this->smarty->assign('comuna', $obj_registro->gl_nombre_comuna);
        $this->smarty->assign('region', $obj_registro->gl_nombre_region);
        $this->smarty->assign('edad', $edad);
        $this->smarty->assign('nombre_registrador', $obj_registro->gl_nombre_usuario_crea);
        $this->smarty->assign('estado_caso', $obj_registro->gl_nombre_estado_caso);
        $this->smarty->assign('institucion', $obj_registro->gl_nombre_institucion);
        $this->smarty->assign('arrMotivosConsulta', $arrMotivosConsulta);
        $this->smarty->assign('ruta_consentimiento', $obj_registro->gl_path);
		$this->smarty->assign("botonAyudaSeguimiento", Boton::botonAyuda('Datos sobre el registro al paciente y motivos de consulta.','Información'));
		$this->smarty->assign("botonAyudaPaciente", Boton::botonAyuda('Datos personales del paciente.','Información'));
		$this->smarty->assign("botonAyudaContacto", Boton::botonAyuda('Datos para contactar al paciente.','Información'));
        $this->smarty->display('Registro/ver.tpl');
        $this->load->javascript(STATIC_FILES . "js/templates/registro/ver.js");
    }

    public function cargarComunasPorRegion() {
        $region		= $_POST['region'];
        $daoRegion	= $this->load->model('DAORegion');
        $comunas	= $daoRegion->obtComunasPorRegion($region)->rows;

        $json		= array();
        $i			= 0;
        foreach ($comunas as $comuna) {
            $json[$i]['id_comuna']		= $comuna->id_comuna;
            $json[$i]['nombre_comuna']	= $comuna->gl_nombre_comuna;
            $i++;
        }

        echo json_encode($json);
    }

    public function cargarCentroSaludporComuna() {
        $comuna			= $_POST['comuna'];
        $daoComuna		= $this->load->model('DAOComuna');
        $centrosalud	= $daoComuna->obtCentroSaludporComuna($comuna)->rows;

        $json			= array();
        $i				= 0;
        foreach ($centrosalud as $cSalud) {
            $json[$i]['id_establecimiento']		= $cSalud->id_establecimiento;
            $json[$i]['nombre_establecimiento']	= $cSalud->nombre_establecimiento;
            $i++;
        }

        echo json_encode($json);
    }

    public function cargarRegistro() {
        header('Content-type: application/json');
        $rut			= $_POST['rut'];
        $registro		= $this->_DAORegistro->getRegistroByRut($rut);
        $json			= array();

		if($registro){
			$json['correcto']			= TRUE;
			$json['id_registro']		= $registro->id_registro;
			$json['gl_nombres']			= $registro->gl_nombres;
			$json['gl_apellidos']		= $registro->gl_apellidos;
			$json['fc_nacimiento']		= $registro->fc_nacimiento;
			$json['id_prevision']		= $registro->id_prevision;
			$json['gl_direccion']		= $registro->gl_direccion;
			$json['id_region']			= $registro->id_region;
			$json['gl_nombre_comuna']	= $registro->gl_nombre_comuna;
			$json['id_comuna']			= $registro->id_comuna;
			$json['gl_centro_salud']	= $registro->gl_centro_salud;
			$json['id_centro_salud']	= $registro->id_centro_salud;
			$json['bo_reconoce']		= $registro->bo_reconoce;
			$json['bo_acepta_programa']	= $registro->bo_acepta_programa;
			$json['gl_latitud']			= $registro->gl_latitud;
			$json['gl_longitud']		= $registro->gl_longitud;
			$json['gl_fono']			= $registro->gl_fono;
			$json['gl_celular']			= $registro->gl_celular;
			$json['gl_email']			= $registro->gl_email;

		}else{
			$json['correcto']	= FALSE;
		}

        echo json_encode($json);
    }

}
