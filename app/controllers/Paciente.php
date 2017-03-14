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
	protected $_DAOCentroSalud;


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
		$this->_DAOCentroSalud			= $this->load->model("DAOCentroSalud");
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
	 * Descripción: Nuevo Registro
	 * @author: 
	 */
	public function nuevo() {
		Acceso::redireccionUnlogged($this->smarty);
		$region_usuario = "";
		unset($_SESSION['adjuntos']);
		$es_admin = FALSE;
		if ($_SESSION['perfil'] =="1" || $_SESSION['perfil'] == "5"){
			$arrRegiones = $this->_DAORegion->getLista();
			$this->smarty->assign("arrRegiones", $arrRegiones);
			$es_admin = TRUE;
			
		} else	{
			$region_usuario = $this->_DAORegion->getById($_SESSION['id_region']);
			$this->smarty->assign("region_usuario",$region_usuario);
			$arrComunas = $this->_DAOComuna->getComunasByIdRegion($_SESSION['id_region']);
			$this->smarty->assign("arrComunas", $arrComunas);
		}
		$this->smarty->assign("region_usuario",$region_usuario);
		$this->smarty->assign("es_admin", $es_admin);
		$arrPrevision = $this->_DAOPrevision->getLista();
		$this->smarty->assign("arrPrevision", $arrPrevision);

		//$arrCasoEgreso = $this->_DAOTipoEgreso->getLista();
		//$this->smarty->assign("arrCasoEgreso", $arrCasoEgreso);

		$this->smarty->assign("botonAyudaPaciente", Boton::botonAyuda('Ingrese Datos del Paciente.', '', 'pull-right'));

		//llamado al template
		$this->_display('Paciente/nuevo.tpl');
		$this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/bootstrap-datepicker.js');
        $this->load->javascript(STATIC_FILES . 'template/plugins/datepicker/locales/bootstrap-datepicker.es.js');
		$this->load->javascript('$(".datepicker").datepicker({ todayBtn: true,language: "es",   todayHighlight: true,autoclose: true});');
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
		$correcto			= false;
		$error				= false;
		$mensaje_error		= '';
		$id_paciente		= false;
		$gl_grupo_tipo		= 'Control';
		$id_tipo_grupo		= 1;
		$count				= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);
		if ($parametros['edad'] > 15 AND $_SESSION['id_tipo_grupo'] == 2 AND $parametros['chkAcepta'] == 1 AND $parametros['prevision'] == 1 and $count < 50) {
			$gl_grupo_tipo = 'Tratamiento';
			$id_tipo_grupo = 2;
		}
		
		$parametros['gl_grupo_tipo'] = $gl_grupo_tipo;
		$parametros['id_tipo_grupo'] = $id_tipo_grupo;
		if ($parametros['prevision'] == "1"){
			if ($parametros['gl_codigo_fonasa'] != ""){
				if (!empty($_SESSION['adjuntos'])) {
					foreach ($_SESSION['adjuntos'] as $adjunto){
							if (($adjunt->tipo_adjunto == 3)){
								$viene_adjunto_fonasa = TRUE;
							}
					}
					if (!$viene_adjunto_fonasa){
						$error			= true;
						$mensaje_error	= "Si la paciente es extranjera afiliada a FONASA, debe adjuntar un certificado FONASA.";
					}
				} else {
						$error = true;
						$mensaje_error = "Si la paciente es extranjera afiliada a FONASA, debe adjuntar un certificado FONASA.";
				}
			} else {
				$error = true;
				$mensaje_error = "Si la paciente es extranjera afiliada a FONASA, debe indicar su código.";
			}
		}
		
		if($mensaje_error != ''){
			$id_paciente =	$this->_DAOPaciente->insertarPaciente($parametros);
		}
		if ($id_paciente) {
			$correcto	= true;
			$session	= New Zend_Session_Namespace("usuario_carpeta");

			if (!empty($_SESSION['adjuntos'])) {
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
			$mensaje_error = 'Error al Guardar los datos. Favor comuníquese con Mesa de Ayuda.';
		}
		$salida = array("error" => $error, "correcto" => $correcto, "mensaje_error" => $mensaje_error);
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
		$paciente_valida	= false;
		$rut				= $parametros['rut'];
		$id_paciente		= $parametros['id_paciente'];
		$gl_grupo_tipo_ant	= $parametros['gl_grupo_tipo'];
		$confirma_fono		= $parametros['chk_confirma_fono'];
		$confirma_direccion	= $parametros['chk_confirma_dir'];
		$id_centro_salud	= $parametros['centrosalud'];
		$gl_fono			= $parametros['fono'];
		$bo_fono_seguro		= $parametros['fono_seguro'];
		$count				= $this->_DAOPaciente->countPacientesxRegion($_SESSION['id_region']);
		$mensaje_error		= "";

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
				if ($parametros['cambio_direccion'] == "1"){
					if($this->_DAOPacienteDireccion->disabDirecciones($id_paciente)){
						if($this->_DAOPacienteDireccion->insertarDireccion($ins_direccion)){
						$correcto = true;
						}
					} else {
						$correcto = false;
						$mensaje_error = "No se pudieron desabilitar las direcciones anteriores";
					}
				}
				$res_update_centro_salud		= $this->_DAOPaciente->update(array('id_centro_salud' => $id_centro_salud), $id_paciente, 'id_paciente');
				$res_update_centro_fono			= $this->_DAOPaciente->update(array('gl_fono' => $gl_fono), $id_paciente, 'id_paciente');
				$res_update_fono_seguro			= $this->_DAOPaciente->update(array('bo_fono_seguro' => $bo_fono_seguro), $id_paciente, 'id_paciente');

				$session							= New Zend_Session_Namespace("usuario_carpeta");
				$res_evento = $this->_Evento->guardar(16,0,$id_paciente,"Motivo consulta agregada el : " . Fechas::fechaHoyVista(),1,0,$_SESSION['id']);
				if($res_update_centro_salud && $res_evento && $res_update_centro_fono && $res_update_fono_seguro){
					$correcto = TRUE;
				} else {
					$error = TRUE;
				}
			if ($parametros['chkAcepta']) {
				$resp = $this->_DAOPaciente->update(array('bo_acepta_programa' => 1), $id_paciente, 'id_paciente');
				if ($resp){
					$correcto = $this->_Evento->guardar(4,0,$id_paciente,"Acepta el programa con fecha : " . Fechas::fechaHoyVista(),1,1,$_SESSION['id']);
				} else {
					$error = true;
					$mensaje_error = "Error al guardar algo en la BASE DE DATOS";
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

		$salida	= array("error"			=> $error,
						"correcto"		=> $correcto,
						"mensaje_error" => $mensaje_error );
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
		$parametros		= $this->request->getParametros();
		$id_registro	= $parametros[0];
		$info_paciente	= $this->_DAOPaciente->verInfoById($id_registro);

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
		$this->smarty->assign('bo_fono_seguro', $info_paciente->bo_fono_seguro);
		
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
                $arrExamenes = $this->_DAOPacienteExamen->getExamenAleradoByIdPaciente($id_paciente);
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
			$daoCentroSalud = $this->load->model('DAOCentroSalud');
			$centrosalud = $daoCentroSalud->getByIdComuna($comuna);

			$i = 0;
			foreach ($centrosalud as $cSalud) {
				$json[$i]['id_centro_salud'] = $cSalud->id_centro_salud;
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
			$direcciones	= $this->_DAOPacienteDireccion->getMultByIdPaciente($registro->id_paciente);
			$info_comuna	= $this->_DAOComuna->getInfoComunaxID($direcciones->row_0->id_comuna);
			$arrComunas		= $this->_DAORegion->getDetalleByIdRegion($direcciones->row_0->id_region);
			$arrCentroSalud	= $this->_DAOCentroSalud->getByIdComuna($direcciones->row_0->id_comuna);
			$jsonComuna = '';
			$jsonCentroSalud = '';
            $i = 0;
            foreach($arrComunas as $comuna){
				if ($direcciones->row_0->id_comuna == $comuna->id_comuna){
                    $jsonComuna .= '<option value="' . $comuna->id_comuna . '"selected>' . $comuna->gl_nombre_comuna . '</option>';
				} else {
					$jsonComuna .= '<option value="' . $comuna->id_comuna . '">' . $comuna->gl_nombre_comuna . '</option>';
				}
            }
			 foreach($arrCentroSalud as $centro){
				if ($registro->id_centro_salud == $centro->id_centro_salud){
                    $jsonCentroSalud .= '<option value="' . $centro->id_centro_salud . '"selected>' . $centro->gl_nombre_establecimiento . '</option>';
				} else {
					$jsonCentroSalud .= '<option value="' . $centro->id_centro_salud . '">' . $centro->gl_nombre_establecimiento . '</option>';
				}
            }
			$arr_motivos = $this->_DAOPacienteRegistro->getByIdPaciente($registro->id_paciente);
			$tabla_motivos = "";
			$tabla_direcciones = "";
			$div_superior = "<div class='top-spaced'></div>
								<div class='panel panel-primary'>
									<div class='panel-heading'>Atenciones de Urgencia</div>";
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
										<th align='center' width='10%'>Fecha</th>
										<th align='center' width='23%'>Direcci&oacute;nes vigentes</th>
										<th align='center' width='22%'>Comuna</th>
										<th align='center' width='22%'>Regi&oacute;n</th>
										<th align='center' width='23%'>Funcionario</th>
									</tr>
								</thead>
								<tbody>";
				$tabla_direcciones = $encabezado_tabla_direcciones;
				$break_count = 0;
				foreach (array_reverse((array) $direcciones) as $dir) {
					if ($break_count < 5) {
						$cuerpo_tabla_direcciones = "<tr>
														<td>$dir->fc_crea</td>
														<td>$dir->gl_direccion</td>
														<td>$dir->gl_nombre_comuna</td>
														<td>$dir->gl_nombre_region</td>
														<td>$dir->funcionario</td>	
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
			$json['jsonComuna']				= $jsonComuna;
			$json['jsonCentroSalud']		= $jsonCentroSalud;
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
			$json['bo_fono_seguro']			= $registro->bo_fono_seguro;
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

	public function buscar() {
		Acceso::redireccionUnlogged($this->smarty);
		
		$arrRegiones = $this->_DAORegion->getLista();
		$this->smarty->assign("arrRegiones", $arrRegiones);
		
		$arrCentroSalud	= $this->_DAOCentroSalud->getLista();
		$this->smarty->assign("arrCentroSalud", $arrCentroSalud);
		
		$mostrar = 0;
		$parametros = $this->_request->getParams();
		//$parametros		= $this->request->getParametros();
		//$parametros		= $_REQUEST;
		//print_r($parametros);
		//$this->load->javascript(STATIC_FILES . "js/templates/paciente/buscar.js");
		//$this->load->javascript(STATIC_FILES . "js/regiones.js");

		
		if($parametros){
			$rut			= $parametros['rut'];
			$pasaporte		= $parametros['pasaporte'];
			$nombres		= $parametros['nombres'];
			$apellidos		= $parametros['apellidos'];
			$cod_fonasa		= $parametros['cod_fonasa'];
			$centro_salud	= $parametros['centro_salud'];
			$region			= $parametros['region'];
			$comuna			= $parametros['comuna'];
			
			if ($rut != '' && $pasaporte != ''){
				$jscode = "xModal.danger('Error: No se puede buscar por Rut y Pasaporte a la vez');";
				$this->_addJavascript($jscode);
			} else if($rut != '' || $pasaporte != '' || $nombres != '' || $apellidos != '' || $cod_fonasa != '' || $centro_salud != 0 || $region != 0 || $comuna != 0){
				$mostrar = 1;
				$arr = $this->_DAOPaciente->buscarPaciente($parametros);

				$this->smarty->assign('arrResultado', $arr);
				$this->smarty->assign('rut',$rut);
				$this->smarty->assign('pasaporte',$pasaporte);
				$this->smarty->assign('nombres',$nombres);
				$this->smarty->assign('apellidos',$apellidos);
				$this->smarty->assign('cod_fonasa',$cod_fonasa);
				$this->_addJavascript(STATIC_FILES . "js/regiones.js");

				//$this->_addJavascript(STATIC_FILES . 'template/plugins/jQuery/jQuery-2.1.4.min.js');
				//$this->load->javascript(STATIC_FILES . 'template/plugins/jQuery/jQuery-2.1.4.min.js');

				$jscode = "$(\"#centro_salud option[value='".$centro_salud."']\").attr('selected',true);";
				$this->_addJavascript($jscode);
				$jscode = "$(\"#region option[value='".$region."']\").attr('selected',true);";
				$this->_addJavascript($jscode);
				$jscode = "$('#region').trigger('change')";
				$this->_addJavascript($jscode);
				//Se necesita que campo comuna sea seleccionado
				$jscode = "setTimeout(function(){ $(\"#comuna option[value='".$comuna."']\").attr('selected',true); },200);";
				$this->_addJavascript($jscode);
			}
		}
		
		
		$this->smarty->assign('mostrar',$mostrar);
		//print_r($arr); die;
		
		
		$this->_display('Paciente/buscar.tpl');
		$this->load->javascript(STATIC_FILES . "js/regiones.js");
		//$this->smarty->display('Paciente/buscar.tpl');
		
	}
	
	public function realizarBusqueda(){
		Acceso::redireccionUnlogged($this->smarty);
		header('Content-type: application/json');
		
		$mostrar = 0;
		//$parametros = $this->_request->getParams();
		//$parametros		= $this->request->getParametros();
		$parametros		= $_REQUEST;
		print_r($parametros);
		if($parametros){
			$mostrar = 1;
		}
		
		$arr = $this->_DAOPaciente->buscarPaciente($parametros);
		//print_r($arr); die;
		
		$this->smarty->assign('arrResultado', $arr);
		$this->smarty->assign('mostrar',$mostrar);
		

		$this->smarty->assign('rut',$parametros['rut']);
		$this->smarty->assign('pasaporte',$parametros['pasaporte']);
		$this->smarty->assign('nombres',$parametros['nombres']);
		$this->smarty->assign('apellidos',$parametros['apellidos']);
		$this->smarty->assign('cod_fonasa',$parametros['cod_fonasa']);
		$this->smarty->assign('mostrar',$mostrar);
		//$this->smarty->assign('template',$this->smarty->fetch('Paciente/buscar.tpl'));
		//$this->load->javascript(STATIC_FILES.'js/templates/paciente/buscar.js');
		//$this->load->javascript(STATIC_FILES . "js/regiones.js");

		//$this->smarty->display('template.tpl');
		//$this->_display('Paciente/buscar.tpl');
		$this->smarty->display('Paciente/buscar.tpl');
	}
	
}