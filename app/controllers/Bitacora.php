<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Controller para Bitácora de Paciente
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 09/03/2017
 * 
 * @name             Bitacora.php
 * 
 * @version          1.0
 *
 * @author           Carolina Zamora <carolina.zamora@cosof.cl>
 * 
 ******************************************************************************
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * ----------------------------------------------------------------------------
 * 
 * ----------------------------------------------------------------------------
 * ****************************************************************************
 */
class Bitacora extends Controller {

	protected $_DAOPaciente;
	protected $_DAOPacienteRegistro;
	protected $_DAOPacienteAgresor;
	protected $_DAOEvento;
	protected $_DAOEventoTipo;
	protected $_DAOAdjunto;
	protected $_DAOAdjuntoTipo;
	protected $_DAOEmpa;
	protected $_DAOPacienteExamen;
	protected $_DAOPacienteDireccion;
	protected $_Evento;
	protected $_DAOPacienteAgendaEspecialista;
	protected $_DAOTipoVinculo;
	protected $_DAOComuna;
	protected $_DAOPacienteAgresorViolencia;
	protected $_DAOTipoViolencia;
	protected $_DAOTipoRiesgo;
    protected $_DAOTipoGenero;

	function __construct() {
		parent::__construct();
		$this->load->lib('Fechas', false);
		$this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);
        
		$this->_Evento = new Evento();
		$this->_DAOPaciente						= $this->load->model("DAOPaciente");
		$this->_DAOPacienteRegistro				= $this->load->model("DAOPacienteRegistro");
		$this->_DAOPacienteAgresor				= $this->load->model("DAOPacienteAgresor");
		$this->_DAOEvento						= $this->load->model("DAOEvento");
		$this->_DAOEventoTipo					= $this->load->model("DAOEventoTipo");
		$this->_DAOAdjunto						= $this->load->model("DAOAdjunto");
		$this->_DAOAdjuntoTipo					= $this->load->model("DAOAdjuntoTipo");
		$this->_DAOEmpa							= $this->load->model("DAOEmpa");
		$this->_DAOPacienteExamen				= $this->load->model("DAOPacienteExamen");
		$this->_DAOPacienteDireccion			= $this->load->model("DAOPacienteDireccion");
		$this->_DAOPacienteAgendaEspecialista	= $this->load->model("DAOPacienteAgendaEspecialista");
		$this->_DAOComuna						= $this->load->model("DAOComuna");
		$this->_DAOPacienteAgresorViolencia		= $this->load->model("DAOPacienteAgresorViolencia");
		$this->_DAOTipoViolencia				= $this->load->model("DAOTipoViolencia");
		$this->_DAOTipoRiesgo                   = $this->load->model("DAOTipoRiesgo");
        $this->_DAOTipoGenero                   = $this->load->model("DAOTipoGenero");
	}

	public function index() {
		Acceso::redireccionUnlogged($this->smarty);
	}

	/**
	 * Descripción: Bitacora de Paciente
	 * @author Carolina Zamora Hormazábal
	 */
	public function ver() {
        Acceso::redireccionUnlogged($this->smarty);
		$parametros = $this->request->getParametros();
		$id_paciente = $parametros[0];
        
		$detPaciente = $this->_DAOPaciente->getByIdPaciente($id_paciente);
		if (!is_null($detPaciente)) {
			//Datos de Paciente
			if ($detPaciente->bo_extranjero == 0) {
				$run = $detPaciente->gl_rut;
			} else {
				$run = $detPaciente->gl_run_pass;
			}

			$nombres = $detPaciente->gl_nombres . ' ' . $detPaciente->gl_apellidos;
            if (!is_null($detPaciente->fc_nacimiento)) {
                $edad = Fechas::calcularEdadInv($detPaciente->fc_nacimiento);
            } else {
                $edad = "";
            }

            $cod_gen = $detPaciente->gl_sexo;
            /* OJO que busca detalle en "Tipo de Género" 
             * por cambio de datos según normativa */
            $tipoGenero = $this->_DAOTipoGenero->getByCodigo($cod_gen);
            $sexo = $tipoGenero->gl_tipo_genero;
            
//			if ($detPaciente->gl_sexo == "F") {
//				$sexo = "FEMENINO";
//			} else {
//				$sexo = $detPaciente->gl_sexo;
//			}
            
            //Grilla Direcciones
			$muestra_direcciones = "NO";
			$arrDirecciones = $this->_DAOPacienteDireccion->getDireccionesById($id_paciente);
			if (!is_null($arrDirecciones)) {
				if ($arrDirecciones->numRows > 1) {
					$this->smarty->assign('arrDirecciones', $arrDirecciones->rows);
					$muestra_direcciones = "SI";
				}
			}
            
			//Grilla Exámenes Alterados x Paciente
			$muestra_examenes = "NO";
			$arrExamenesAlt = $this->_DAOPacienteExamen->getExamenAleradoByIdPaciente($id_paciente);
			if (!is_null($arrExamenesAlt)) {
				$this->smarty->assign('arrExamenesAlt', $arrExamenesAlt);
				$muestra_examenes = "SI";
			}
			
			//Datos del Agresor
			if ($detPaciente->bo_reconoce == 1) {
				$arrAgresor = $this->_DAOPacienteAgresor->getByIdPaciente($id_paciente);
				if ($arrAgresor->bo_extranjero == 0) {
					$this->smarty->assign('run_agresor', $arrAgresor->gl_rut_agresor);
				} else {
					$this->smarty->assign('run_agresor', $arrAgresor->gl_run_pass);
				}
				$nombres_agresor = $arrAgresor->gl_nombres_agresor . ' ' . $arrAgresor->gl_apellidos_agresor;
				$this->smarty->assign("nombres_agresor", $nombres_agresor);
				if ($arrAgresor->fc_nacimiento_agresor) {
					$edad = Fechas::calcularEdadInv($arrAgresor->fc_nacimiento_agresor);
					$this->smarty->assign("fc_nacimiento_agresor", $arrAgresor->fc_nacimiento_agresor);
					$this->smarty->assign("edad_agresor", $edad);
				}

				$this->smarty->assign('vinculo_agresor', $arrAgresor->gl_tipo_vinculo);
				$this->smarty->assign('estado_civil_agresor', $arrAgresor->gl_estado_civil);

				if ($arrAgresor->id_comuna_vive) {
					$arrComuna1 = $this->_DAOComuna->getById($arrAgresor->id_comuna_vive);
					$this->smarty->assign('comuna_reside_agresor', $arrComuna1->gl_nombre_comuna);
				}
				if ($arrAgresor->id_comuna_trabaja) {
					$arrComuna2 = $this->_DAOComuna->getById($arrAgresor->id_comuna_trabaja);
					$this->smarty->assign('comuna_trabaja_agresor', $arrComuna2->gl_nombre_comuna);
				}
				
				$ingresos_agresor = $arrAgresor->nr_minimo . " - " . $arrAgresor->nr_maximo;
				$this->smarty->assign('ingresos_agresor', $ingresos_agresor);
				$this->smarty->assign('genero_agresor', $arrAgresor->gl_tipo_genero);
				$this->smarty->assign('sexo_agresor', $arrAgresor->gl_tipo_sexo);
				$this->smarty->assign('orientacion_agresor', $arrAgresor->gl_orientacion_sexual);
				$this->smarty->assign('hijos_agresor', $arrAgresor->nr_hijos);
				$this->smarty->assign('hijos_comun_agresor', $arrAgresor->nr_hijos_en_comun);
				$this->smarty->assign('nr_denuncias_agresor', $arrAgresor->nr_denuncias_por_violencia);

				//Caracterizacion de violencia
				$arrTipoViolencia = $this->_DAOTipoViolencia->getLista();
				$this->smarty->assign("arrTipoViolencia", $arrTipoViolencia);

				$arrPuntos = $this->_DAOPacienteAgresorViolencia->getByIdPaciente($id_paciente);
				if (!is_null($arrPuntos)) {
					foreach ($arrPuntos as $item) {
						if (is_null($item->nr_valor)) {
							$item->nr_valor = 0;
						}
					}
				}
				$this->smarty->assign("arrPuntos", $arrPuntos);
				if($arrAgresor->id_tipo_riesgo){
					$arrTipoRiesgo = $this->_DAOTipoRiesgo->getById($arrAgresor->id_tipo_riesgo);
					$this->smarty->assign("tipo_riesgo", $arrTipoRiesgo->gl_tipo_riesgo);
					$this->smarty->assign("color", $arrTipoRiesgo->color_riesgo);
				}
			}
            
            //Grilla Motivos de Consulta (Paciente-Registro)
			$arrConsultas = $this->_DAOPacienteRegistro->getByIdPaciente($id_paciente);
			
			//Grilla Empa
			$arrEmpa = $this->_DAOEmpa->getListaEmpa($id_paciente);			

			//Grilla Exámenes x Paciente
			$arrExamenes = $this->_DAOPacienteExamen->getByIdPaciente($id_paciente);			

			//Tipos de Eventos
			$arrTipoEvento = $this->_DAOEventoTipo->getLista();			

			//Grilla Eventos
			$arrEventos = $this->_DAOEvento->getEventosPaciente($id_paciente);

			//Tipos de Adjuntos
			$arrTipoDocumento = $this->_DAOAdjuntoTipo->getLista();			

			//Grilla Adjuntos
			$arrAdjuntos = $this->_DAOAdjunto->getDetalleByIdPaciente($id_paciente);

			//Plan Tratamiento
			$arr_plan = $this->_DAOPacienteAgendaEspecialista->getByIdPaciente($id_paciente);

			//Dirección Vigente de Paciente
			$detDireccion = $this->_DAOPacienteDireccion->getDireccionVigenteById($id_paciente);
			if (!is_null($detDireccion)) {
				$direccion = $detDireccion->gl_direccion;
				$comuna = $detDireccion->gl_nombre_comuna;
				$provincia = $detDireccion->gl_nombre_provincia;
				$region = $detDireccion->gl_nombre_region;
			}
            
            $this->smarty->assign("id_paciente", $id_paciente);
            $this->smarty->assign("run", $run);
            $this->smarty->assign("nombres", $nombres);
            $this->smarty->assign("fc_nacimiento", $detPaciente->fc_nacimiento);
			$this->smarty->assign("edad", $edad);
			$this->smarty->assign("gl_sexo", $sexo);
			$this->smarty->assign("gl_nombre_estado_caso", $detPaciente->gl_nombre_estado_caso);
			$this->smarty->assign("gl_nombre_prevision", $detPaciente->gl_nombre_prevision);
			$this->smarty->assign("gl_grupo_tipo", $detPaciente->gl_grupo_tipo);
			$this->smarty->assign("gl_fono", $detPaciente->gl_fono);
			$this->smarty->assign("bo_fono_seguro", $detPaciente->bo_fono_seguro);
			$this->smarty->assign("gl_celular", $detPaciente->gl_celular);
			$this->smarty->assign("gl_email", $detPaciente->gl_email);
			$this->smarty->assign("fc_crea", $detPaciente->fc_crea);
            $this->smarty->assign("muestra_direcciones", $muestra_direcciones);
			$this->smarty->assign("gl_nombre_comuna", $comuna);
			$this->smarty->assign("gl_nombre_provincia", $provincia);
			$this->smarty->assign("gl_nombre_region", $region);
			$this->smarty->assign("gl_direccion", $direccion);
            
            $this->smarty->assign("muestra_examenes", $muestra_examenes);
			$this->smarty->assign("bo_reconoce", $detPaciente->bo_reconoce);
			$this->smarty->assign("bo_acepta_programa", $detPaciente->bo_acepta_programa);
            
            $this->smarty->assign('arrConsultas', $arrConsultas);
            $this->smarty->assign('arrEmpa', $arrEmpa);
            $this->smarty->assign('arrExamenes', $arrExamenes);
            $this->smarty->assign('arrTipoEvento', $arrTipoEvento);
            $this->smarty->assign('arrEventos', $arrEventos);
            $this->smarty->assign('arrTipoDocumento', $arrTipoDocumento);
            $this->smarty->assign('arrAdjuntos', $arrAdjuntos);
            $this->smarty->assign("arr_plan", $arr_plan);
            
			$this->smarty->display('bitacora/ver.tpl');
			$this->load->javascript(STATIC_FILES . 'js/templates/bitacora/ver.js');
		} else {
			throw new Exception("El historial que está buscando no existe");
		}
	}

	/**
	 * Descripción : permite guardar nuevo archivo adjunto desde bitácora
	 * @author Carolina Zamora H.
	 * @return JSON
	 */
	public function guardarNuevoAdjunto() {
		header('Content-type: application/json');

		$correcto   = false;
		$error      = true;

		$adjunto        = $_FILES['archivo'];
		$id_paciente    = $_POST['idpac'];
		$tipo_doc       = $_POST['tipodoc'];
		$tipo_txt       = $_POST['tipotxt'];
		$glosa          = $_POST['comentario'];
		$glosa          = trim($glosa);
		if ($glosa == "") {
			$glosa = "Adjunta Documento por Bitácora";
		}

		$nombre_adjunto = $adjunto['name'];

		$arr_extension  = array('jpeg', 'jpg', 'png', 'gif', 'tiff', 'bmp',
                                'pdf', 'txt', 'csv', 'doc', 'docx', 'ppt',
                                'pptx', 'xls', 'xlsx', 'eml');

		$nombre_adjunto = strtolower(trim($nombre_adjunto));
		$nombre_adjunto = trim($nombre_adjunto, ".");

		$extension      = substr(strrchr($nombre_adjunto, "."), 1);

		//obtiene fecha y hora
		$date           = new DateTime();
		$result         = $date->format('Y-m-d_H-i-s');
		$krr            = explode('-', $result);
		$result         = implode("", $krr);

		$gl_nombre_archivo = $result . '_' . $tipo_txt . '.' . $extension;

		$directorio     = "archivos/$id_paciente/";
		$gl_path        = $directorio . $gl_nombre_archivo;

		$ins_adjunto    = array('id_paciente'       => $id_paciente,
                                'id_adjunto_tipo'   => $tipo_doc,
                                'gl_nombre'         => $gl_nombre_archivo,
                                'gl_path'           => $gl_path,
                                'gl_glosa'          => $glosa,
                                'sha256'            => Seguridad::generar_sha256($gl_path),
                                'fc_crea'           => date('Y-m-d h:m:s'),
                                'id_usuario_crea'   => $_SESSION['id'],
                               );

		$id_adjunto     = $this->_DAOAdjunto->insert($ins_adjunto);
		$grilla         = "";

		if ($id_adjunto) {
			if (!is_dir($directorio)) {
				mkdir($directorio, 0775, true);

				$out = fopen($directorio . '/index.html', "w");
				fwrite($out, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
				fclose($out);
			}

			$file       = fopen($adjunto['tmp_name'], 'r+b');
			$contenido  = fread($file, filesize($adjunto['tmp_name']));
			fclose($file);

			$out        = fopen($gl_path, "w");
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

		$salida = array("error"     => $error,
                        "correcto"  => $correcto,
                        "grilla"    => $grilla);

		$this->smarty->assign("hidden", "");
		$json = Zend_Json::encode($salida);

		echo $json;
	}
}