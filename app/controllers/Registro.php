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

    protected $_DAOEventosTipo;
    protected $_DAOAdjuntos;
    protected $_DAOAdjuntosTipo;
    protected $_DAOEmpa;
    protected $_DAOExamenRegistro;

    function __construct() {
        parent::__construct();
        $this->load->lib('Fechas', false);
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
    }

    public function bitacora() {

        $parametros = $this->request->getParametros();
        $idReg = $parametros[0];
        $detReg = $this->_DAORegistro->getRegistroxId($idReg);
        
        if (!is_null($detReg)) {
            //$this->smarty->assign("detReg", $detReg);
            
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
            
            //Grilla Empa
            $arrEmpa = $this->_DAOEmpa->getEmpaGrilla($idReg);
            $this->smarty->assign('arrEmpa', $arrEmpa);
            
            //Grilla Exámenes x Registro
            $arrExamenes = $this->_DAOExamenRegistro->getListaExamenRegistroxId($idReg);
            $this->smarty->assign('arrExamenes', $arrExamenes);
            
            //Grilla Motivos de Consulta
            $arrConsultas = $this->_DAOMotivoConsulta->getMotivosConsultaGrilla($idReg);
            $this->smarty->assign('arrConsultas', $arrConsultas);
            
            //muestra template
            $this->smarty->display('Registro/bitacora.tpl');
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
        $count			= $this->_DAORegistro->countRegistroxRegion($_SESSION['id_region']);

		if($parametros['edad'] > 15 AND $_SESSION['gl_grupo_tipo'] == 'Seguimiento' AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50){
			$gl_grupo_tipo	= 'Seguimiento';
		}
		$parametros['gl_grupo_tipo']	= $gl_grupo_tipo;

        $id_registro	= $this->_DAORegistro->insertarRegistro($parametros);
        if($id_registro){
			$resultado2	= $this->_DAOMotivoConsulta->insertarMotivoConsulta($parametros,$id_registro);
			$correcto	= true;
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
        $parametros = $this->request->getParametros();
        $id_registro = $parametros[0];
        $this->smarty->assign("id_registro", $id_registro);
        $obj_registro = $this->_DAORegistro->getRegistroById($id_registro);
        if (!is_null($obj_registro)) {
            $id_registro = $obj_registro->id_registro;
            $rut_registro = $obj_registro->gl_rut;
            $bo_extranjero = $obj_registro->bo_extranjero;
            $run_extranjero = $obj_registro->gl_run_pass;
            $nombres_registro = $obj_registro->gl_nombres;
            $apellido_registro = $obj_registro->gl_apellidos;
            $fecha_nacimiento_registro = $obj_registro->fc_nacimiento;
            $sexo_registro = $obj_registro->gl_sexo;
            $direccion_registro = $obj_registro->gl_direccion;
            $fono_registro = $obj_registro->gl_fono;
            $celular_registro = $obj_registro->gl_celular;
            $email_registro = $obj_registro->gl_email;
            $latitud_registro = $obj_registro->gl_latitud;
            $longitud_registro = $obj_registro->gl_longitud;
            $bo_reconoce_violencia_registro = $obj_registro->bo_reconoce;
            $bo_acepta_programa_registro = $obj_registro->bo_acepta_programa;
            $obj_adjunto = $this->_DAOAdjuntos->getAdjuntoByRegistro($obj_registro->id_registro);
            if (!is_null($obj_adjunto)) {
                $ruta_consentimiento = $obj_adjunto->gl_path;
            } else {
                $ruta_consentimiento = "";
            }
            $obj_prevision = $this->_DAOPrevision->getPrevision($obj_registro->id_prevision);
            if (!is_null($obj_prevision)) {
                $nombre_prevision = $obj_prevision->gl_nombre_prevision;
            } else {
                $nombre_prevision = "N/D";
            }
            $obj_comuna = $this->_DAOComuna->getComuna($obj_registro->id_comuna);
            if (!is_null($obj_comuna)) {
                $obj_comuna_region = $this->_DAOComuna->getComunaRegion($obj_comuna->id_comuna);
                $nombre_comuna = $obj_comuna->gl_nombre_comuna;
                $nombre_region = $obj_comuna_region->gl_nombre_region;
            } else {
                $nombre_comuna = "N/D";
                $nombre_region = "N/D";
            }
            $obj_usuario = $this->_DAOUsuarios->getById($obj_registro->id_usuario_crea);
            if (!is_null($obj_usuario)) {
                $nombre_registrador = "  " . $obj_usuario->gl_nombres . " " . $obj_usuario->gl_apellidos;
            } else {
                $nombre_registrador = "N/D";
            }
            $edad = Fechas::calcularEdadInv($obj_registro->fc_nacimiento);
            $obj_estado_caso = $this->_DAOEstadoCaso->getEstadoCaso($obj_registro->id_estado_caso);
            if (!is_null($obj_estado_caso)) {
                $nombre_estado_caso = $obj_estado_caso->gl_nombre_estado_caso;
            } else {
                $nombre_estado_caso = "N/D";
            }
            $obj_institucion = $this->_DAOInstitucion->getInstitucion($obj_registro->id_institucion);
            if (!is_null($obj_institucion)) {
                $institucion = $obj_institucion->gl_nombre;
            } else {
                $institucion = "N/D";
            }

            $arrMotivosConsulta = $this->_DAOMotivoConsulta->getListaMotivoConsultaByRegistro($obj_registro->id_registro);
        } else {
            $id_registro = "N/D";
            $rut_registro = "N/D";
            $bo_extranjero = "N/D";
            $run_extranjero = "N/D";
            $nombres_registro = "N/D";
            $apellido_registro = "N/D";
            $fecha_nacimiento_registro = "XX/XX/XXXX";
            $edad = "0";
            $sexo_registro = "N/D";
            $direccion_registro = "N/D";
            $fono_registro = "N/D";
            $celular_registro = "N/D";
            $email_registro = "N/D";
            $latitud_registro = "N/D";
            $longitud_registro = "N/D";
            $bo_reconoce_violencia_registro = false;
            $bo_acepta_programa_registro = false;
            $nombre_prevision = "N/D";
            $nombre_comuna = "N/D";
            $nombre_region = "N/D";
            $nombre_registrador = "N/D";
            $institucion = "N/D";
            $ruta_adjunto = "";
        }
        $this->smarty->assign('id_registro', $id_registro);
        $this->smarty->assign('rut', $rut_registro);
        $this->smarty->assign('extranjero', $bo_extranjero);
        $this->smarty->assign('run_pass', $run_extranjero);
        $this->smarty->assign('nombres', $nombres_registro);
        $this->smarty->assign('apellidos', $apellido_registro);
        $this->smarty->assign('fecha_nacimiento', $fecha_nacimiento_registro);
        $this->smarty->assign('sexo', $sexo_registro);
        $this->smarty->assign('direccion', $direccion_registro);
        $this->smarty->assign('fono', $fono_registro);
        $this->smarty->assign('celular', $celular_registro);
        $this->smarty->assign('email', $email_registro);
        $this->smarty->assign('latitud', $latitud_registro);
        $this->smarty->assign('longitud', $longitud_registro);
        $this->smarty->assign('reconoce', $bo_reconoce_violencia_registro);
        $this->smarty->assign('acepta', $bo_acepta_programa_registro);
        $this->smarty->assign('prevision', $nombre_prevision);
        $this->smarty->assign('comuna', $nombre_comuna);
        $this->smarty->assign('region', $nombre_region);
        $this->smarty->assign('edad', $edad);
        $this->smarty->assign('nombre_registrador', $nombre_registrador);
        $this->smarty->assign('estado_caso', $nombre_estado_caso);
        $this->smarty->assign('institucion', $institucion);
        $this->smarty->assign('arrMotivosConsulta', $arrMotivosConsulta);
        $this->smarty->assign('ruta_consentimiento', $ruta_consentimiento);
        $this->smarty->display('Registro/ver.tpl');
        $this->load->javascript(STATIC_FILES . "js/templates/registro/formulario.js");
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
                        $json['id_registro']			= $registro->id_registro;
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
