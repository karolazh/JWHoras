<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Controlador para el formulario EMPA
* Plataforma	: !PHP
* Creacion		: 16/02/2017
* @name			Empa.php
* @version		1.0
* @author		Carolina Zamora <carolina.zamora@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*<orlando.vazquez@cosof.cl>	05-06-2017	Modificadas referencias a DAO's
*<david.guzman@cosof.cl>	03-07-2017	Modificacion en funcion nuevo
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class Empa extends Controller{
	
    protected $_DAOEmpa;
	protected $_Evento;
	//funcion construct
	function __construct() {
		parent::__construct();
		//Acceso::set("ADMINISTRADOR");
		$this->load->lib('Boton', false);
		$this->load->lib('Fechas', false);
		$this->load->lib('Evento', false);
		$this->_Evento					= new Evento();
		$this->_DAOEmpa					= $this->load->model("DAOEmpa");
		$this->_DAOEmpaAudit			= $this->load->model("DAOEmpaAudit");
		$this->_DAOUsuario				= $this->load->model("DAOUsuario");
		$this->_DAOComuna				= $this->load->model("DAOComuna");
		$this->_DAOCentroSalud			= $this->load->model("DAOCentroSalud");
		$this->_DAOPaciente				= $this->load->model("DAOPaciente");
		$this->_DAOPacienteExamen		= $this->load->model("DAOPacienteExamen");
		$this->_DAOAuditPregunta		= $this->load->model("DAOAuditPregunta");
		$this->_DAOTipoIMC				= $this->load->model("DAOTipoIMC");
		$this->_DAOTipoAUDIT			= $this->load->model("DAOTipoAUDIT");
		$this->_DAOEvento				= $this->load->model("DAOEvento");
		$this->_DAOMes					= $this->load->model("DAOMes");
		$this->_DAOPacienteDireccion	= $this->load->model("DAOPacienteDireccion");
	}

	/*
	 * Index
	 */

	public function index() {
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

		$arrResultado = $this->_DAOPaciente->getLista();
		$this->smarty->assign("arrResultado", $arrResultado);

		$this->_display('Empa/index.tpl');
	}

	public function nuevo() {
		Acceso::redireccionUnlogged($this->smarty);
		$sesion = New Zend_Session_Namespace("usuario_carpeta");
		$this->smarty->assign("id_usuario", $sesion->id);
		$this->smarty->assign("rut", $sesion->rut);
		$this->smarty->assign("usuario", $sesion->usuario);

		$parametros = $this->request->getParametros();
		$id_paciente = $parametros[0];
		$this->smarty->assign("id_paciente", $id_paciente);
		
        $id_empa = $this->_DAOEmpa->getByIdPaciente($id_paciente);
		$this->smarty->assign("id_empa", $id_empa->id_empa);
        
		/* Obtener id de paciente a través de id de dau */
		$id_pac = 1;
		//Cargar Datos Enfermera
		$gl_comuna = $this->_DAOComuna->getById($_SESSION['id_comuna']);
		$gl_institucion = $this->_DAOCentroSalud->getById($_SESSION['id_institucion']);

		$this->smarty->assign("gl_comuna", $gl_comuna->gl_nombre_comuna);
		$this->smarty->assign("gl_institucion", $gl_institucion->gl_nombre_establecimiento);
		
		//Cargar Datos Examen Paciente
		$hipertension = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,9);
		if ($hipertension){
			$this->smarty->assign("examen_hipertension", '1');
			$this->smarty->assign("agenda_hipertension", '0');
			$this->smarty->assign("id_paciente_examen_hipertension", $hipertension->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_hipertension", '1');
			$this->smarty->assign("examen_hipertension", '0');
		}
		
		$glicemia = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,1);
		if ($glicemia){
			$this->smarty->assign("examen_glicemia", '1');
			$this->smarty->assign("agenda_glicemia", '0');
			$this->smarty->assign("id_paciente_examen_glicemia", $glicemia->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_glicemia", '1');
			$this->smarty->assign("examen_glicemia", '0');
		}
		
		$vdrl = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,2);
		if ($vdrl){
			$this->smarty->assign("examen_vdrl", '1');
			$this->smarty->assign("agenda_vdrl", '0');
			$this->smarty->assign("id_paciente_examen_vdrl", $vdrl->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_vdrl", '1');
			$this->smarty->assign("examen_vdrl", '0');
		}
		
		$rpr = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,3);
		if ($rpr){
			$this->smarty->assign("examen_rpr", '1');
			$this->smarty->assign("agenda_rpr", '0');
			$this->smarty->assign("id_paciente_examen_rpr", $rpr->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_rpr", '1');
			$this->smarty->assign("examen_rpr", '0');
		}
		
		$vih = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,4);
		if ($vih){
			$this->smarty->assign("examen_vih", '1');
			$this->smarty->assign("agenda_vih", '0');
			$this->smarty->assign("id_paciente_examen_vih", $vih->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_vih", '1');
			$this->smarty->assign("examen_vih", '0');
		}
		
		$baciloscopia = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,5);
		if ($baciloscopia){
			$this->smarty->assign("examen_baciloscopia", '1');
			$this->smarty->assign("agenda_baciloscopia", '0');
			$this->smarty->assign("id_paciente_examen_baciloscopia", $baciloscopia->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_baciloscopia", '1');
			$this->smarty->assign("examen_baciloscopia", '0');
		}
		
		$pap = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,6);
		if ($pap){
			$this->smarty->assign("examen_pap", '1');
			$this->smarty->assign("agenda_pap", '0');
			$this->smarty->assign("id_paciente_examen_pap", $pap->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_pap", '1');
			$this->smarty->assign("examen_pap", '0');
		}
		
		$colesterol = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,7);
		if ($colesterol){
			$this->smarty->assign("examen_colesterol", '1');
			$this->smarty->assign("agenda_colesterol", '0');
			$this->smarty->assign("id_paciente_examen_colesterol", $colesterol->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_colesterol", '1');
			$this->smarty->assign("examen_colesterol", '0');
		}
		
		$mamografia = $this->_DAOPacienteExamen->getByIdPacienteExamen($id_paciente,8);
		if ($mamografia){
			$this->smarty->assign("examen_mamografia", '1');
			$this->smarty->assign("agenda_mamografia", '0');
			$this->smarty->assign("id_paciente_examen_mamografia", $mamografia->id_paciente_examen);
			
		} else {
			$this->smarty->assign("agenda_mamografia", '1');
			$this->smarty->assign("examen_mamografia", '0');
		}
		
		//Cargar Datos Paciente
		$registro = $this->_DAOPaciente->getById($id_paciente);
		$direccion = $this->_DAOPacienteDireccion->getByIdPaciente($id_paciente);
		if ($registro->gl_rut != ""){
			$this->smarty->assign("gl_rut", $registro->gl_rut);
		} else {
		$this->smarty->assign("gl_rut", $registro->gl_run_pass);
		}
		
		$this->smarty->assign("gl_nombres", $registro->gl_nombres);
		$this->smarty->assign("gl_apellidos", $registro->gl_apellidos);
		$fc_nacimiento = $registro->fc_nacimiento;
		$fc_nacimiento = date("d/m/Y", strtotime($fc_nacimiento));
		$this->smarty->assign("fc_nacimiento", $fc_nacimiento);
		$reconoce = $registro->bo_reconoce;
        /* Caro 17-03-2017: guarda centro de salud para carga de laboratorios */
        $this->smarty->assign("id_centro_salud", $registro->id_centro_salud);

		//Cargar Datos DAU Examen
		//INICIO
		$empa = $this->_DAOEmpa->verInfoById($id_empa->id_empa);
		
		if ($empa->nr_ficha) {
			$this->smarty->assign("nr_ficha", $empa->nr_ficha);
		}
		
		if ($empa->gl_sector) {
			$this->smarty->assign("gl_sector", $empa->gl_sector);
		}
		
		if ($id_empa -> fc_empa != ""){
			$this->smarty->assign("fc_empa", $id_empa -> fc_empa);
		} else {
			$this->smarty->assign("fc_empa", date('Y-m-d'));
		}
		if ($empa->gl_peso) {
			$gl_peso = intval($empa->gl_peso);
			$this->smarty->assign("gl_peso", $gl_peso);
		}
		if ($empa->gl_estatura) {
			$gl_estatura = str_replace('.', '', $empa->gl_estatura);
			$this->smarty->assign("gl_estatura", $gl_estatura);
		}
		if ($empa->gl_circunferencia_abdominal) {
			$gl_circunferencia_abdominal = intval($empa->gl_circunferencia_abdominal);
			$this->smarty->assign("gl_circunferencia_abdominal", $gl_circunferencia_abdominal);
		}
		if ($empa->bo_embarazo == 1) {
			$this->smarty->assign("bo_embarazo_1", 'checked');
		} else if ($empa->bo_embarazo == 0) {
			$this->smarty->assign("bo_embarazo_0", 'checked');
		}
		
		if ($empa->bo_consume_alcohol == 1) {
			$this->smarty->assign("bo_consume_alcohol_1", 'checked');
		} else if ($empa->bo_consume_alcohol == 0) {
			$this->smarty->assign("bo_consume_alcohol_0", 'checked');
		} else if ($empa->bo_consume_alcohol == 2) {
			$this->smarty->assign("bo_consume_alcohol_2", 'checked');
		}

		if ($empa->bo_fuma == 1) {
			$this->smarty->assign("bo_fuma_1", 'checked');
		} else if ($empa->bo_fuma == 0) {
			$this->smarty->assign("bo_fuma_0", 'checked');
		}

		$this->smarty->assign("gl_puntos_audit", $empa->gl_puntos_audit);
		$this->smarty->assign("gl_imc", $empa->gl_imc);
		$this->smarty->assign("id_clasificacion_imc", $empa->id_clasificacion_imc);
		$this->smarty->assign("gl_pas", $empa->gl_pas);
		$this->smarty->assign("gl_pad", $empa->gl_pad);
		$this->smarty->assign("gl_glicemia", $empa->gl_glicemia);
		if ($empa->bo_glicemia_toma == 1) {
			$this->smarty->assign("bo_glicemia_toma", 'checked');
		}

		if ($empa->bo_trabajadora_reclusa == 1) {
			$this->smarty->assign("bo_trabajadora_reclusa_1", 'checked');
		} else if ($empa->bo_trabajadora_reclusa == 0) {
			$this->smarty->assign("bo_trabajadora_reclusa_0", 'checked');
		}

		if ($empa->bo_rpr == 1) {
			$this->smarty->assign("bo_rpr_1", 'checked');
		} else if ($empa->bo_rpr == 0) {
			$this->smarty->assign("bo_rpr_0", 'checked');
		}

		if ($empa->bo_vdrl == 1) {
			$this->smarty->assign("bo_vdrl_1", 'checked');
		} else if ($empa->bo_vdrl == 0) {
			$this->smarty->assign("bo_vdrl_0", 'checked');
		}
		
		if ($empa->bo_vih == 1) {
			$this->smarty->assign("bo_vih_1", 'checked');
		} else if ($empa->bo_vdrl == 0) {
			$this->smarty->assign("bo_vih_0", 'checked');
		}

		if ($empa->bo_tos_productiva == 1) {
			$this->smarty->assign("bo_tos_productiva_1", 'checked');
		} else if ($empa->bo_tos_productiva == 0) {
			$this->smarty->assign("bo_tos_productiva_0", 'checked');
		}

		if ($empa->bo_baciloscopia_toma == 1) {
			$this->smarty->assign("bo_baciloscopia_toma_1", 'checked');
		} else if ($empa->bo_baciloscopia_toma == 0) {
			$this->smarty->assign("bo_baciloscopia_toma_0", 'checked');
		}

		if ($empa->bo_pap_realizado == 1) {
			$this->smarty->assign("bo_pap_realizado_1", 'checked');
		} else if ($empa->bo_pap_realizado == 0) {
			$this->smarty->assign("bo_pap_realizado_0", 'checked');
		}
		
		if ($empa->bo_pap_resultado == 1) {
			$this->smarty->assign("bo_pap_resultado_1", 'checked');
		} else if ($empa->bo_pap_resultado == 0) {
			$this->smarty->assign("bo_pap_resultado_0", 'checked');
		} else if ($empa->bo_pap_resultado == 2) {
			$this->smarty->assign("bo_pap_resultado_2", 'checked');
		}
		
        $arrMes = $this->_DAOMes->getLista();
		$this->smarty->assign("arrMes", $arrMes);
		
		$this->smarty->assign("fc_ultimo_pap_ano", $empa->fc_ultimo_pap_ano);
		$this->smarty->assign("fc_ultimo_pap_mes", $empa->fc_ultimo_pap_mes);
		
		$this->smarty->assign("fc_mamografia_ano", $empa->fc_mamografia_ano);
		$this->smarty->assign("fc_mamografia_mes", $empa->fc_mamografia_mes);
		
		$this->smarty->assign("fc_ultimo_pap", $empa->fc_ultimo_pap);
		$this->smarty->assign("fc_tomar_pap", $empa->fc_tomar_pap);

		if ($empa->bo_pap_vigente == 1) {
			$this->smarty->assign("bo_pap_vigente_1", 'checked');
		} else if ($empa->bo_pap_vigente == 0) {
			$this->smarty->assign("bo_pap_vigente_0", 'checked');
		}

		if ($empa->bo_pap_toma == 1) {
			$this->smarty->assign("bo_pap_toma_1", 'checked');
		} else if ($empa->bo_pap_toma == 0) {
			$this->smarty->assign("bo_pap_toma_0", 'checked');
		}

		$this->smarty->assign("gl_colesterol", $empa->gl_colesterol);

		if ($empa->bo_colesterol_toma == 1) {
			$this->smarty->assign("bo_colesterol_toma", 'checked');
		}
		
		if ($empa->bo_mamografia_resultado_pasado == 1) {
			$this->smarty->assign("bo_mamografia_resultado_pasado_1", 'checked');
		} else if ($empa->bo_mamografia_resultado_pasado == 0) {
			$this->smarty->assign("bo_mamografia_resultado_pasado_0", 'checked');
		} else if ($empa->bo_mamografia_resultado_pasado == 2) {
			$this->smarty->assign("bo_mamografia_resultado_pasado_2", 'checked');
		}
		
		if ($empa->bo_mamografia_resultado == 1) {
			$this->smarty->assign("bo_mamografia_resultado_1", 'checked');
		} else if ($empa->bo_mamografia_resultado == 0) {
			$this->smarty->assign("bo_mamografia_resultado_0", 'checked');
		}
		
		if ($empa->bo_mamografia_realizada == 1) {
			$this->smarty->assign("bo_mamografia_realizada_1", 'checked');
		} else if ($empa->bo_mamografia_realizada == 0) {
			$this->smarty->assign("bo_mamografia_realizada_0", 'checked');
		}

		if ($empa->bo_mamografia_vigente == 1) {
			$this->smarty->assign("bo_mamografia_vigente_1", 'checked');
		} else if ($empa->bo_mamografia_vigente == 0) {
			$this->smarty->assign("bo_mamografia_vigente_0", 'checked');
		}
		
		if ($empa->bo_antecedente_diabetes == 1) {
			$this->smarty->assign("bo_antecedente_diabetes_1", 'checked');
		} else if ($empa->bo_antecedente_diabetes == 0) {
			$this->smarty->assign("bo_antecedente_diabetes_0", 'checked');
		}
		
		if ($empa->bo_mamografia_requiere == 1) {
			$this->smarty->assign("bo_mamografia_requiere_1", 'checked');
		} else if ($empa->bo_mamografia_requiere == 0) {
			$this->smarty->assign("bo_mamografia_requiere_0", 'checked');
		}

		if ($empa->bo_mamografia_toma == 1) {
			$this->smarty->assign("bo_mamografia_toma", 'checked');
		}

		$this->smarty->assign("gl_observaciones_empa", $empa->gl_observaciones_empa);
		//FIN

		if ($reconoce == 1) {
			$check = "checked disabled";
		} else {
			$check = "";
		}
		$this->smarty->assign("check", $check);
		//calculo edad
		$fc_nacimiento = str_replace("'","",Fechas::formatearBaseDatos($fc_nacimiento));
		list($Y, $m, $d ) = explode("-", $fc_nacimiento);
		$edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
		$this->smarty->assign("edad", $edad);
		//Mostrar/Ocultar Panel Dislipidemia segun Edad
		if ($edad > 40) {
			$dislipidemia = "display: block";
		} else {
			$dislipidemia = "display: none";
		}
		//Mostrar/Ocultar Diabetes segun Edad y datos Glicemia
		if ($edad > 40 || $empa->gl_glicemia) {
			$diabetes = "display: block";
		} else {
			$diabetes = "display: none";
		}
		//Mostrar/Ocultar PAP segun edad
		if (!($edad > 24 && $edad < 65) || ($empa->bo_embarazo == 1)) {
			$pap = "display: none";
		} else {
			$pap = "display: block";
		}
		//Mostrar/Ocultar MAMOGRAFIA segun embarazada
		if ($empa->bo_embarazo == 1) {
			$mamografia = "display: none";
		} else {
			$mamografia = "display: block";
		}
        
        /* Caro 15-03-2017*/
        //Exámenes fijos en formulario EMPA
        $this->smarty->assign("id_glicemia", "1");
        $this->smarty->assign("id_vdrl", "2");
        $this->smarty->assign("id_rpr", "3");
        $this->smarty->assign("id_vih", "4");
        $this->smarty->assign("id_baciloscopia", "5");
        $this->smarty->assign("id_pap", "6");
        $this->smarty->assign("id_colesterol", "7");
        $this->smarty->assign("id_mamografia", "8");
        $this->smarty->assign("id_hipertension", "9");
        /* Fin Caro */
		
		$this->smarty->assign("bo_finalizado", $empa->bo_finalizado);
		$this->smarty->assign("mamografia", $mamografia);
		$this->smarty->assign("pap", $pap);
		$this->smarty->assign("diabetes", $diabetes);
		$this->smarty->assign("dislipidemia", $dislipidemia);
		$this->smarty->assign("gl_fono", $registro->gl_fono);
		$this->smarty->assign("gl_celular", $registro->gl_celular);
		$this->smarty->assign("gl_email", $registro->gl_email);
		$this->smarty->assign("gl_direccion", $direccion->gl_direccion);
		$this->smarty->assign("botonAyudaAlcoholico", Boton::botonAyuda("Evitar el uso de bebidas alcohólicas", "Consejería", "", "btn-danger"));
		$this->smarty->assign("botonAyudaFumador", Boton::botonAyuda("Evitar el uso de tabaco", "Consejería", "", "btn-danger"));
		$this->smarty->assign("botonAyudaCircunferenciaAbdominal", Boton::botonAyuda("Punto medio entre margen inferior de la ultima costilla y la cresta iliaca.", "Información", "", "btn-info"));
		$this->smarty->assign("botonAyudaCAbdominal88", Boton::botonAyuda("Alimentación Sana y Actividad Física", "Consejería", "", "btn-danger"));
		$this->smarty->assign("botonAyudaIMC", Boton::botonAyuda("Medida de asociación entre la masa y la talla de un individuo", "Información", "", "btn-info"));
		$this->smarty->assign("botonAyudaPAS", Boton::botonAyuda("si >= 140 es hipertensión", "Información", "", "btn-info"));
		$this->smarty->assign("botonAyudaPAD", Boton::botonAyuda("si >= 90 es hipertensión", "Información", "", "btn-info"));
		$this->smarty->assign("botonAyudaGlicemia", Boton::botonAyuda("en ayunas de 8 horas como mínimo", "Indicaciones", "", "btn-warning"));
		$this->smarty->assign("botonConsejeriaGlicemia", Boton::botonAyuda("Reducir ingesta de azúcares y realizar actividad física (controlada)", "Consejería", "", "btn-danger"));
		$this->smarty->assign("botonAyudaBasiloscopia", Boton::botonAyuda("1ra muestra de inmediato y entrega de una caja para muestra del día siguiente al despertar", "Indicaciones", "", "btn-warning"));
		$this->smarty->assign("botonAyudaTomarFecha", Boton::botonAyuda("Tomar Fecha para Examen de Papanicolau (PAP)", "Info", "", "btn-warning"));
		$this->smarty->assign("botonAyudaPAPVigente", Boton::botonAyuda("Fecha de vigencia: Menor o igual de 3 años", "Información", "", "btn-info"));
		$this->smarty->assign("botonAyudaMamografiaVigente", Boton::botonAyuda("Fecha de vigencia: Menor o igual de 1 año", "Información", "", "btn-info"));
		$this->smarty->assign("botonConsejeriaColesterol", Boton::botonAyuda("Reducir ingesta calorías y realizar actividad física (controlada)", "Consejería", "", "btn-danger"));
		$this->smarty->assign("botonInformacionAgenda", Boton::botonAyuda("Referir confirmación diagnóstica con profesional de la salud.", "Consejeria", "", "btn-danger"));
		$this->smarty->assign("botonInformacionAgendaITS", Boton::botonAyuda("Referir a profesional de ITS por Sifilis.", "Consejeria", "", "btn-danger"));
		$this->smarty->assign("botonInformacionAgendaMamografia", Boton::botonAyuda("Agendar nueva mamografía.", "Información", "", "btn-info"));
		$this->smarty->assign("botonInformacionAgendaVIH", Boton::botonAyuda("Referir a Profesional de ITS por VIH.", "Información", "", "btn-danger"));
		//llamado al template
		$this->_display('Empa/nuevo.tpl');		
		$this->load->javascript(STATIC_FILES . "js/templates/empa/nuevo.js");
		$this->load->javascript(STATIC_FILES . "js/lib/validador.js");
		$this->load->javascript(STATIC_FILES . "js/templates/agenda/ver.js");
	}

	public function ver() {
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
		$arrEmpa = $this->_DAOEmpa->getById($id_empa);
		$this->smarty->assign("bo_finalizado", $arrEmpa->bo_finalizado);
		$arrPreguntas = $this->_DAOAuditPregunta->getLista();
		$arrAudit = $this->_DAOEmpaAudit->getByIdEmpa($id_empa);
		$total = 0;
		if (!is_null($arrAudit)) {
			foreach ($arrAudit as $item) {
				if (is_null($item->nr_valor)) {

					//$item->nr_valor = 0;
					$total += $item->nr_valor;
				} else {
					$total += $item->nr_valor;

				}
			}
		}
		$this->smarty->assign("id_empa", $id_empa);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("arrAudit", $arrAudit);
		$this->smarty->assign("arrPreguntas", $arrPreguntas);
		$this->smarty->display('Empa/audit.tpl');
	}

	public function guardar() {
		header('Content-type: application/json');
		$session = New Zend_Session_Namespace("usuario_carpeta");
		/*  Acceso::redireccionUnlogged($this->smarty);

		  $this->smarty->assign("id_usuario", $sesion->id);
		  $this->smarty->assign("rut", $sesion->rut);
		  $this->smarty->assign("usuario", $sesion->usuario);
		 */

		$parametros		= $this->_request->getParams();
		$correcto		= FALSE;
		$error			= FALSE;
		$finalizado		= FALSE;
		$id_empa = $parametros['id_empa'];
		$id_paciente = $parametros['id_paciente'];
		
		$bool_update = $this->_DAOEmpa->updateEmpa($parametros);
		if ($bool_update) {
			$resp = $this->_Evento->guardarMostrarUltimo(12,$id_empa,$id_paciente,"Empa modificado el : " . Fechas::fechaHoyVista()." por usuario ".$session->id,1,1,$_SESSION['id']);
			$correcto = TRUE;
			$finalizado = $this->guardarFinalizado($parametros);
			if ($finalizado){
				$this->_DAOEmpa->updateFinalizado($parametros);
				//$resp = $this->_Evento->guardar(2,$id_empa,$id_paciente,"Empa finalizado el : " . Fechas::fechaHoyVista()." por usuario ".$session->id,1,1,$_SESSION['id']);
			}
		} else {
			$error = TRUE;
		}

		$salida = array("error" => $error,
						"correcto" => $correcto,
						"finalizado" => $finalizado);
		$json = Zend_Json::encode($salida);

		echo $json;
	}

	public function guardarAudit() {
		header('Content-type: application/json');
		$session = New Zend_Session_Namespace("usuario_carpeta");
		$parametros = $this->_request->getParams();
		//print_r($parametros); die;
		$correcto = false;
		$error = false;
		$cant_preguntas = $parametros['cant_pre'];
		$id_empa = $parametros['id_empa'];
		for ($i = 1; $i <= $cant_preguntas; $i++) {
			$id_pregunta = $i;
			$valor = $parametros['pregunta_' . $i];
			$id_empa_audit = $this->_DAOEmpaAudit->updateEmpaAudit($id_empa, $id_pregunta, $valor);
			//$bool_update = $this->_DAOEmpa->updateEmpa($parametros);
		}
		if ($id_empa_audit) {
			$correcto = $this->_Evento->guardarMostrarUltimo(15,$id_empa,0,"AUDIT del EMPA ".$id_empa."  modificado el : " . Fechas::fechaHoy(),1,1,$session->id);
		} else {
			$error = true;
		}

		$salida = array("error" => $error,
			"correcto" => $correcto);
		$json = Zend_Json::encode($salida);

		echo $json;
	}

	public function mensajeIMC() {
		header('Content-type: application/json');
		$parametros = $this->_request->getParams();
		$correcto = false;
		$error = false;
		$datos = $this->_DAOTipoIMC->getTipoIMC($parametros['imc']);
		if ($datos) {
			$correcto = true;
			$gl_color = $datos->gl_color;
			$gl_descripcion = $datos->gl_descripcion;
			$id_tipo_imc = $datos->id_tipo_imc;
		} else {
			$error = true;
		}
		$salida = array("error" => $error,
			"correcto" => $correcto,
			"gl_color" => $gl_color,
			"gl_mensaje" => $gl_descripcion,
			"id_tipo_imc" => $id_tipo_imc);
		$json = Zend_Json::encode($salida);
		echo $json;
	}

	public function mensajeAUDIT() {
		header('Content-type: application/json');
		$parametros = $this->_request->getParams();
		$correcto = false;
		$error = false;
		$datos = $this->_DAOTipoAUDIT->getTipoAUDIT($parametros['pts_audit']);
		if ($datos) {
			$correcto = true;
			$gl_color = $datos->gl_color;
			$gl_descripcion = $datos->gl_descripcion;
			$id_tipo_audit = $datos->id_tipo_audit;
		} else {
			$error = true;
		}
		$salida = array("error" => $error,
			"correcto" => $correcto,
			"gl_color" => $gl_color,
			"gl_mensaje" => $gl_descripcion,
			"id_tipo_audit" => $id_tipo_audit);
		$json = Zend_Json::encode($salida);
		echo $json;
	}

	
	public function guardarFinalizado($parametros){
		//print_r($parametros); die;
		if ($parametros['gl_sector'] == 'NULL') {
			return FALSE;
		}
		if ($parametros['nr_ficha'] == 'NULL') {
			return FALSE;
		}

		if ($parametros['fc_empa'] == 'NULL') {
			return FALSE;
		}

		if ($parametros['bo_embarazo'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['bo_consume_alcohol'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['bo_consume_alcohol'] == 1 && $parametros['gl_puntos_audit'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['bo_fuma'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['gl_peso'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['gl_estatura'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['gl_imc'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['gl_circunferencia_abdominal'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['gl_pas'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['gl_pad'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['nr_edad'] > 40 && $parametros['gl_glicemia'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['gl_imc'] >= 30 && $parametros['gl_glicemia'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['bo_antecedente_diabetes'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['bo_antecedente_diabetes'] == 1 && $parametros['gl_glicemia'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['bo_trabajadora_reclusa'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['bo_tos_productiva'] == 'NULL') {
			return FALSE;
		}
		
		if ($parametros['bo_pap_realizado'] == 'NULL' && $parametros['nr_edad'] >= 25 && $parametros['nr_edad'] <= 64 && $parametros['bo_embarazo'] == 0) {
			return FALSE;
		}
		
		if ($parametros['bo_pap_realizado'] == 0 && 
			$parametros['nr_edad'] >= 25 && $parametros['nr_edad'] <= 64 && $parametros['bo_embarazo'] == 0){
			return FALSE;
		}
		
		if ($parametros['bo_pap_realizado'] == 1 && ($parametros['bo_pap_resultado'] == 'NULL' || $parametros['fc_ultimo_pap_ano'] == 'NULL' || 
			$parametros['fc_ultimo_pap_mes'] == 'NULL' || $parametros['bo_pap_vigente'] == 'NULL') && 
			$parametros['nr_edad'] >= 25 && $parametros['nr_edad'] <= 64 && $parametros['bo_embarazo'] == 0){
			return FALSE;
		}
		
		if ($parametros['gl_colesterol'] == 'NULL' && $parametros['nr_edad'] >= 40) {
			return FALSE;
		}
		
		if ($parametros['bo_mamografia_realizada'] == 'NULL' && $parametros['bo_embarazo'] == 0) {
			return FALSE;
		}
		
		if ($parametros['bo_mamografia_requiere'] == 'NULL' && $parametros['bo_embarazo'] == 0) {
			return FALSE;
		}
		
		if ($parametros['bo_mamografia_realizada'] == 1 && $parametros['bo_embarazo'] == 0 && ($parametros['fc_mamografia_mes'] == 'NULL' || $parametros['fc_mamografia_ano'] == 'NULL' ||
			$parametros['bo_mamografia_vigente'] == 'NULL' || $parametros['bo_mamografia_resultado_pasado'] == 'NULL')) {
			return FALSE;
		}
		
		if ($parametros['gl_observaciones_empa'] == 'NULL') {
			return FALSE;
		}
		
		return TRUE;
	}

}