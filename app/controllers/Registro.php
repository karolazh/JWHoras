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

    //funcion construct
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

    public function detalleRegistro() {

        $parametros = $this->request->getParametros();
        $detReg = $this->_DAORegistro->getRegistroByRut($parametros[0]);
        if (!is_null($detReg)) {
            $this->smarty->assign("detReg", $detReg);
            $this->smarty->display('avanzados/detalle.tpl');
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
        Acceso::redireccionUnlogged($this->smarty);
        $parametros = $this->request->getParametros();
        $id_registro = $parametros[0];
        $this->smarty->assign("id_registro", $id_registro);
        $registro = $this->_DAORegistro->getRegistroById($id_registro);
        $prevision = $this->_DAOPrevision->getPrevision($registro->id_prevision);
        $comuna = $this->_DAOComuna->getComuna($registro->id_comuna);
        $comuna_region = $this->_DAOComuna->getComunaRegion($comuna->id_comuna);
        $region = $comuna_region->gl_nombre_region;
        $obj_usuario = $this->_DAOUsuarios->getById($registro->id_usuario_crea);
        $nombre_registrador = "  ". $obj_usuario->gl_nombres. " " . $obj_usuario->gl_apellidos;
        $edad = Fechas::calcularEdadInv($registro->fc_nacimiento);
        $estado_caso = $this->_DAOEstadoCaso->getEstadoCaso($registro->id_estado_caso);
        $nombre_estado_caso = $estado_caso->gl_nombre_estado_caso;
        $obj_institucion = $this->_DAOInstitucion->getInstitucion($registro->id_institucion);
        if(!is_null($obj_institucion)){
        $institucion = $obj_institucion->gl_nombre;
        } else {
            $institucion = "Sin Institucion";
        }
        $this->smarty->assign('id_registro', $registro->id_registro);
        $this->smarty->assign('rut', $registro->gl_rut);
        $this->smarty->assign('extranjero', $registro->bo_extranjero);
        $this->smarty->assign('run_pass', $registro->gl_run_pass);
        $this->smarty->assign('nombres', $registro->gl_nombres);
        $this->smarty->assign('apellidos', $registro->gl_apellidos);
        $this->smarty->assign('fecha_nacimiento', $registro->fc_nacimiento);
        $this->smarty->assign('sexo', $registro->gl_sexo);
        $this->smarty->assign('direccion', $registro->gl_direccion);
        $this->smarty->assign('fono', $registro->gl_fono);
        $this->smarty->assign('celular', $registro->gl_celular);
        $this->smarty->assign('email', $registro->gl_email);
        $this->smarty->assign('latitud', $registro->gl_latitud);
        $this->smarty->assign('longitud', $registro->gl_longitud);
        $this->smarty->assign('reconoce', $registro->bo_reconoce);
        $this->smarty->assign('acepta', $registro->bo_acepta_programa);
        $this->smarty->assign('prevision', $prevision->gl_nombre_prevision);
        $this->smarty->assign('comuna', $comuna->gl_nombre_comuna);
        $this->smarty->assign('region', $region);
        $this->smarty->assign('edad', $edad);
        $this->smarty->assign('nombre_registrador', $nombre_registrador);
        $this->smarty->assign('estado_caso', $nombre_estado_caso);
        $this->smarty->assign('institucion', $institucion);
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
