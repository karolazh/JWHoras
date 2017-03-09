<?php

/**
 * ****************************************************************************
 * Sistema		: PREVENCION DE FEMICIDIOS
 * Descripcion   : Controller para Registro de Paciente
 * Plataforma    : !PHP
 * Creacion		: 14/02/2017
 * @name			Paciente.php
 * @version		1.0
 * @author		Carolina Zamora <carolina.zamora@cosof.cl>
 * =============================================================================
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * -----------------------------------------------------------------------------
 * <david.guzman@cosof.cl>	06-03-2017	modificacion nombres DAO y funciones
 * <orlando.vazquez@cosof.co> 06-03-2017  Adaptacion a nueva BD de DAO's y funciones
 * <victor.retamal@cosof.co> 07-03-2017  fix GuardarRegistro() para nueva BD
 * -----------------------------------------------------------------------------
 * ****************************************************************************
 */
class Paciente extends Controller {

	protected $_DAORegion;
	protected $_DAOComuna;
	protected $_DAOPaciente;
	protected $_DAOTipoEgreso;
	protected $_DAOPrevision;
	protected $_DAOPacienteRegistro;
	protected $_DAOEvento;
	protected $_DAOEventoTipo;
	protected $_DAOAdjunto;
	protected $_DAOAdjuntoTipo;
	protected $_DAOEmpa;
	protected $_DAOPacienteExamen;
	protected $_DAOPacienteDireccion;
	protected $_DAOEmpaAudit;
	protected $_Evento;
	protected $_DAOPacientePlanTratamiento;

	function __construct() {
		parent::__construct();
		$this->load->lib('Fechas', false);
		$this->load->lib('Boton', false);
		$this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);
		$this->_Evento = new Evento();
		$this->_DAORegion				= $this->load->model("DAORegion");
		$this->_DAOComuna				= $this->load->model("DAOComuna");
		$this->_DAOPaciente				= $this->load->model("DAOPaciente");
		$this->_DAOTipoEgreso			= $this->load->model("DAOTipoEgreso");
		$this->_DAOPrevision			= $this->load->model("DAOPrevision");
		$this->_DAOPacienteRegistro		= $this->load->model("DAOPacienteRegistro");
		$this->_DAOEvento				= $this->load->model("DAOEvento");
		$this->_DAOEventoTipo			= $this->load->model("DAOEventoTipo");
		$this->_DAOAdjunto				= $this->load->model("DAOAdjunto");
		$this->_DAOAdjuntoTipo			= $this->load->model("DAOAdjuntoTipo");
		$this->_DAOEmpa					= $this->load->model("DAOEmpa");
		$this->_DAOPacienteExamen		= $this->load->model("DAOPacienteExamen");
		$this->_DAOPacienteDireccion	= $this->load->model("DAOPacienteDireccion");
		$this->_DAOEmpaAudit			= $this->load->model("DAOEmpaAudit");
		$this->_DAOPacientePlanTratamiento	= $this->load->model("DAOPacientePlanTratamiento");
	}

	public function index() {
		Acceso::redireccionUnlogged($this->smarty);

		$arr = $this->_DAOPaciente->getListaDetalle();
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('titulo', 'Pacientes');

		$this->_display('Paciente/index.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/Paciente/index.js");
	}

	/**
	 * Descripción: Bitacora de Paciente
	 * @author Carolina Zamora Hormazábal
	 */
	public function bitacora() {

            $parametros = $this->request->getParametros();
            $id_paciente = $parametros[0];
            //$detReg = $this->_DAOPaciente->getById($idReg);
            $detPaciente = $this->_DAOPaciente->getByIdPaciente($id_paciente);

            if (!is_null($detPaciente)) {
                //$this->smarty->assign("detReg", $detReg);

                $this->smarty->assign("idpac", $id_paciente);

                //Datos de Paciente
                $run = "";
                $ext = "NO";
                if (!is_null($detPaciente->gl_rut)) {
                        $run = $detPaciente->gl_rut;
                } else {
                        $run = $detPaciente->gl_run_pass;
                        $ext = "SI";
                }
                $this->smarty->assign("run", $run);
                $this->smarty->assign("ext", $ext);
                //$this->smarty->assign("nombres", $detReg->nombres);
                //$this->smarty->assign("apellidos", $detReg->apellidos);
                $nombres = $detPaciente->gl_nombres.' '.$detPaciente->gl_apellidos;
                $this->smarty->assign("nombres", $nombres);

                //$edad = "";
                $edad = Fechas::calcularEdadInv($detPaciente->fc_nacimiento);
                $this->smarty->assign("fecha_nac", $detPaciente->fc_nacimiento);
                $this->smarty->assign("edad", $edad);

                //$genero = $detPac->gl_sexo;
                $genero = "FEMENINO"; //obtener de BD y validad a futuro
                $this->smarty->assign("genero", $genero);
                $this->smarty->assign("estado", $detPaciente->gl_nombre_estado_caso);

                $this->smarty->assign("prevision", $detPaciente->gl_nombre_prevision);
                $this->smarty->assign("grupo", $detPaciente->gl_grupo_tipo);

                //$this->smarty->assign("direccion", $detPaciente->gl_direccion);
                $this->smarty->assign("fono", $detPaciente->gl_fono);

                $this->smarty->assign("celular", $detPaciente->gl_celular);
                $this->smarty->assign("email", $detPaciente->gl_email);

                //$this->smarty->assign("comuna", $detPaciente->gl_nombre_comuna);
                //$this->smarty->assign("provincia", $detPaciente->gl_nombre_provincia);

                //$this->smarty->assign("region", $detPaciente->gl_nombre_region);
                $this->smarty->assign("fecha_reg", $detPaciente->fc_crea);

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
                $this->smarty->assign("reconoce", $reconoce);
                $this->smarty->assign("acepta", $acepta);

                //Grilla Motivos de Consulta (Paciente-Registro)
                $arrConsultas = $this->_DAOPacienteRegistro->getByIdPaciente($id_paciente);
                $this->smarty->assign('arrConsultas', $arrConsultas);

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
                
                //muestra template
                $this->smarty->display('Paciente/bitacora.tpl');
                $this->load->javascript(STATIC_FILES . 'js/templates/paciente/bitacora.js');
            } else {
                throw new Exception("El historial que está buscando no existe");
            }
	}

	/**
	 * Descripción: Nuevo Registro
	 * @author: 
	 */
	public function nuevo() {
		Acceso::redireccionUnlogged($this->smarty);

		unset($_SESSION['adjuntos']);

		$arrRegiones = $this->_DAORegion->getLista();
		$this->smarty->assign("arrRegiones", $arrRegiones);

		$arrPrevision = $this->_DAOPrevision->getLista();
		$this->smarty->assign("arrPrevision", $arrPrevision);

		//$arrCasoEgreso = $this->_DAOTipoEgreso->getLista();
		//$this->smarty->assign("arrCasoEgreso", $arrCasoEgreso);

		$this->smarty->assign("botonAyudaPaciente", Boton::botonAyuda('Ingrese Datos del Paciente.', '', 'pull-right'));

		//llamado al template
		$this->_display('Paciente/nuevo.tpl');
		$this->load->javascript(STATIC_FILES . "js/regiones.js");
		$this->load->javascript(STATIC_FILES . "js/templates/paciente/nuevo.js");
		//$this->load->javascript(STATIC_FILES . "js/templates/adjunto/adjunto.js");
		$this->load->javascript(STATIC_FILES . "js/lib/validador.js");
	}

	/**
	 * Descripción: Guardar Registro
	 * @author: 
	 */
	public function GuardarRegistro() {
		header('Content-type: application/json');
		$session = New Zend_Session_Namespace("usuario_carpeta");
		$parametros		= $this->_request->getParams();
		
/*	$parametros	
(
    [id_paciente] => 0
    [gl_grupo_tipo] => 0
    [rut] => 
    [inputextranjero] => 2
    [nombres] => g
    [apellidos] => g
    [fc_nacimiento] => 1988-01-01
    [edad] => 29
    [prevision] => 2
    [gl_codigo_fonasa] => 
    [region] => 2
    [comuna] => 359
    [direccion] => Inglaterra 1131, Santiago, Independencia, Región Metropolitana, Chile
    [centrosalud] => 0
    [fono] => 
    [celular] => 
    [email] => 
    [motivoconsulta] => 
    [fechaingreso] => 2017-03-09
    [horaingreso] => 01:28
    [gl_latitud] => -33.412295209394344
    [gl_longitud] => -70.65502167446539
    [chkextranjero] => 1
    [chkAcepta] => 0
    [chkReconoce] => 0
)
		 */
		$correcto		= false;
		$error			= false;
		$id_paciente    = false;
		$gl_grupo_tipo	= 'Control';
		$id_tipo_grupo	= 1;
		$count			= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);

		if ($parametros['edad'] > 15 AND $_SESSION['id_tipo_grupo'] == 2 AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
			$gl_grupo_tipo = 'Tratamiento';
			$id_tipo_grupo = 2;
		}
		$parametros['gl_grupo_tipo'] = $gl_grupo_tipo;
		$parametros['id_tipo_grupo'] = $id_tipo_grupo;
		if ($parametros['chkextranjero'] != 1){
			$id_paciente =	$this->_DAOPaciente->insertarPaciente($parametros);
		} else if ($parametros['prevision'] == "1"){
			if ($parametros['gl_codigo_fonasa'] != ""){
				$id_paciente =	$this->_DAOPaciente->insertarPaciente($parametros);
			}
		}
		if ($id_paciente) {
			$correcto	= true;
			$session	= New Zend_Session_Namespace("usuario_carpeta");

			if (!empty($_SESSION['adjuntos'])) {
				/*
				 * 	Array
					(
						[id_adjunto] => 1
						[id_mensaje] => 1
						[nombre_adjunto] => Fonasa.pdf
						[mime_adjunto] => application/pdf
						[contenido] => JVBERi0xLjQKJcfsj6IKNCAwIG9iago8PC9MaW5lYXJpemVkIDEvTCAxNTYxNy9IWyAxMzE3NSAxMzhdL08gNi9FIDEzMTc1L04gMS9UIDE1NDk2Pj4KZW5kb2JqCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAp4cmVmCjQgMTMKMDAwMDAwMDAxNSAwMDAwMCBuIAowMDAwMDAwNTY4IDAwMDAwIG4gCjAwMDAwMDA2ODEgMDAwMDAgbiAKMDAwMDAwMDg0MSAwMDAwMCBuIAowMDAwMDAxNDM4IDAwMDAwIG4gCjAwMDAwMDE0NTcgMDAwMDAgbiAKMDAwMDAwMTQ5OCAwMDAwMCBuIAowMDAwMDAxNzQ4IDAwMDAwIG4gCjAwMDAwMDE5NTAgMDAwMDAgbiAKMDAwMDAwMTk4MCAwMDAwMCBuIAowMDAwMDAyMDExIDAwMDAwIG4gCjAwMDAwMTI3OTEgMDAwMDAgbiAKMDAwMDAxMzE3NSAwMDAwMCBuIAoKdHJhaWxlcgo8PC9TaXplIDE3L0luZm8gMSAwIFIvUm9vdCA1IDAgUi9JRFs8RDMwQzUxQTc1MkNCOEM2RDFCRDVEOEUxQ0IyMEFEQkE+PEQzMEM1MUE3NTJDQjhDNkQxQkQ1RDhFMUNCMjBBREJBPl0vUHJldiAxNTQ4OD4+CnN0YXJ0eHJlZg0KMAolJUVPRgogICAgCjUgMCBvYmoKPDwvVHlwZSAvQ2F0YWxvZyAvUGFnZXMgMiAwIFIKL1BhZ2VMYXlvdXQvU2luZ2xlUGFnZQovUGFnZU1vZGUvVXNlTm9uZQovUGFnZSAxCi9NZXRhZGF0YSAzIDAgUgo+PgplbmRvYmoKNiAwIG9iago8PC9UeXBlL1BhZ2UvTWVkaWFCb3ggWzAgMCA1OTUgODQyXQovUm90YXRlIDAvUGFyZW50IDIgMCBSCi9SZXNvdXJjZXM8PC9Qcm9jU2V0Wy9QREYgL1RleHRdCi9FeHRHU3RhdGUgMTIgMCBSCi9Gb250IDEzIDAgUgo+PgovQ29udGVudHMgNyAwIFIKPj4KZW5kb2JqCjcgMCBvYmoKPDwvTGVuZ3RoIDggMCBSL0ZpbHRlciAvRmxhdGVEZWNvZGU+PgpzdHJlYW0KeJy1U02P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NzEyMDgwMy0wMycwMCcpCi9UaXRsZShcMzc2XDM3N1wwMDBEXDAwMG9cMDAwY1wwMDB1XDAwMG1cMDAwZVwwMDBuXDAwMHRcMDAwb1wwMDAxKQovQXV0aG9yKFwzNzZcMzc3XDAwMHVcMDAwc1wwMDB1XDAwMGFcMDAwclwwMDBpXDAwMG8pCi9TdWJqZWN0KCkKL0tleXdvcmRzKCkKL0NyZWF0b3IoXDM3NlwzNzdcMDAwUFwwMDBEXDAwMEZcMDAwQ1wwMDByXDAwMGVcMDAwYVwwMDB0XDAwMG9cMDAwclwwMDAgXDAwMDJcMDAwLlwwMDAzXDAwMC5cMDAwMFwwMDAuXDAwMDFcMDAwMFwwMDAzKT4+ZW5kb2JqCjIgMCBvYmoKPDwgL1R5cGUgL1BhZ2VzIC9LaWRzIFsKNiAwIFIKXSAvQ291bnQgMQo+PgplbmRvYmoKMyAwIG9iago8PC9UeXBlL01ldGFkYXRhCi9TdWJ0eXBlL1hNTC9MZW5ndGggMTU2Nz4+c3RyZWFtCjw/eHBhY2tldCBiZWdpbj0n77u/JyBpZD0nVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkJz8+Cjw/YWRvYmUteGFwLWZpbHRlcnMgZXNjPSJDUkxGIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0nYWRvYmU6bnM6bWV0YS8nIHg6eG1wdGs9J1hNUCB0b29sa2l0IDIuOS4xLTEzLCBmcmFtZXdvcmsgMS42Jz4KPHJkZjpSREYgeG1sbnM6cmRmPSdodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjJyB4bWxuczppWD0naHR0cDovL25zLmFkb2JlLmNvbS9pWC8xLjAvJz4KPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9J3V1aWQ6MDhkNTdiMjAtZmY1YS0xMWU2LTAwMDAtY2FiOWFjNGQyZWI0JyB4bWxuczpwZGY9J2h0dHA6Ly9ucy5hZG9iZS5jb20vcGRmLzEuMy8nPjxwZGY6UHJvZHVjZXI+UERGQ3JlYXRvciAyLjMuMC4xMDM8L3BkZjpQcm9kdWNlcj4KPHBkZjpLZXl3b3Jkcz48L3BkZjpLZXl3b3Jkcz4KPC9yZGY6RGVzY3JpcHRpb24+CjxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSd1dWlkOjA4ZDU3YjIwLWZmNWEtMTFlNi0wMDAwLWNhYjlhYzRkMmViNCcgeG1sbnM6eG1wPSdodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvJz48eG1wOk1vZGlmeURhdGU+MjAxNy0wMi0yN1QxMjowODowMy0wMzowMDwveG1wOk1vZGlmeURhdGU+Cjx4bXA6Q3JlYXRlRGF0ZT4yMDE3LTAyLTI3VDEyOjA4OjAzLTAzOjAwPC94bXA6Q3JlYXRlRGF0ZT4KPHhtcDpDcmVhdG9yVG9vbD5QREZDcmVhdG9yIDIuMy4wLjEwMzwveG1wOkNyZWF0b3JUb29sPjwvcmRmOkRlc2NyaXB0aW9uPgo8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0ndXVpZDowOGQ1N2IyMC1mZjVhLTExZTYtMDAwMC1jYWI5YWM0ZDJlYjQnIHhtbG5zOnhhcE1NPSdodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vJyB4YXBNTTpEb2N1bWVudElEPSd1dWlkOjA4ZDU3YjIwLWZmNWEtMTFlNi0wMDAwLWNhYjlhYzRkMmViNCcvPgo8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0ndXVpZDowOGQ1N2IyMC1mZjVhLTExZTYtMDAwMC1jYWI5YWM0ZDJlYjQnIHhtbG5zOmRjPSdodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLycgZGM6Zm9ybWF0PSdhcHBsaWNhdGlvbi9wZGYnPjxkYzp0aXRsZT48cmRmOkFsdD48cmRmOmxpIHhtbDpsYW5nPSd4LWRlZmF1bHQnPkRvY3VtZW50bzE8L3JkZjpsaT48L3JkZjpBbHQ+PC9kYzp0aXRsZT48ZGM6Y3JlYXRvcj48cmRmOlNlcT48cmRmOmxpPnVzdWFyaW88L3JkZjpsaT48L3JkZjpTZXE+PC9kYzpjcmVhdG9yPjxkYzpkZXNjcmlwdGlvbj48cmRmOkFsdD48cmRmOmxpIHhtbDpsYW5nPSd4LWRlZmF1bHQnPjwvcmRmOmxpPjwvcmRmOkFsdD48L2RjOmRlc2NyaXB0aW9uPjwvcmRmOkRlc2NyaXB0aW9uPgo8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9J3cnPz4KZW5kc3RyZWFtCmVuZG9iagp4cmVmCjAgNAowMDAwMDAwMDAwIDY1NTM1IGYgCjAwMDAwMTMzMTMgMDAwMDAgbiAKMDAwMDAxMzc4NiAwMDAwMCBuIAowMDAwMDEzODQ1IDAwMDAwIG4gCnRyYWlsZXIKPDwvU2l6ZSA0Pj4Kc3RhcnR4cmVmCjE0NgolJUVPRgo=
						[tipo_adjunto] => 3
					)
					Array
					(
						[id_adjunto] => 1
						[id_mensaje] => 1
						[nombre_adjunto] => Consentimiento_A.pdf
						[mime_adjunto] => application/pdf
						[contenido] => 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RW5jb2RpbmcgL0lkZW50aXR5LUgKL0Rlc2NlbmRhbnRGb250cyBbNyAwIFJdCi9Ub1VuaWNvZGUgOCAwIFIKPj4KZW5kb2JqCjcgMCBvYmoKPDwvVHlwZSAvRm9udAovU3VidHlwZSAvQ0lERm9udFR5cGUyCi9CYXNlRm9udCAvTVBERkFBK0RlamFWdVNhbnNDb25kZW5zZWQKL0NJRFN5c3RlbUluZm8gOSAwIFIKL0ZvbnREZXNjcmlwdG9yIDEwIDAgUgovRFcgNTQwCi9XIFsgMzIgWyAyODYgMzYwIDQxNCA3NTQgNTcyIDg1NSA3MDIgMjQ3IDM1MSAzNTEgNDUwIDc1NCAyODYgMzI1IDI4NiAzMDMgXQogNDggNTcgNTcyIDU4IDU5IDMwMyA2MCA2MiA3NTQgNjMgWyA0NzggOTAwIDYxNSA2MTcgNjI4IDY5MyA1NjggNTE4IDY5NyA2NzcgMjY1IDI2NSA1OTAgNTAxIDc3NiA2NzMgNzA4IDU0MiA3MDggNjI1IDU3MSA1NDkgNjU5IDYxNSA4OTAgNjE2IDU0OSA2MTYgMzUxIDMwMyAzNTEgNzU0IDQ1MCA0NTAgNTUxIDU3MSA0OTUgNTcxIDU1NCAzMTYgNTcxIDU3MCAyNTAgMjUwIDUyMSAyNTAgODc2IDU3MCA1NTAgNTcxIDU3MSAzNzAgNDY5IDM1MyA1NzAgNTMyIDczNiA1MzIgNTMyIDQ3MiA1NzIgMzAzIDU3MiA3NTQgXQogMTYwIFsgMjg2IDM2MCBdCiAxNjIgMTY1IDU3MiAxNjYgWyAzMDMgNDUwIDQ1MCA5MDAgNDI0IDU1MCA3NTQgMzI1IDkwMCA0NTAgNDUwIDc1NCAzNjAgMzYwIDQ1MCA1NzIgNTcyIDI4NiA0NTAgMzYwIDQyNCA1NTAgXQogMTg4IDE5MCA4NzIgMTkxIDE5MSA0NzggMTkyIDE5NyA2MTUgMTk4IFsgODc2IDYyOCBdCiAyMDAgMjAzIDU2OCAyMDQgMjA3IDI2NSAyMDggWyA2OTcgNjczIF0KIDIxMCAyMTQgNzA4IDIxNSBbIDc1NCA3MDggXQogMjE3IDIyMCA2NTkgMjIxIFsgNTQ5IDU0NCA1NjcgXQogMjI0IDIyOSA1NTEgMjMwIFsgODgzIDQ5NSBdCiAyMzIgMjM1IDU1NCAyMzYgMjM5IDI1MCAyNDAgWyA1NTAgNTcwIDU1MCA1NTAgNTUwIDU1MCA1NTAgXQogMjQ3IFsgNzU0IDU1MCBdCiAyNDkgMjUyIDU3MCAyNTMgWyA1MzIgNTcxIDUzMiBdCiA2NDI1NyA2NDI1NyA1NjcgXQovQ0lEVG9HSURNYXAgMTEgMCBSCj4+CmVuZG9iago4IDAgb2JqCjw8L0xlbmd0aCAzNDY+PgpzdHJlYW0KL0NJREluaXQgL1Byb2NTZXQgZmluZHJlc291cmNlIGJlZ2luCjEyIGRpY3QgYmVnaW4KYmVnaW5jbWFwCi9DSURTeXN0ZW1JbmZvCjw8L1JlZ2lzdHJ5IChBZG9iZSkKL09yZGVyaW5nIChVQ1MpCi9TdXBwbGVtZW50IDAKPj4gZGVmCi9DTWFwTmFtZSAvQWRvYmUtSWRlbnRpdHktVUNTIGRlZgovQ01hcFR5cGUgMiBkZWYKMSBiZWdpbmNvZGVzcGFjZXJhbmdlCjwwMDAwPiA8RkZGRj4KZW5kY29kZXNwYWNlcmFuZ2UKMSBiZWdpbmJmcmFuZ2UKPDAwMDA+IDxGRkZGPiA8MDAwMD4KZW5kYmZyYW5nZQplbmRjbWFwCkNNYXBOYW1lIGN1cnJlbnRkaWN0IC9DTWFwIGRlZmluZXJlc291cmNlIHBvcAplbmQKZW5kCgplbmRzdHJlYW0KZW5kb2JqCjkgMCBvYmoKPDwvUmVnaXN0cnkgKEFkb2JlKQovT3JkZXJpbmcgKFVDUykKL1N1cHBsZW1lbnQgMAo+PgplbmRvYmoKMTAgMCBvYmoKPDwvVHlwZSAvRm9udERlc2NyaXB0b3IKL0ZvbnROYW1lIC9NUERGQUErRGVqYVZ1U2Fuc0NvbmRlbnNlZAogL0NhcEhlaWdodCA3MjkKIC9YSGVpZ2h0IDU0NwogL0ZvbnRCQm94IFstOTE4IC00MTUgMTUxMyAxMTY3XQogL0ZsYWdzIDQKIC9Bc2NlbnQgOTI4CiAvRGVzY2VudCAtMjM2CiAvTGVhZGluZyAwCiAvSXRhbGljQW5nbGUgMAogL1N0ZW1WIDg3CiAvTWlzc2luZ1dpZHRoIDU0MAogL1N0eWxlIDw8IC9QYW5vc2UgPCAwIDAgMiBiIDYgNiAzIDggNCAyIDIgND4gPj4KL0ZvbnRGaWxl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IDc1NCA2MjYgOTAxIDc4NSAyNzUgNDExIDQxMSA0NzAgNzU0IDM0MiAzNzQgMzQyIDMyOSBdCiA0OCA1NyA2MjYgNTggNTkgMzYwIDYwIDYyIDc1NCA2MyBbIDUyMiA5MDAgNjk2IDY4NiA2NjAgNzQ3IDYxNSA2MTUgNzM4IDc1MyAzMzQgMzM0IDY5NyA1NzMgODk2IDc1MyA3NjUgNjU5IDc2NSA2OTMgNjQ4IDYxNCA3MzAgNjk2IDk5MyA2OTQgNjUxIDY1MiA0MTEgMzI5IDQxMSA3NTQgNDUwIDQ1MCA2MDcgNjQ0IDUzMyA2NDQgNjEwIDM5MSA2NDQgNjQxIDMwOCAzMDggNTk4IDMwOCA5MzggNjQxIDYxOCA2NDQgNjQ0IDQ0NCA1MzYgNDMwIDY0MSA1ODYgODMxIDU4MCA1ODYgNTIzIDY0MSAzMjkgNjQxIDc1NCBdCiAxNjAgWyAzMTMgNDEwIDYyNiA2MjYgNTcyIDYyNiAzMjkgNDUwIDQ1MCA5MDAgNTA3IDU4MSA3NTQgMzc0IDkwMCA0NTAgNDUwIDc1NCAzOTQgMzk0IDQ1MCA2NjIgNTcyIDM0MiA0NTAgMzk0IDUwNyA1ODEgXQogMTg4IDE5MCA5MzIgMTkxIDE5MSA1MjIgMTkyIDE5NyA2OTYgMTk4IFsgOTc2IDY2MCBdCiAyMDAgMjAzIDYxNSAyMDQgMjA3IDMzNCAyMDggWyA3NTQgNzUzIF0KIDIxMCAyMTQgNzY1IDIxNSBbIDc1NCA3NjUgXQogMjE3IDIyMCA3MzAgMjIxIFsgNjUxIDY2NCA2NDcgXQogMjI0IDIyOSA2MDcgMjMwIFsgOTQzIDUzMyBdCiAyMzIgMjM1IDYxMCAyMzYgMjM5IDMwOCAyNDAgWyA2MTggNjQxIDYxOCA2MTggXQogXQovQ0lEVG9HSURNYXAgMTggMCBSCj4+CmVuZG9iagoxNSAwIG9iago8PC9MZW5ndGggMzQ2Pj4Kc3RyZWFtCi9DSURJbml0IC9Qcm9jU2V0IGZpbmRyZXNvdXJjZSBiZWdpbgoxMiBkaWN0IGJlZ2luCmJlZ2luY21hcAovQ0lEU3lzdGVtSW5mbwo8PC9SZWdpc3RyeSAoQWRvYmUpCi9PcmRlcmluZyAoVUNTKQovU3VwcGxlbWVudCAwCj4+IGRl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b2JqCjIxIDAgb2JqCjw8Ci9UeXBlIC9DYXRhbG9nCi9QYWdlcyAxIDAgUgovT3BlbkFjdGlvbiBbMyAwIFIgL1hZWiBudWxsIG51bGwgMV0KL1BhZ2VMYXlvdXQgL09uZUNvbHVtbgo+PgplbmRvYmoKeHJlZgowIDIyCjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMTU3MyAwMDAwMCBuIAowMDAwMDMwMzI5IDAwMDAwIG4gCjAwMDAwMDAwMTUgMDAwMDAgbiAKMDAwMDAwMDIyMyAwMDAwMCBuIAowMDAwMDAxNjYyIDAwMDAwIG4gCjAwMDAwMDE3MjMgMDAwMDAgbiAKMDAwMDAwMTg3MyAwMDAwMCBuIAowMDAwMDAyODQ5IDAwMDAwIG4gCjAwMDAwMDMyNDQgMDAwMDAgbiAKMDAwMDAwMzMxMiAwMDAwMCBuIAowMDAwMDAzNjE5IDAwMDAwIG4gCjAwMDAwMDQwMjMgMDAwMDAgbiAKMDAwMDAxNTg3OSAwMDAwMCBuIAowMDAwMDE2MDM3IDAwMDAwIG4gCjAwMDAwMTY5MzcgMDAwMDAgbiAKMDAwMDAxNzMzMyAwMDAwMCBuIAowMDAwMDE3NDAyIDAwMDAwIG4gCjAwMDAwMTc3MjAgMDAwMDAgbiAKMDAwMDAxODEwNCAwMDAwMCBuIAowMDAwMDMwNDU2IDAwMDAwIG4gCjAwMDAwMzA2MDQgMDAwMDAgbiAKdHJhaWxlcgo8PAovU2l6ZSAyMgovUm9vdCAyMSAwIFIKL0luZm8gMjAgMCBSCi9JRCBbPGNkYmQ0ZjZkY2UwYTNjNmE2MDg1M2YxNDNiYmU2ODM3PiA8Y2RiZDRmNmRjZTBhM2M2YTYwODUzZjE0M2JiZTY4Mzc+XQo+PgpzdGFydHhyZWYKMzA3MTQKJSVFT0YA
						[tipo_adjunto] => 1
					)
				 */
				foreach ($_SESSION['adjuntos'] as $adjunto){
					$nombre_adjunto		= $adjunto['nombre_adjunto'];
					$arr_extension		= array('jpeg', 'jpg', 'png', 'gif', 'tiff', 'bmp', 'pdf', 'txt', 'csv', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'eml');
					$nombre_adjunto		= strtolower(trim($nombre_adjunto));
					$nombre_adjunto		= trim($nombre_adjunto, ".");
					$extension			= substr(strrchr($nombre_adjunto, "."), 1);
					if ($adjunto['tipo_adjunto'] == 1){
						$gl_nombre_archivo	= 'Consentimiento_' . $parametros['rut'] . '.' . $extension;
						$directorio			= "archivos/$id_paciente/";
						$gl_path			= $directorio . $gl_nombre_archivo;
						$ins_adjunto		= array('id_paciente'		=> $id_paciente,
												'id_adjunto_tipo'	=> 1,
												'gl_nombre'			=> $gl_nombre_archivo,
												'gl_path'			=> $gl_path,
												'gl_glosa'			=> 'Consentimiento Firmado',
												'sha256'			=> Seguridad::generar_sha256($gl_path),
												'fc_crea'			=> date('Y-m-d h:m:s'),
												'id_usuario_crea'	=> $_SESSION['id'],
											);
						$id_adjunto			= $this->_DAOAdjunto->insert($ins_adjunto);
					} else if ($adjunto['tipo_adjunto'] == 3){
						$gl_nombre_archivo	= 'Archivo_Fonasa_' . $parametros['rut'] . '.' . $extension;
						$directorio			= "archivos/$id_paciente/";
						$gl_path			= $directorio . $gl_nombre_archivo;
						$ins_adjunto		= array('id_paciente'		=> $id_paciente,
												'id_adjunto_tipo'	=> 3,
												'gl_nombre'			=> $gl_nombre_archivo,
												'gl_path'			=> $gl_path,
												'gl_glosa'			=> 'Archivo Fonasa',
												'sha256'			=> Seguridad::generar_sha256($gl_path),
												'fc_crea'			=> date('Y-m-d h:m:s'),
												'id_usuario_crea'	=> $_SESSION['id'],
											);
						$id_adjunto			= $this->_DAOAdjunto->insert($ins_adjunto);
					}
					if ($id_adjunto) {
						if (!is_dir($directorio)) {
							mkdir($directorio, 0775, true);

							$out = fopen($directorio . '/index.html', "w");
							fwrite($out, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
							fclose($out);
						}
						$out = fopen($gl_path, "w");
						fwrite($out, base64_decode($adjunto['contenido']));
						fclose($out);
					}
				}				
			}

			$id_registro	= $this->_DAOPacienteRegistro->insertarRegistro($parametros, $id_paciente); /* id_registro real */
			$id_empa1		= $this->_DAOEmpa->insert(array('id_paciente' => $id_paciente, 'nr_orden' => 1));
			$id_empa2		= $this->_DAOEmpa->insert(array('id_paciente' => $id_paciente, 'nr_orden' => 2));

			for($i=1; $i<=10; $i++ ){
				$id_audit1	= $this->_DAOEmpaAudit->insert(array('id_empa' => $id_empa1,'id_pregunta' => $i,'id_usuario_crea' => $_SESSION['id']));
				$id_audit2	= $this->_DAOEmpaAudit->insert(array('id_empa' => $id_empa2,'id_pregunta' => $i,'id_usuario_crea' => $_SESSION['id']));
			}
			
			$this->_Evento->guardar(1,0,$id_paciente,"Paciente creado el : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
			
			if ($id_empa1) {
				$resp = $this->_Evento->guardar(13,$id_empa1,$id_paciente,"Empa ".$id_empa1." creado el : " . Fechas::fechaHoyVista(),1,0,$_SESSION['id']);
			}
			if ($id_empa2) {
				$resp = $this->_Evento->guardar(13,$id_empa2,$id_paciente,"Empa ".$id_empa2." creado el : " . Fechas::fechaHoyVista(),1,0,$_SESSION['id']);
			}
			if ($id_audit1) {
				$resp = $this->_Evento->guardar(14,$id_empa1,$id_paciente,"AUDIT del EMPA".$id_empa1." creado el : " . Fechas::fechaHoyVista(),1,0,$_SESSION['id']);
			}
			if ($id_audit2) {
				$resp = $this->_Evento->guardar(14,$id_empa2,$id_paciente,"AUDIT del EMPA".$id_empa2." creado el : " . Fechas::fechaHoyVista(),1,0,$_SESSION['id']);
			}
			if ($parametros['chkAcepta']) {
				$resp = $this->_Evento->guardar(4,0,$id_paciente,"AUDIT del EMPA".$id_empa2." creado el : " . "Acepta el programa con fecha : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
			}
			/*
			if ($parametros['chkReconoce']) {
				$datos_evento['eventos_tipo']	= 5;
				$datos_evento['gl_descripcion']	= "Reconoce violencia con fecha : " . Fechas::fechaHoy();
				$resp							= $this->_DAOEvento->insEvento($datos_evento);
			}
			*/

			$parametros['bo_estado']		= 1;
			$parametros['id_usuario_crea']	= $_SESSION['id'];
			$parametros['fc_crea']			= "now()";
			$parametros['id_paciente']		= $id_paciente;			
			$ins_direccion = array(	'id_paciente'			=> $parametros['id_paciente'],
									'id_comuna'				=> $parametros['comuna'],
									'id_region'				=> $parametros['region'],
									'gl_direccion'			=> $parametros['direccion'],
									'gl_latitud'			=> $parametros['gl_latitud'],
									'gl_longitud'			=> $parametros['gl_longitud'],
									'bo_estado'				=> 1,
									'fc_ingreso'			=> $parametros['fechaingreso'],
									'gl_motivo_consulta'	=> $parametros['motivoconsulta'], 
									'fc_crea'				=> date('Y-m-d h:m:s'),
									'id_usuario_crea'		=> $_SESSION['id'],
								);
			$desabilitadas					= $this->_DAOPacienteDireccion->disabDirecciones($id_paciente);
			if($desabilitadas){
				$id_direccion				= $this->_DAOPacienteDireccion->insertarDireccion($ins_direccion);
			}

		} else {
			$error = true;
		}

		$salida = array("error" => $error, "correcto" => $correcto);
		$json = Zend_Json::encode($salida);

		echo $json;
	}

	/**
	 * Descripción: Guardar Motivo
	 * @author: 
	 */
	public function GuardarMotivo() {
		header('Content-type: application/json');
		$session			= New Zend_Session_Namespace("usuario_carpeta");
		$parametros			= $this->_request->getParams();
		$correcto			= false;
		$error				= false;
		$rut				= $parametros['rut'];
		$id_paciente		= $parametros['id_paciente'];
		$gl_grupo_tipo_ant	= $parametros['gl_grupo_tipo'];
		$confirma_fono		= $parametros['chk_confirma_fono'];
		$confirma_direccion	= $parametros['chk_confirma_dir'];
		$id_centro_salud	= $parametros['centrosalud'];
		$gl_fono			= $parametros['fono'];
		$count				= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);

		if($parametros['edad'] > 15 AND  $_SESSION['id_tipo_grupo'] == 2 AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
			$gl_grupo_tipo = 'Tratamiento';
			$id_tipo_grupo = 2;
			if ($gl_grupo_tipo_ant != $gl_grupo_tipo){
				$resp = $this->_Evento->guardar(10,0,$id_paciente,"Paciente RUT : ". $rut ." en Grupo Tratamiento desde : " . Fechas::fechaHoyVista(),1,1,$session->id);				
			}
		}else{
			$gl_grupo_tipo = 'Control';
			$id_tipo_grupo = 1;
		}

		$parametros['gl_grupo_tipo']	= $gl_grupo_tipo;
		$parametros['id_tipo_grupo']	= $id_tipo_grupo;
		
		if ($id_paciente &&  $confirma_fono == "1" &&   $confirma_direccion == "1") {
				
				 $ins_paciente_registro = array('id_paciente'			=> $parametros['id_paciente'],
												'id_institucion'		=> $parametros['centrosalud'],
												'gl_hora_ingreso'       => $parametros['horaingreso'],
												'fc_ingreso'			=> $parametros['fechaingreso'],
												'gl_motivo_consulta'	=> $parametros['motivoconsulta'], 
												'fc_crea'				=> date('Y-m-d h:m:s'),
												'id_usuario_crea'		=> $_SESSION['id'],
                                );
				$resultado2							= $this->_DAOPacienteRegistro->insertar("pre_paciente_registro", $ins_paciente_registro);			
				$ins_direccion = array(	'id_paciente'			=> $parametros['id_paciente'],
										'id_comuna'				=> $parametros['comuna'],
										'id_region'				=> $parametros['region'],
										'gl_direccion'			=> $parametros['direccion'],
										'gl_latitud'			=> $parametros['gl_latitud'],
										'gl_longitud'			=> $parametros['gl_longitud'],
										'bo_estado'				=> 1,
										'fc_ingreso'			=> $parametros['fechaingreso'],
										'gl_motivo_consulta'	=> $parametros['motivoconsulta'], 
										'fc_crea'				=> date('Y-m-d h:m:s'),
										'id_usuario_crea'		=> $_SESSION['id'],
								);
				$res_disab_direcciones			= $this->_DAOPacienteDireccion->disabDirecciones($id_paciente);
				$id_direccion					= $this->_DAOPacienteDireccion->insertarDireccion($ins_direccion);
				$res_update_centro_salud		= $this->_DAOPaciente->update(array('id_centro_salud' => $id_centro_salud), $id_paciente, 'id_paciente');
				$res_update_centro_fono			= $this->_DAOPaciente->update(array('gl_fono' => $gl_fono), $id_paciente, 'id_paciente');
				$session							= New Zend_Session_Namespace("usuario_carpeta");
				$res_evento = $this->_Evento->guardar(16,0,$id_paciente,"Motivo consulta agregada el : " . Fechas::fechaHoyVista(),1,0,$_SESSION['id']);
				if($res_update_centro_salud && $res_evento && $res_disab_direcciones && $res_update_centro_fono){
					$correcto = TRUE;
				} else {
					$error = TRUE;
				}
			if ($parametros['chkAcepta']) {
				$resp = $this->_DAOPaciente->update(array('bo_acepta_programa' => 1), $id_paciente, 'id_paciente');
				if ($resp){
					$correcto = $this->_Evento->guardar(4,0,$id_paciente,"Acepta el programa con fecha : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
				}
			}

			/*
			if ($parametros['chkReconoce']) {
				$resp = $this->_DAOPaciente->update(array('bo_reconoce' => 1), $id_paciente, 'id_paciente');
				$datos_evento['eventos_tipo'] = 5;
				$datos_evento['gl_descripcion'] = "Reconoce violencia con fecha : " . Fechas::fechaHoy();
				$resp = $this->_DAOEvento->insEvento($datos_evento);
			}
			*/
		}else{
			$error	= true;
		}

		$salida	= array("error"		=> $error,
						"correcto"	=> $correcto);
		$json	= Zend_Json::encode($salida);

		echo $json;
	}

	/**
	 * Descripción: Guardar Reconoce
	 * @author: 
	 */
	public function GuardarReconoce() {
		header('Content-type: application/json');
		$parametros = $this->_request->getParams();
		$correcto = false;
		$error = false;

		$id_registro = $parametros['id_registro'];

		$resp = $this->_DAOPaciente->update(array('bo_reconoce' => 1), $id_paciente, 'id_paciente');
		if ($resp) {
			$correcto = true;

			$session = New Zend_Session_Namespace("usuario_carpeta");
			$resp = $this->_Evento->guardar(5,0,$id_paciente,"Reconoce violencia con fecha : " . Fechas::fechaHoyVista(),1,1,$session->id);

		} else {
			$error = true;
		}

		$salida = array("error" => $error,
			"correcto" => $correcto);
		$this->smarty->assign("hidden", "");
		$json = Zend_Json::encode($salida);

		echo $json;
	}

	/**
	 * Descripción: Ver
	 * @author: 
	 */
	public function ver() {
		$parametros = $this->request->getParametros();
		$id_registro = $parametros[0];
		$info_paciente = $this->_DAOPaciente->verInfoById($id_registro);
		if (!is_null($info_paciente)) {
			$edad = Fechas::calcularEdadInv($info_paciente->fc_nacimiento);
			$arrMotivosConsulta = $this->_DAOPacienteRegistro->getByIdPaciente($info_paciente->id_paciente);                        
		}
                $this->smarty->assign('id_paciente', $info_paciente->id_paciente);
		$this->smarty->assign('rut', $info_paciente->gl_rut);
		$this->smarty->assign('extranjero', $info_paciente->bo_extranjero);
		$this->smarty->assign('run_pass', $info_paciente->gl_run_pass);
		$this->smarty->assign('nombres', $info_paciente->gl_nombres);
		$this->smarty->assign('apellidos', $info_paciente->gl_apellidos);
		$this->smarty->assign('fecha_nacimiento', $info_paciente->fc_nacimiento);
		$this->smarty->assign('sexo', $info_paciente->gl_sexo);
		//$this->smarty->assign('direccion', $info_paciente->gl_direccion);
		$this->smarty->assign('fono', $info_paciente->gl_fono);
		$this->smarty->assign('celular', $info_paciente->gl_celular);
		$this->smarty->assign('email', $info_paciente->gl_email);
		$this->smarty->assign('latitud', $info_paciente->gl_latitud);
		$this->smarty->assign('longitud', $info_paciente->gl_longitud);
		$this->smarty->assign('reconoce', $info_paciente->bo_reconoce);
		$this->smarty->assign('acepta', $info_paciente->bo_acepta_programa);
		$this->smarty->assign('prevision', $info_paciente->gl_nombre_prevision);
		//$this->smarty->assign('comuna', $info_paciente->gl_nombre_comuna);
		//$this->smarty->assign('region', $info_paciente->gl_nombre_region);
		$this->smarty->assign('edad', $edad);
		$this->smarty->assign('nombre_registrador', $info_paciente->gl_nombre_usuario_crea);
		$this->smarty->assign('estado_caso', $info_paciente->gl_nombre_estado_caso);
		$this->smarty->assign('institucion', $info_paciente->gl_nombre_institucion);
		$this->smarty->assign('arrMotivosConsulta', $arrMotivosConsulta);
		$this->smarty->assign('ruta_consentimiento', $info_paciente->gl_path);
		
                /* Caro 08-03-2017 */
                $id_paciente = $info_paciente->id_paciente;
                //die($id_paciente);
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
                
                //Grilla Exámenes Alterados x Paciente
                $muestra_examenes = "NO";
                $arrExamenes = $this->_DAOPacienteExamen->getByIdPacienteAlterado($id_paciente);
                if (!is_null($arrExamenes)) {
                    $this->smarty->assign('arrExamenes', $arrExamenes);
                    $muestra_examenes = "SI";
                }
                $this->smarty->assign("muestra_examenes", $muestra_examenes);
                
                $this->smarty->display('Paciente/ver.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/paciente/ver.js");                
	}

	/**
	 * Descripción: Carga comunas por región
	 * @author: 
	 */
	public function cargarComunasPorRegion() {
		$region = $_POST['region'];
		$daoRegion = $this->load->model('DAORegion');
		$comunas = $daoRegion->getDetalleByIdRegion($region)->rows;

		$json = array();
		$i = 0;
		foreach ($comunas as $comuna) {
			$json[$i]['id_comuna'] = $comuna->id_comuna;
			$json[$i]['nombre_comuna'] = $comuna->gl_nombre_comuna;
			$i++;
		}

		echo json_encode($json);
	}

	/**
	 * Descripción: Carga centros de salud por comuna
	 * @author: 
	 */
	public function cargarCentroSaludporComuna() {
		$json = array();

		if (!empty($_POST['comuna'])) {
			$comuna = $_POST['comuna'];
			$comuna = $_POST['comuna'];
			$daoCentroSalud = $this->load->model('DAOCentroSalud');
			$centrosalud = $daoCentroSalud->getByIdComuna($comuna);

			$i = 0;
			foreach ($centrosalud as $cSalud) {
				$json[$i]['id_establecimiento'] = $cSalud->id_centro_salud;
				$json[$i]['gl_nombre_establecimiento'] = $cSalud->gl_nombre_establecimiento;
				$i++;
			}
		}
		echo json_encode($json);
	}

	/**
	 * Descripción: Carga data del Paciente
	 * @author: Victor Retamal
	 */
	public function cargarPaciente() {
		header('Content-type: application/json');
		$rut = $_POST['rut'];
		$pasaporte = $_POST['inputextranjero'];
		if (!is_null($rut) && ($rut !== "")) {
			$registro = $this->_DAOPaciente->getByRut($rut);
		} else if (!is_null($pasaporte) && ($pasaporte !== "")) {
			$registro = $this->_DAOPaciente->getByPasaporte($pasaporte);
		}
		$json = array();

		if ($registro) {
			$direcciones = $this->_DAOPacienteDireccion->getMultByIdPaciente($registro->id_paciente);
			$info_comuna = $this->_DAOComuna->getInfoComunaxID($direcciones->row_0->id_comuna);
			$arr_motivos = $this->_DAOPacienteRegistro->getByIdPaciente($registro->id_paciente);
			$tabla_motivos = "";
			$tabla_direcciones = "";
			$div_superior = "<div class='top-spaced'></div>
								<div class='panel panel-primary'>
									<div class='panel-heading'>Motivos de consulta</div>";
			$div_inferior = "</div>";

			if (!is_null($arr_motivos)) {
				$encabezado_tabla = "<div class='panel-body'>
										<div class='table-responsive col-lg-12' data-row='5'>
											<table id='tablaPrincipal' class='table table-hover table-striped table-bordered  table-middle dataTable no-footer'>
												<thead>
													<tr role='row'>
														<th align='center' width='16%'>Fecha Ingreso</th>
														<th align='center' width='9%'>Hora Ingreso</th>
														<th align='center' width=''>Motivo</th>
														<th align='center' width='20%'>Institución</th>
														<th align='center' width='15%'>Funcionario</th>

													</tr>
												</thead>
												<tbody>
											";
				$tabla_motivos = $encabezado_tabla;
				$break_count = 0;
				foreach (array_reverse((array) $arr_motivos) as $item) {
					if ($break_count < 5) {
						$cuerpo_tabla = "<tr>
													<td>" . $item->fc_ingreso . "</td>
													<td>" . $item->gl_hora_ingreso . "</td>
													<td>" . $item->gl_motivo_consulta . "</td>
													<td>" . $item->gl_nombre_establecimiento . "</td>
													<td>" . $item->gl_nombres . " " . $item->gl_apellidos . "</td>
												</tr>
												";
						$tabla_motivos = $tabla_motivos . $cuerpo_tabla;
						$break_count += 1;
					} else {
						break;
					}
				}
				$pie_tabla = "	</tbody>
											</table>
										</div>
									</div>";
				$tabla_motivos = $tabla_motivos . $pie_tabla;
			}
			if (!is_null($direcciones)) {
				$encabezado_tabla_direcciones = "<div class='table-responsive col-sm-12 center' data-row='5'>
							<table id='tablaDireccion' class='table table-hover table-striped table-bordered dataTable no-footer'>
								<thead>
									<tr role='row'>
										<th class='text-center' width='10%'>Direcciones</th>
									</tr>
								</thead>
								<tbody>";
				$tabla_direcciones = $encabezado_tabla_direcciones;
				$break_count = 0;
				foreach (array_reverse((array) $direcciones) as $item) {
					if ($break_count < 5) {
						$cuerpo_tabla_direcciones = "<tr>
														<td class='text-center' nowrap> $item->gl_direccion </td>
													</tr>
												";
						$tabla_direcciones = $tabla_direcciones . $cuerpo_tabla_direcciones;
						$break_count += 1;
					} else {
						break;
					}
				}
				$pie_tabla_direcciones = "	 </tbody>
								 </table>
								</div>";
				$tabla_direcciones = $tabla_direcciones . $pie_tabla_direcciones;
			}
			$json['correcto']				= TRUE;
			$json['div_superior']			= $div_superior;
			$json['div_inferior']			= $div_inferior;
			$json['tabla_motivos']			= $tabla_motivos;
			$json['count_motivos']			= count((array) $arr_motivos);
			$json['tabla_direcciones']		= $tabla_direcciones;
			$json['count_direcciones']		= count((array) $direcciones);
			$json['fc_ultimo_motivos']		= $arr_motivos->row_0->fc_ingreso;
			$json['gl_grupo_tipo']			= $registro->gl_grupo_tipo;
			$json['id_paciente']			= $registro->id_paciente;
			$json['gl_nombres']				= $registro->gl_nombres;
			$json['gl_apellidos']			= $registro->gl_apellidos;
			$json['fc_nacimiento']			= $registro->fc_nacimiento;
			$json['id_prevision']			= $registro->id_prevision;
			$json['gl_direccion']			= $direcciones->row_0->gl_direccion;
			$json['id_region']				= $direcciones->row_0->id_region;
			$json['gl_nombre_comuna']		= $info_comuna->gl_nombre_comuna;
			$json['id_comuna']				= $direcciones->row_0->id_comuna;
			$json['gl_centro_salud']		= $registro->gl_centro_salud;
			$json['id_centro_salud']		= $registro->id_centro_salud;
			$json['bo_reconoce']			= $registro->bo_reconoce;
			$json['bo_acepta_programa']		= $registro->bo_acepta_programa;
			$json['gl_latitud']				= $direcciones->row_0->gl_latitud;
			$json['gl_longitud']			= $direcciones->row_0->gl_longitud;
			
			$json['gl_fono']				= $registro->gl_fono;
			$json['gl_celular']				= $registro->gl_celular;
			$json['gl_email']				= $registro->gl_email;
		} else {
			$json['correcto']				= FALSE;
		}

		echo json_encode($json);
	}

	/**
	 * Descripción: Carga adjunto
	 * @author: 
	 */
	public function cargarAdjunto() {
		$session				= New Zend_Session_Namespace("adj");
		$session->tipo_adjunto	= 1;
		$this->smarty->display('Paciente/cargar_adjunto.tpl');
	}
	
	public function cargarAdjuntoFonasa() {
		$session				= New Zend_Session_Namespace("adj");
		$session->tipo_adjunto	= 3;
		$this->smarty->display('Paciente/cargar_adjunto.tpl');
	}
	/**
	 * Descripción: Guarda adjunto
	 * @author: 
	 */
	public function guardarAdjunto() {
		$adjunto = $_FILES['adjunto'];
		$parametros = $this->request->getParametros();
		$tipo_adjunto = $parametros[0];
		if ($adjunto['tmp_name'] != "") {
			$file = fopen($adjunto['tmp_name'], 'r+b');
			$contenido = fread($file, filesize($adjunto['tmp_name']));
			fclose($file);

			if (!empty($contenido)) {
				$arr_adjunto = array(
					'id_adjunto' => 1,
					'id_mensaje' => 1,
					'nombre_adjunto' => $adjunto['name'],
					'mime_adjunto' => $adjunto['type'],
					'contenido' => base64_encode($contenido),
					'tipo_adjunto' => $tipo_adjunto
				);
				$_SESSION['adjuntos'][] = $arr_adjunto;
				$success = 1;
				$mensaje = "El archivo <strong>" . $adjunto['name'] . "</strong > ha sido Adjuntado";
			} else {
				$success = 0;
				$mensaje = "No se ha podido leer el archivo adjunto. Intente nuevamente";
			}
		} else {
			$success = 0;
			$mensaje = "Error al cargar el Adjunto. Intente nuevamente";
		}

		if ($success == 1) {
			echo "<script>parent.cargarListadoAdjuntos('listado-adjuntos'); parent.xModal.close();</script>";
			//echo "<script> parent.$('#btnUploadUno').prop('disabled', true);</script>";
		} else {
			$this->view->assign('success', $success);
			$this->view->assign('mensaje', $mensaje);

			$this->view->assign('template', $this->view->fetch('Paciente/cargar_adjunto.tpl'));
			$this->view->display('template_iframe.tpl');
		}
	}

	/**
	 * Descripción: Carga listado de adjuntos
	 * @author: 
	 */
	public function cargarListadoAdjuntos() {
		$adjuntos = array();
		$template = '';

		if (isset($_SESSION['adjuntos'])) {
			$template.= '<div class="col-xs-6 col-xs-offset-3" id="div_adjuntos" name="div_adjuntos">
                                                    <table id="adjuntos" class="table table-hover table-condensed table-bordered" align=center>
                                                            <thead>
                                                            <tr>
                                                                    <th>Nombre Archivo</th>
                                                                    <th width="50px" nowrap>Descargar</th>
                                                                    <th width="50px" nowrap>Eliminar</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>';
			$adjuntos = $_SESSION['adjuntos'];
			$i = 0;
			foreach ($adjuntos as $adjunto) {
				$template.= '		<tr>
                                                                            <td>										
                                                                                    <strong>' . $adjunto['nombre_adjunto'] . '</strong>
                                                                            </td>
                                                                            <td align="center"><a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="window.open(\'' . BASE_URI . '/Paciente/verAdjunto/' . $i . '\',\'_blank\');">
                                                                                            <i class="fa fa-download"></i>
                                                                                    </a>
                                                                            </td>										
                                                                            <td align="center">										
                                                                                    <button class="btn btn-xs btn-danger" type="button" onclick="borrarAdjunto(' . $i . ')">
                                                                                            <i class="fa fa-trash-o"></i>
                                                                                    </button>
                                                                            </td>
                                                                    </tr>';
				$i++;
			}

			$template.= '		</tbody>
                                                    </table>
                                            </div>';
		}

		echo $template;
	}

	/**
	 * Descripción: Borrar adjunto
	 * @author: 
	 */
	public function borrarAdjunto() {
		$parametros = $this->request->getParametros();
		$id_adjunto = $parametros[0];

		$template = '';
		unset($_SESSION['adjuntos'][$id_adjunto]);

		if (count($_SESSION['adjuntos']) > 0) {
			$template.= '<div class="col-xs-6 col-xs-offset-3" id="div_adjuntos" name="div_adjuntos">
                                                    <table id="adjuntos" class="table table-hover table-condensed table-bordered" align=center>
                                                            <thead>
                                                            <tr>
                                                                    <th>Nombre Archivo</th>
                                                                    <th width="50px" nowrap>Descargar</th>
                                                                    <th width="50px" nowrap>Eliminar</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>';
			$adjuntos = $_SESSION['adjuntos'];
			$i = 0;
			unset($_SESSION['adjuntos']);

			foreach ($adjuntos as $adjunto) {
				$_SESSION['adjuntos'][] = $adjunto;
				$template.= '		<tr>
                                                                            <td>										
                                                                                    <strong>' . $adjunto['nombre_adjunto'] . '</strong>
                                                                            </td>
                                                                            <td align="center"><a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="window.open(\'' . BASE_URI . '/Paciente/verAdjunto/' . $i . '\',\'_blank\');">
                                                                                            <i class="fa fa-download"></i>
                                                                                    </a>
                                                                            </td>										
                                                                            <td align="center">										
                                                                                    <button class="btn btn-xs btn-danger" type="button" onclick="borrarAdjunto(' . $i . ')">
                                                                                            <i class="fa fa-trash-o"></i>
                                                                                    </button>
                                                                            </td>
                                                                    </tr>';
				$i++;
			}

			$template.= '		</tbody>
                                                    </table>
                                            </div>';
		} else {
			echo "<script> $('#btnUploadUno').prop('disabled', false);</script>";
		}

		echo $template;
	}

	/**
	 * Descripción: Ver adjunto
	 * @author: 
	 */
	public function verAdjunto() {
		$parametros = $this->request->getParametros();
		$id_adjunto = $parametros[0];

		if (isset($_SESSION['adjuntos'][$id_adjunto])) {
			$adjunto = $_SESSION['adjuntos'][$id_adjunto];
			header("Content-Type: " . $adjunto['mime_adjunto']);
			header("Content-Disposition: inline; filename=" . $adjunto['nombre_adjunto']);
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			ob_end_clean();
			echo base64_decode($adjunto['contenido']);
			exit();
		} else {
			echo "El adjunto no existe";
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

            if ($_POST['comentario'] == "") {
                $glosa = "Adjunta Documento por Bitácora";
            } else {
                $glosa = $_POST['comentario'];
            }
            //$glosa           = "Adjunta Documento por Bitácora";

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
                $grilla = $this->smarty->fetch('avanzados/grillaAdjuntos.tpl');

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

	/**
	 * Descripción : Generar PDF de Consentimiento con los Datos del Paciente
	 * @author: Victor Retamal <victor.retamal@cosof.cl>
	 * @param array Con los datos necesarios para generar el Consentimiento.
	 * @return PDF
	 */
	public function generarConsentimiento() {
		$this->load->lib('Mpdf', false);
		$param			= $this->_request->getParams();
		$correcto		= false;
		$base64			= '';
		$nombre			= $param['nombres'] . ' ' . $param['apellidos'];
		$rut			= $param['rut'];
		$gl_pasaporte	= $param['inputextranjero'];
		$codigo_fonasa	= $param['gl_codigo_fonasa'];

		if(!empty($rut)){
			$filename	= 'Consentimiento_' . $rut . '.pdf';
		}else{
			$filename	= 'Consentimiento_' . $codigo_fonasa . '.pdf';
		}

		$this->smarty->assign('nombre_paciente', $nombre);
		$this->smarty->assign('rut_paciente', $rut);
		$this->smarty->assign('run_pasaporte', $gl_pasaporte);
		$this->smarty->assign('codigo_fonasa', $codigo_fonasa);
		$this->smarty->assign('fecha_actual', date('d-m-Y'));
		$this->smarty->assign('nombre_usuario', $_SESSION['nombre']);
		$this->smarty->assign('rut_usuario', $_SESSION['rut']);

		$html			= $this->smarty->fetch('pdf/consentimiento.tpl');

		$base64			= base64_encode(crear_mpdf($html, $filename, false, 'S'));
		if ($base64) {
			$correcto	= true;
		}
		$salida			= array(
								"correcto"	=> $correcto,
								"filename"	=> $filename,
								"base64"	=> $base64
							);
		$json			= Zend_Json::encode($salida);

		echo $json;
	}

}