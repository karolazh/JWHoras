<?php

/**
 * *****************************************************************************
 * Sistema          : PREVENCION DE FEMICIDIOS
 * Descripcion      : Controller para Bitácora de Paciente
 * Plataforma       : !PHP
 * Creacion         : 09/03/2017
 * @name			Bitacora.php
 * @version         1.0
 * @author          Carolina Zamora <carolina.zamora@cosof.cl>
 * =============================================================================
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * -----------------------------------------------------------------------------
 * 
 * -----------------------------------------------------------------------------
 * *****************************************************************************
 */
class Bitacora extends Controller {

	protected $_DAOPaciente;
	protected $_DAOPacienteRegistro;
	protected $_DAOEvento;
	protected $_DAOEventoTipo;
	protected $_DAOAdjunto;
	protected $_DAOAdjuntoTipo;
	protected $_DAOEmpa;
	protected $_DAOPacienteExamen;
	protected $_DAOPacienteDireccion;
	protected $_Evento;
	protected $_DAOPacientePlanTratamiento;

	function __construct() {
		parent::__construct();
		$this->load->lib('Fechas', false);
        $this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);
		$this->_Evento = new Evento();
		$this->_DAOPaciente				= $this->load->model("DAOPaciente");
		$this->_DAOPacienteRegistro		= $this->load->model("DAOPacienteRegistro");
		$this->_DAOEvento				= $this->load->model("DAOEvento");
		$this->_DAOEventoTipo			= $this->load->model("DAOEventoTipo");
		$this->_DAOAdjunto				= $this->load->model("DAOAdjunto");
		$this->_DAOAdjuntoTipo			= $this->load->model("DAOAdjuntoTipo");
		$this->_DAOEmpa					= $this->load->model("DAOEmpa");
		$this->_DAOPacienteExamen		= $this->load->model("DAOPacienteExamen");
		$this->_DAOPacienteDireccion	= $this->load->model("DAOPacienteDireccion");
		$this->_DAOPacientePlanTratamiento	= $this->load->model("DAOPacientePlanTratamiento");
	}

	public function index() {
		Acceso::redireccionUnlogged($this->smarty);
//
//		$arr = $this->_DAOPaciente->getListaDetalle();
//		$this->smarty->assign('arrResultado', $arr);
//		$this->smarty->assign('titulo', 'Pacientes');
//
//		$this->_display('Paciente/index.tpl');
//		$this->load->javascript(STATIC_FILES . "js/templates/Paciente/index.js");
	}

	/**
	 * Descripción: Bitacora de Paciente
	 * @author Carolina Zamora Hormazábal
	 */
	public function ver() {

        $parametros = $this->request->getParametros();
        $id_paciente = $parametros[0];
        //$detReg = $this->_DAOPaciente->getById($idReg);
        $detPaciente = $this->_DAOPaciente->getByIdPaciente($id_paciente);

        if (!is_null($detPaciente)) {
            //$this->smarty->assign("detReg", $detReg);

            $this->smarty->assign("id_paciente", $id_paciente);

            //Datos de Paciente
            $run = "";
            if ($detPaciente->bo_extranjero == 0) {
                $run = $detPaciente->gl_rut;
            } else {
                $run = $detPaciente->gl_run_pass;
            }
            $this->smarty->assign("run", $run);

            $nombres = $detPaciente->gl_nombres.' '.$detPaciente->gl_apellidos;
            $this->smarty->assign("nombres", $nombres);

            $edad = Fechas::calcularEdadInv($detPaciente->fc_nacimiento);
            $this->smarty->assign("fc_nacimiento", $detPaciente->fc_nacimiento);
            $this->smarty->assign("edad", $edad);

            if ($detPaciente->gl_sexo == "F") {
                $sexo = "FEMENINO";
            } else {
                $sexo = $detPaciente->gl_sexo;
            }
            $this->smarty->assign("gl_sexo", $sexo);
            $this->smarty->assign("gl_nombre_estado_caso", $detPaciente->gl_nombre_estado_caso);

            $this->smarty->assign("gl_nombre_prevision", $detPaciente->gl_nombre_prevision);
            $this->smarty->assign("gl_grupo_tipo", $detPaciente->gl_grupo_tipo);

            //$this->smarty->assign("direccion", $detPaciente->gl_direccion);
            $this->smarty->assign("gl_fono", $detPaciente->gl_fono);

            $this->smarty->assign("gl_celular", $detPaciente->gl_celular);
            $this->smarty->assign("gl_email", $detPaciente->gl_email);

            //$this->smarty->assign("comuna", $detPaciente->gl_nombre_comuna);
            //$this->smarty->assign("provincia", $detPaciente->gl_nombre_provincia);

            //$this->smarty->assign("region", $detPaciente->gl_nombre_region);
            $this->smarty->assign("fc_crea", $detPaciente->fc_crea);

            $reconoce = "NO";
            if (!is_null($detPaciente->bo_reconoce)) {
                if ($detPaciente->bo_reconoce) {
                    $reconoce = "SI";
                }
            }
            $acepta = "NO";
            if (!is_null($detPaciente->bo_acepta_programa)) {
                if ($detPaciente->bo_acepta_programa) {
                    $acepta = "SI";
                }
            }
            $this->smarty->assign("bo_reconoce", $reconoce);
            $this->smarty->assign("bo_acepta_programa", $acepta);

            //Grilla Direcciones
            $muestra_direcciones = "NO";
            $arrDirecciones = $this->_DAOPacienteDireccion->getByIdDirecciones($id_paciente);
            //print_r($arrDirecciones);
            //die();
            if (!is_null($arrDirecciones)) {
                if($arrDirecciones->numRows>1){
                    $this->smarty->assign('arrDirecciones', $arrDirecciones->rows);
                    $muestra_direcciones = "SI";
                }
            }
            $this->smarty->assign("muestra_direcciones", $muestra_direcciones);

            //Grilla Motivos de Consulta (Paciente-Registro)
            $arrConsultas = $this->_DAOPacienteRegistro->getByIdPaciente($id_paciente);
            $this->smarty->assign('arrConsultas', $arrConsultas);

            //Grilla Exámenes Alterados x Paciente
            $muestra_examenes = "NO";
            $arrExamenesAlt = $this->_DAOPacienteExamen->getByIdPacienteAlterado($id_paciente);
            if (!is_null($arrExamenesAlt)) {
                $this->smarty->assign('arrExamenesAlt', $arrExamenesAlt);
                $muestra_examenes = "SI";
            }
            $this->smarty->assign("muestra_examenes", $muestra_examenes);

            //Grilla Empa
            $arrEmpa = $this->_DAOEmpa->getListaEmpa($id_paciente);
            $this->smarty->assign('arrEmpa', $arrEmpa);

            //Grilla Exámenes x Paciente
            $arrExamenes = $this->_DAOPacienteExamen->getByIdPaciente($id_paciente);
            $this->smarty->assign('arrExamenes', $arrExamenes);

            //Tipos de Eventos
            $arrTipoEvento = $this->_DAOEventoTipo->getLista();
            $this->smarty->assign('arrTipoEvento', $arrTipoEvento);

            //Grilla Eventos
            $arrEventos = $this->_DAOEvento->getEventosPaciente($id_paciente);
            $this->smarty->assign('arrEventos', $arrEventos);

            //Tipos de Adjuntos
            $arrTipoDocumento = $this->_DAOAdjuntoTipo->getLista();
            $this->smarty->assign('arrTipoDocumento', $arrTipoDocumento);

            //Grilla Adjuntos
            $arrAdjuntos = $this->_DAOAdjunto->getDetalleByIdPaciente($id_paciente);
            $this->smarty->assign('arrAdjuntos', $arrAdjuntos);

            //Plan Tratamiento
            $arr_plan	= $this->_DAOPacientePlanTratamiento->getByIdPaciente($id_paciente);
            $this->smarty->assign("arr_plan", $arr_plan);

            //Dirección Vigente de Paciente
            $direccion = "";
            $comuna = "";
            $provincia = "";
            $region = "";
            $detDireccion = $this->_DAOPacienteDireccion->getByIdDireccionVigente($id_paciente);
            //print_r($detDireccion);
            //die();
            if (!is_null($detDireccion)) {
                $direccion = $detDireccion->gl_direccion;
                $comuna = $detDireccion->gl_nombre_comuna;
                $provincia = $detDireccion->gl_nombre_provincia;
                $region = $detDireccion->gl_nombre_region;
                //die($direccion);
            }
            $this->smarty->assign("gl_nombre_comuna", $comuna);
            $this->smarty->assign("gl_nombre_provincia", $provincia);
            $this->smarty->assign("gl_nombre_region", $region);
            $this->smarty->assign("gl_direccion", $direccion);

            //muestra template
            $this->smarty->display('bitacora/ver.tpl');
            $this->load->javascript(STATIC_FILES . 'js/templates/bitacora/ver.js');
        } else {
            throw new Exception("El historial que está buscando no existe");
        }
	}

	/**
	 * Descripción : permite guardar nuevo archivo adjunto desde bitácora
	 * @author Carolina Zamora H.
	 * @param
	 * @return JSON
	 */
	public function guardarNuevoAdjunto() {
        header('Content-type: application/json');

        $correcto = false;
        $error = true;

        $adjunto = $_FILES['archivo'];
        $id_paciente = $_POST['idpac'];
        $tipo_doc = $_POST['tipodoc'];
        $tipo_txt = $_POST['tipotxt'];
        $glosa = $_POST['comentario'];
        $glosa = trim($glosa);
        
        if ($glosa == "") {
            $glosa = "Adjunta Documento por Bitácora";
        }

        $nombre_adjunto = $adjunto['name'];

        $arr_extension = array('jpeg', 'jpg', 'png', 'gif', 'tiff', 'bmp',
                               'pdf', 'txt', 'csv', 'doc', 'docx', 'ppt',
                               'pptx', 'xls', 'xlsx', 'eml');

        $nombre_adjunto = strtolower(trim($nombre_adjunto));
        $nombre_adjunto = trim($nombre_adjunto, ".");

        $extension = substr(strrchr($nombre_adjunto, "."), 1);

        //obtiene fecha y hora
        $date = new DateTime();
        $result = $date->format('Y-m-d_H-i-s');
        $krr = explode('-', $result);
        $result = implode("", $krr);

        $gl_nombre_archivo = $result . '_' . $tipo_txt . '.' . $extension;

        $directorio = "archivos/$id_paciente/";
        $gl_path = $directorio . $gl_nombre_archivo;

        $ins_adjunto = array('id_paciente'     => $id_paciente,
                             'id_adjunto_tipo' => $tipo_doc,
                             'gl_nombre'       => $gl_nombre_archivo,
                             'gl_path'         => $gl_path,
                             'gl_glosa'        => $glosa,
                             'sha256'          => Seguridad::generar_sha256($gl_path),
                             'fc_crea'         => date('Y-m-d h:m:s'),
                             'id_usuario_crea' => $_SESSION['id'],
                            );

        $id_adjunto = $this->_DAOAdjunto->insert($ins_adjunto);
        $grilla = "";

        if ($id_adjunto) {
            if (!is_dir($directorio)) {
                mkdir($directorio, 0775, true);

                $out = fopen($directorio . '/index.html', "w");
                fwrite($out, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
                fclose($out);
            }

            $file = fopen($adjunto['tmp_name'], 'r+b');
            $contenido = fread($file, filesize($adjunto['tmp_name']));
            fclose($file);

            $out = fopen($gl_path, "w");
            fwrite($out, $contenido);
            fclose($out);

            //Grilla Adjuntos
            $arrAdjuntos = $this->_DAOAdjunto->getDetalleByIdPaciente($id_paciente);
            $this->smarty->assign('arrAdjuntos', $arrAdjuntos);
            $grilla = $this->smarty->fetch('bitacora/grillaAdjuntos.tpl');

            $correcto = true;
        } else {
            $error = true;
        }

        $salida = array("error"    => $error,
                        "correcto" => $correcto,
                        "grilla"   => $grilla);

        $this->smarty->assign("hidden", "");
        $json = Zend_Json::encode($salida);

        echo $json;
	}
}