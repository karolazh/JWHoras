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

	function __construct() {
		parent::__construct();
		$this->load->lib('Fechas', false);
		$this->load->lib('Boton', false);
		$this->load->lib('Seguridad', false);

		$this->_DAORegion				= $this->load->model("DAORegion");
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
		$correcto		= false;
		$error			= false;
		$gl_grupo_tipo	= 'Control';
		$id_tipo_grupo	= 1;
		$datos_evento	= array();
		$count			= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);

		if ($parametros['edad'] > 15 AND $_SESSION['id_tipo_grupo'] == 2 AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
			$gl_grupo_tipo = 'Tratamiento';
			$id_tipo_grupo = 2;
		}
		$parametros['gl_grupo_tipo'] = $gl_grupo_tipo;
		$parametros['id_tipo_grupo'] = $id_tipo_grupo;

		$id_paciente	= $this->_DAOPaciente->insertarPaciente($parametros);
		if ($id_paciente) {
			$correcto	= true;
			$session	= New Zend_Session_Namespace("usuario_carpeta");

			if (!empty($_SESSION['adjuntos'])) {
				$nombre_adjunto		= $_SESSION['adjuntos'][0]['nombre_adjunto'];
				$arr_extension		= array('jpeg', 'jpg', 'png', 'gif', 'tiff', 'bmp', 'pdf', 'txt', 'csv', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'eml');
				$nombre_adjunto		= strtolower(trim($nombre_adjunto));
				$nombre_adjunto		= trim($nombre_adjunto, ".");
				$extension			= substr(strrchr($nombre_adjunto, "."), 1);
				$gl_nombre_archivo	= 'Consentimiento_' . $parametros['rut'] . '.' . $extension;
				$directorio			= "archivos/$id_paciente/";
				$gl_path			= $directorio . $gl_nombre_archivo;

				$ins_adjunto		= array('id_paciente'		=> $id_paciente,
											'id_tipo_adjunto'	=> 1,
											'gl_nombre'			=> $gl_nombre_archivo,
											'gl_path'			=> $gl_path,
											'gl_glosa'			=> 'Consentimiento Firmado',
											'sha256'			=> Seguridad::generar_sha256($gl_path),
											'fc_crea'			=> date('Y-m-d h:m:s'),
											'id_usuario_crea'	=> $_SESSION['id'],
										);
				$id_adjunto			= $this->_DAOAdjunto->insert($ins_adjunto);

				if ($id_adjunto) {
					if (!is_dir($directorio)) {
						mkdir($directorio, 0775, true);

						$out = fopen($directorio . '/index.html', "w");
						fwrite($out, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
						fclose($out);
					}
					$out = fopen($gl_path, "w");
					fwrite($out, base64_decode($_SESSION['adjuntos'][0]['contenido']));
					fclose($out);
				}
			}

			$id_registro	= $this->_DAOPacienteRegistro->insertarRegistro($parametros, $id_paciente); /* id_registro real */
			$id_empa1		= $this->_DAOEmpa->insert(array('id_paciente' => $id_paciente, 'nr_orden' => 1));
			$id_empa2		= $this->_DAOEmpa->insert(array('id_paciente' => $id_paciente, 'nr_orden' => 2));

			for($i=1; $i<=10; $i++ ){
				$id_audit1	= $this->_DAOEmpaAudit->insert(array('id_empa' => $id_empa1,'id_pregunta' => $i,'id_usuario_crea' => $_SESSION['id']));
				$id_audit2	= $this->_DAOEmpaAudit->insert(array('id_empa' => $id_empa2,'id_pregunta' => $i,'id_usuario_crea' => $_SESSION['id']));
			}

			$datos_evento['eventos_tipo']			= 1;
			$datos_evento['id_empa']				= 0;
			$datos_evento['id_paciente']			= $id_paciente;
			$datos_evento['gl_descripcion']			= "Paciente creado el : " . Fechas::fechaHoy();
			$datos_evento['bo_estado']				= 1;
			$datos_evento['id_usuario_crea']		= $_SESSION['id'];
			$resp									= $this->_DAOEvento->insEvento($datos_evento);
			
			if ($id_empa1) {
				$datos_evento['eventos_tipo']		= 13;
				$datos_evento['id_empa']			= $id_empa1;
				$datos_evento['gl_descripcion']		= "Empa ".$id_empa1." creado el : " . Fechas::fechaHoy();
				$datos_evento['bo_estado']			= 1;
				$datos_evento['id_usuario_crea']	= $_SESSION['id'];
				$resp								= $this->_DAOEvento->insEvento($datos_evento);
			}
			if ($id_empa2) {
				$datos_evento['eventos_tipo']		= 13;
				$datos_evento['id_empa']			= $id_empa2;
				$datos_evento['gl_descripcion']		= "Empa ".$id_empa2." creado el : " . Fechas::fechaHoy();
				$datos_evento['bo_estado']			= 1;
				$datos_evento['id_usuario_crea']	= $_SESSION['id'];
				$resp								= $this->_DAOEvento->insEvento($datos_evento);
			}
			if ($id_audit1) {
				$datos_evento['eventos_tipo']		= 14;
				$datos_evento['id_empa']			= $id_empa1;
				$datos_evento['id_paciente']		= $id_paciente;
				$datos_evento['gl_descripcion']		= "AUDIT del EMPA".$id_empa1." creado el : " . Fechas::fechaHoy();
				$datos_evento['bo_estado']			= 1;
				$datos_evento['id_usuario_crea']	= $_SESSION['id'];
				$resp								= $this->_DAOEvento->insEvento($datos_evento);
			}
			if ($id_audit2) {
				$datos_evento['eventos_tipo']		= 14;
				$datos_evento['id_empa']			= $id_empa2;
				$datos_evento['id_paciente']		= $id_paciente;
				$datos_evento['gl_descripcion']		= "AUDIT del EMPA".$id_empa2." creado el : " . Fechas::fechaHoy();
				$datos_evento['bo_estado']			= 1;
				$datos_evento['id_usuario_crea']	= $_SESSION['id'];
				$resp								= $this->_DAOEvento->insEvento($datos_evento);
			}
			if ($parametros['chkAcepta']) {
				$datos_evento['eventos_tipo']	= 4;
				$datos_evento['gl_descripcion']	= "Acepta el programa con fecha : " . Fechas::fechaHoy();
				$resp							= $this->_DAOEvento->insEvento($datos_evento);
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
			$id_direccion					= $this->_DAOPacienteDireccion->insertarDireccion($parametros);

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
		$datos_evento		= array();
		$rut				= $parametros['rut'];
		$id_paciente		= $parametros['id_paciente'];
		$gl_grupo_tipo_ant	= $parametros['gl_grupo_tipo'];
		$count				= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);

		if($parametros['edad'] > 15 AND $_SESSION['gl_grupo_tipo'] == 'Tratamiento' AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
			$gl_grupo_tipo = 'Tratamiento';
			if ($gl_grupo_tipo_ant != $gl_grupo_tipo){
				$datos_evento['id_paciente']		= $id_paciente;
				$datos_evento['bo_estado']			= 1;
				$datos_evento['id_usuario_crea']	= $session->id;
				$datos_evento['eventos_tipo']		= 10;
				$datos_evento['gl_descripcion']		= "Paciente RUT : ". $rut ." en Grupo Tratamiento desde : " . Fechas::fechaHoy();
				$resp								= $this->_DAOEvento->insEvento($datos_evento);
			}
		}else{
			$gl_grupo_tipo = 'Control';
		}

		$parametros['gl_grupo_tipo']	= $gl_grupo_tipo;
		
		if ($id_paciente) {
				$correcto							= true;
				$resultado2							= $this->_DAOPacienteRegistro->insertar($parametros, $id_paciente);
				$session							= New Zend_Session_Namespace("usuario_carpeta");
				$datos_evento['id_paciente']		= $id_paciente;
				$datos_evento['bo_estado']			= 1;
				$datos_evento['id_usuario_crea']	= $session->id;
				$datos_evento['eventos_tipo']		= 16;
				$datos_evento['gl_descripcion']		= "Consulta agregada el : " . Fechas::fechaHoy();
				$resp								= $this->_DAOEvento->insEvento($datos_evento);

			if ($parametros['chkAcepta']) {
				$resp = $this->_DAOPaciente->update(array('bo_acepta_programa' => 1), $id_paciente, 'id_paciente');
				$datos_evento['eventos_tipo'] = 4;
				$datos_evento['gl_descripcion'] = "Acepta el programa con fecha : " . Fechas::fechaHoy();
				$resp = $this->_DAOEvento->insEvento($datos_evento);
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
		$datos_evento = array();

		$id_registro = $parametros['id_registro'];

		$resp = $this->_DAOPaciente->update(array('bo_reconoce' => 1), $id_registro, 'id_registro');
		if ($resp) {
			$correcto = true;

			$session = New Zend_Session_Namespace("usuario_carpeta");
			$datos_evento['id_registro'] = $id_registro;
			$datos_evento['bo_estado'] = 1;
			$datos_evento['id_usuario_crea'] = $session->id;
			$datos_evento['eventos_tipo'] = 5;
			$datos_evento['gl_descripcion'] = "Reconoce violencia con fecha : " . Fechas::fechaHoy();
			$resp = $this->_DAOEvento->insEvento($datos_evento);
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
			$arr_motivos = $this->_DAOPacienteRegistro->getByIdPaciente($registro->id_paciente);
			$tabla_motivos = "";
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

			$json['correcto']				= TRUE;
			$json['div_superior']			= $div_superior;
			$json['div_inferior']			= $div_inferior;
			$json['tabla_motivos']			= $tabla_motivos;
			$json['count_motivos']			= count((array) $arr_motivos);
			$json['fc_ultimo_motivos']		= $arr_motivos->row_0->fc_ingreso;
			$json['gl_grupo_tipo']			= $registro->gl_grupo_tipo;
			$json['id_paciente']			= $registro->id_paciente;
			$json['gl_nombres']				= $registro->gl_nombres;
			$json['gl_apellidos']			= $registro->gl_apellidos;
			$json['fc_nacimiento']			= $registro->fc_nacimiento;
			$json['id_prevision']			= $registro->id_prevision;
			$json['gl_direccion']			= $registro->gl_direccion;
			$json['id_region']				= $registro->id_region;
			$json['gl_nombre_comuna']		= $registro->gl_nombre_comuna;
			$json['id_comuna']				= $registro->id_comuna;
			$json['gl_centro_salud']		= $registro->gl_centro_salud;
			$json['id_centro_salud']		= $registro->id_centro_salud;
			$json['bo_reconoce']			= $registro->bo_reconoce;
			$json['bo_acepta_programa']		= $registro->bo_acepta_programa;
			$json['gl_latitud']				= $registro->gl_latitud;
			$json['gl_longitud']			= $registro->gl_longitud;
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
		$this->smarty->display('Paciente/cargar_adjunto.tpl');
	}

	/**
	 * Descripción: Guarda adjunto
	 * @author: 
	 */
	public function guardarAdjunto() {
		$adjunto = $_FILES['adjunto'];

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
					'contenido' => base64_encode($contenido)
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
			echo "<script> parent.$('#btnUploadUno').prop('disabled', true);</script>";
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
                                                                            <td align="center"><a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="window.open(\'' . BASE_URI . '/Registro/verAdjunto/' . $i . '\',\'_blank\');">
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
                                                                            <td align="center"><a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="window.open(\'' . BASE_URI . '/Registro/verAdjunto/' . $i . '\',\'_blank\');">
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