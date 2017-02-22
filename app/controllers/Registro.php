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
        $this->_DAORegion = $this->load->model("DAORegion");
        $this->_DAOComuna = $this->load->model("DAOComuna");
        $this->_DAORegistro = $this->load->model("DAORegistro");
        $this->_DAOCasoEgreso = $this->load->model("DAOCasoEgreso");
        $this->_DAOEstadoCaso = $this->load->model("DAOEstadoCaso");
        $this->_DAOPrevision = $this->load->model("DAOPrevision");
        $this->_DAOMotivoConsulta = $this->load->model("DAOMotivoConsulta");
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        $this->_DAOInstitucion = $this->load->model("DAOInstitucion");
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
        $parametros = $this->_request->getParams();
        $correcto = false;
        $error = false;
        $gl_grupo_tipo = 'Control';

        if ($parametros['edad'] > 15 AND $_SESSION['gl_grupo_tipo'] == 'Seguimiento' AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1) {
            $gl_grupo_tipo = 'Seguimiento';
        }
        $parametros['gl_grupo_tipo'] = $gl_grupo_tipo;

        $resultado = $this->_DAORegistro->insertarRegistro($parametros);
        $id_registro = $this->_DAORegistro->getRegistroxRut($parametros['rut']);
        $resultado2 = $this->_DAOMotivoConsulta->insertarMotivoConsulta($parametros, $id_registro);
        if ($resultado && $resultado2) {
            $correcto = true;
        } else {
            $error = true;
        }

        $salida = array("error" => $error,
            "correcto" => $correcto);
        $this->smarty->assign("hidden", "");
        $json = Zend_Json::encode($salida);

        echo $json;
    }

    public function ver() {
        Acceso::redireccionUnlogged($this->smarty);
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
            if (!is_null($obj_estado_caso)){
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
        $this->smarty->display('Registro/ver.tpl');
        $this->load->javascript(STATIC_FILES . "js/templates/registro/formulario.js");
        $this->load->javascript(STATIC_FILES . "js/templates/registro/ver.js");
    }

    public function cargarComunasPorRegion() {
        $region = $_POST['region'];

        $daoRegion = $this->load->model('DAORegion');
        $comunas = $daoRegion->obtComunasPorRegion($region)->rows;

        $json = array();
        $i = 0;
        foreach ($comunas as $comuna) {
            $json[$i]['id_comuna'] = $comuna->id_comuna;
            $json[$i]['nombre_comuna'] = $comuna->gl_nombre_comuna;
            $i++;
        }

        echo json_encode($json);
    }

    public function cargarCentroSaludporComuna() {
        $comuna = $_POST['comuna'];

        $daoComuna = $this->load->model('DAOComuna');
        $centrosalud = $daoComuna->obtCentroSaludporComuna($comuna)->rows;

        $json = array();
        $i = 0;
        foreach ($centrosalud as $cSalud) {
            $json[$i]['id_establecimiento'] = $cSalud->id_establecimiento;
            $json[$i]['nombre_establecimiento'] = $cSalud->nombre_establecimiento;
            $i++;
        }

        echo json_encode($json);
    }

    public function cargarRegistro() {
        header('Content-type: application/json');
        $rut = $_POST['rut'];
        //Datos de Tabla Registros
        $daoRegistro = $this->load->model('DAORegistro');
        $registro = $daoRegistro->getRegistroByRut($rut);
        //Datos de Tablas Comuna y Region
        $id_comuna = $registro->id_comuna;
        $daoComuna = $this->load->model('DAOComuna');
        $comunaRegion = $daoComuna->getComunaRegion($id_comuna);
        $json = array();
        $json[0]['rut'] = $registro->gl_rut;
        $json[0]['nombres'] = $registro->gl_nombres;
        $json[0]['apellidos'] = $registro->gl_apellidos;
        $json[0]['fec_nac'] = $registro->fc_nac;
        $json[0]['genero'] = $registro->gl_sexo;
        $json[0]['prevision'] = $registro->id_prevision;
        $json[0]['region'] = $comunaRegion->id_region;
        $json[0]['comuna'] = $comunaRegion->id_comuna;

        echo json_encode($json);
    }

}
