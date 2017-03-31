<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Controller para Exámenes de Pacientes
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 15/03/2017
 * 
 * @name             Agenda.php
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
class Agenda extends Controller {
    
    protected $_DAOEmpa;
    protected $_DAOPaciente;
    protected $_DAOPacienteExamen;
    protected $_DAOPacienteDireccion;
    protected $_DAOLaboratorio;
    protected $_DAOTipoExamen;
    protected $_DAOPacienteAgendaEspecialista;

	function __construct() {
		parent::__construct();
        $this->load->lib('Fechas', false);
		$this->load->lib('Boton', false);
		$this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);

		$this->_Evento					= new Evento();
        $this->_DAOEmpa                 = $this->load->model("DAOEmpa");
		$this->_DAOPaciente				= $this->load->model("DAOPaciente");
        $this->_DAOPacienteExamen		= $this->load->model("DAOPacienteExamen");
        $this->_DAOPacienteDireccion	= $this->load->model("DAOPacienteDireccion");
        $this->_DAOLaboratorio			= $this->load->model("DAOLaboratorio");
        $this->_DAOTipoExamen			= $this->load->model("DAOTipoExamen");
        $this->_DAOPacienteAgendaEspecialista			= $this->load->model("DAOPacienteAgendaEspecialista");
	}

    public function index() {
		Acceso::redireccionUnlogged($this->smarty);
	}
    
    /**
	 * Descripción: Ver Agenda de Examenes
	 * @author Carolina Zamora <carolina.zamora@cosof.cl>
	 */
    public function ver() {
        Acceso::redireccionUnlogged($this->smarty);
        
        $parametros  = $this->request->getParametros();
        $id_paciente = $parametros[0];
        
        //Grilla Exámenes x Paciente
        $arrExamenes = $this->_DAOPacienteExamen->getByIdPaciente($id_paciente);
        
        //Genera string de fechas pa calendario
        $arrAgenda   = "";
        if (!is_null($arrExamenes)) {
            foreach($arrExamenes as $item){
                /* 2017-03-21 Valida que examen no sea "Externo"; no debe aparecer en Calendario */
                if ($item->id_paciente_examen != 0) {
                    $descripcion = "Toma Examen ". $item->gl_nombre_examen;
                    $fecha       = $item->fc_toma_calendar;

                    if (!is_null($item->gl_hora_toma)){
                        $hora = $item->gl_hora_toma;                    
                    } else {
                        $hora = "";
                    }
					$id_paciente_examen	= $item->id_paciente_examen;
                    $arrAgenda   = "$arrAgenda $descripcion,$fecha,$hora,$id_paciente_examen;";
                }
			}
        }
        
        //Datos de Paciente
        $detPaciente = $this->_DAOPaciente->getByIdPaciente($id_paciente);
        if (!is_null($detPaciente)) {            
            $run = "";
            if ($detPaciente->bo_extranjero == 0) {
                $run = $detPaciente->gl_rut;
            } else {
                $run = $detPaciente->gl_run_pass;
            }
            $nombres = $detPaciente->gl_nombres.' '.$detPaciente->gl_apellidos;
            $edad = Fechas::calcularEdadInv($detPaciente->fc_nacimiento);
			
            if ($detPaciente->gl_sexo == "F") {
                $sexo = "FEMENINO";
            } else {
                $sexo = $detPaciente->gl_sexo;
            }
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
            //Dirección Vigente de Paciente
            $detDireccion = $this->_DAOPacienteDireccion->getDireccionVigenteById($id_paciente);
            if (!is_null($detDireccion)) {
                $direccion = $detDireccion->gl_direccion;
                $comuna    = $detDireccion->gl_nombre_comuna;
                $provincia = $detDireccion->gl_nombre_provincia;
                $region    = $detDireccion->gl_nombre_region;
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
            $this->smarty->assign("gl_celular", $detPaciente->gl_celular);
            $this->smarty->assign("gl_email", $detPaciente->gl_email);
            $this->smarty->assign("fc_crea", $detPaciente->fc_crea);
            $this->smarty->assign("bo_reconoce", $reconoce);
            $this->smarty->assign("bo_acepta_programa", $acepta);
            $this->smarty->assign("gl_nombre_comuna", $comuna);
            $this->smarty->assign("gl_nombre_provincia", $provincia);
            $this->smarty->assign("gl_nombre_region", $region);
            $this->smarty->assign("gl_direccion", $direccion);            
        }
        
        $this->smarty->assign('arrExamenes', $arrExamenes);
        $this->smarty->assign('arrAgendaExamenes', $arrAgenda);
        $this->smarty->display('agenda/ver.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/agenda/agenda.js");
	}
	
    /**
	 * Descripción: Agenda Laboratorio
	 * @author S/N
	 */
    public function agendaLaboratorio() {
        Acceso::redireccionUnlogged($this->smarty);
        $id_laboratorio	= $_SESSION['id_laboratorio'];
        
        //Grilla Exámenes x Paciente
        $arrExamenes = $this->_DAOPacienteExamen->getAllByIdLaboratorio($id_laboratorio); // Obtener por Laboratorio

        $arrAgenda		= "";
        if (!is_null($arrExamenes)) {
            foreach($arrExamenes as $item){
                /* 2017-03-21 Valida que examen no sea "Externo"; no debe aparecer en Calendario */
                //if (($item->id_paciente_examen != 0) and (!is_null($item->gl_resultado))) {
                if ($item->id_paciente_examen != 0) {
                    $descripcion = "Toma Examen ". $item->gl_nombre_examen;
                    $fecha = $item->fc_toma_calendar;

                    if (!is_null($item->gl_hora_toma)){
                        $hora = $item->gl_hora_toma;                    
                    } else {
                        $hora = "";
                    }
					$id_paciente_examen	= $item->id_paciente_examen;
                    $arrAgenda = "$arrAgenda $descripcion,$fecha,$hora,$id_paciente_examen;"; 
                    //$arrAgenda = $arrAgenda.$hora." ".$descripcion.",".$fecha.";";

					/*
                    if (!is_null($item->fc_resultado_calendar)){
                        $descripcion_result = "Resultado Examen ". $item->gl_nombre_examen;
                        $fecha_result = $item->fc_resultado_calendar;
                        //$arrAgenda = $arrAgenda.$descripcion_result.",".$fecha_result.";";
                        $arrAgenda = $arrAgenda.$descripcion_result.",".$fecha_result.",;";
                    }
					*/
                }
			}
        }
        
        $this->smarty->assign('arrExamenes', $arrExamenes);
        $this->smarty->assign('arrAgendaExamenes', $arrAgenda);
        $this->_display('agenda/agendaLaboratorio.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/agenda/agenda.js");
		$this->load->javascript(STATIC_FILES . "template/plugins/fullcalendar/fullcalendar.min.js");
		$this->load->javascript(STATIC_FILES . "template/plugins/fullcalendar/locale/es.js");
		$this->load->javascript(STATIC_FILES . "template/plugins/fullcalendar/lib/moment.min.js");
	}
	
    /**
	 * Descripción: Ver Agenda de Examenes
	 * * @author Carolina Zamora <carolina.zamora@cosof.cl>
	 */
    public function agendar() {
        Acceso::redireccionUnlogged($this->smarty);        
        $parametros  = $this->request->getParametros();
        $id_paciente = $parametros[0];
        
        //valida si agenda examen de empa o de laboratorio
        if (isset($parametros[1])) {
            $id_empa = $parametros[1];
        } else {
            $id_empa = "";
        }
        $id_centro_salud = $parametros[2];
        //valida si agenda examen de empa o de laboratorio
        if (isset($parametros[3])) {
            $id_examen = $parametros[3];
        } else {
            $id_examen = "";
        }
        
        $perfil = $_SESSION['perfil'];
        if ($perfil == 7) { //"Laboratorio"
            $rut_lab         = $_SESSION['rut'];
            $nombre_lab      = $_SESSION['nombre'];
            $id_laboratorio  = $_SESSION['id_laboratorio'];            
            //Combo Laboratorios según tipo de usuario
            $arrLaboratorios = $this->_DAOLaboratorio->getLista();
        } else {
            $rut_lab         = "";
            $nombre_lab      = "";
            $id_laboratorio  = "";
            //Combo Laboratorios según tipo de usuario
            $arrLaboratorios = $this->_DAOLaboratorio->getByIdCentroSalud($id_centro_salud);
        }        
        
        //Combos Tipo Examen
        $arrTipoExamen = $this->_DAOTipoExamen->getLista();
        
        $this->smarty->assign("id_paciente", $id_paciente);
        $this->smarty->assign("id_empa", $id_empa);
        $this->smarty->assign("id_centro_salud", $id_centro_salud);
        $this->smarty->assign("id_examen", $id_examen);        
        $this->smarty->assign("perfil", $perfil);
        $this->smarty->assign("id_laboratorio", $id_laboratorio);
        $this->smarty->assign('arrLaboratorios', $arrLaboratorios);
        $this->smarty->assign('arrTipoExamen', $arrTipoExamen);
        
        $this->smarty->display('agenda/agendar.tpl');
        $this->load->javascript(STATIC_FILES . 'js/templates/agenda/ver.js');
    }
    
    /**
	 * Descripción: Guardar Fecha/Hora Paciente en Agenda
	 * @author Carolina Zamora <carolina.zamora@cosof.cl>
     * @return JSON
	 */
    public function guardarAgenda() {
        header('Content-type: application/json');

        $correcto   = false;
        $error      = true;
        
        $id_paciente = $_POST['id_paciente'];
        if ($_POST['id_empa'] != "") {
            $id_empa = $_POST['id_empa'];
        } else {
            $id_empa = NULL;
        }
        $id_laboratorio = $_POST['id_laboratorio'];
        $id_examen      = $_POST['id_examen'];
        
		if($id_examen==1){ $gl_examen = 'glicemia'; }
		if($id_examen==2){ $gl_examen = 'vdrl'; }
		if($id_examen==3){ $gl_examen = 'rpr'; }
		if($id_examen==4){ $gl_examen = 'vih'; }
		if($id_examen==5){ $gl_examen = 'baciloscopia'; }
		if($id_examen==6){ $gl_examen = 'pap'; }
		if($id_examen==7){ $gl_examen = 'colesterol'; }
		if($id_examen==8){ $gl_examen = 'mamografia'; }
		if($id_examen==9){ $gl_examen = 'hipertension'; }
		
        $fecha_agenda = $_POST['fecha_agenda'];
		$fecha_agenda = str_replace("'","",Fechas::formatearBaseDatos($fecha_agenda));
        if ($_POST['hora_agenda'] != "") {
            $hora_agenda = $_POST['hora_agenda'];
        } else {
            $hora_agenda = NULL;
        }
        $observacion = $_POST['observacion'];
        
        $ins_agenda = array('id_tipo_examen'      => $id_examen,
                            'id_paciente'         => $id_paciente,
                            'id_empa'             => $id_empa,
                            'id_laboratorio'      => $id_laboratorio,
                            'fc_toma'             => $fecha_agenda,
                            'gl_hora_toma'        => $hora_agenda,
                            'gl_observacion_toma' => $observacion,
                            'fc_crea'             => date('Y-m-d H:m:s'),
                            'id_usuario_crea'     => $_SESSION['id']
                        );

        $id_agenda = $this->_DAOPacienteExamen->insert($ins_agenda);
        if ($id_agenda) {
			$ultimoId = $this->_DAOPacienteExamen->getLastId();
            //inserta ids en empa
            if ($id_empa != NULL){

                if ($id_examen == 1) { $resp = $this->_DAOEmpa->update(array('id_examen_glicemia'     => $id_agenda), $id_empa, 'id_empa'); }
                if ($id_examen == 2) { $resp = $this->_DAOEmpa->update(array('id_examen_vdrl'         => $id_agenda), $id_empa, 'id_empa'); }
                if ($id_examen == 3) { $resp = $this->_DAOEmpa->update(array('id_examen_rpr'          => $id_agenda), $id_empa, 'id_empa'); }
                if ($id_examen == 4) { $resp = $this->_DAOEmpa->update(array('id_examen_vih'          => $id_agenda), $id_empa, 'id_empa'); }
                if ($id_examen == 5) { $resp = $this->_DAOEmpa->update(array('id_examen_baciloscopia' => $id_agenda), $id_empa, 'id_empa'); }
                if ($id_examen == 6) { $resp = $this->_DAOEmpa->update(array('id_examen_pap'          => $id_agenda), $id_empa, 'id_empa'); }
                if ($id_examen == 7) { $resp = $this->_DAOEmpa->update(array('id_examen_colesterol'   => $id_agenda), $id_empa, 'id_empa'); }
                if ($id_examen == 8) { $resp = $this->_DAOEmpa->update(array('id_examen_mamografia'   => $id_agenda), $id_empa, 'id_empa'); }
                if ($id_examen == 9) { $resp = $this->_DAOEmpa->update(array('id_examen_hipertension' => $id_agenda), $id_empa, 'id_empa'); }
                
                if ($resp) {
                    $correcto = true;
                } else {
                    $error = true;
                }
            } else {
                $correcto = true;
            }            
        } else {
            $error = true;
        }
        
        //Actualiza Grilla Exámenes x Paciente
        if (isset($_SESSION['id_laboratorio'])) {
            $arrExamenes = $this->_DAOPacienteExamen->getByIdLaboratorio($_SESSION['id_laboratorio'], $id_paciente);
        } else {
            $arrExamenes     = $this->_DAOPacienteExamen->getByIdPaciente($id_paciente);
        }
        $this->smarty->assign('arrExamenes', $arrExamenes);
        $grilla = $this->smarty->fetch('laboratorio/grillaExamenesLaboratorio.tpl');

        $salida = array("error"     => $error,
                        "correcto"  => $correcto,
                        "grilla"    => $grilla,
                        "id_agenda" => $id_agenda,
						"ultimo_id" => $ultimoId->id_paciente_examen,
						"gl_examen" => $gl_examen);

        $this->smarty->assign("hidden", "");
        $json = Zend_Json::encode($salida);

        echo $json;
    }
	
	/**
	 * Descripción: Agenda Especialista
	 * @author David Guzmán <david.guzman@cosof.cl>
	 */
    public function especialista() {
        Acceso::redireccionUnlogged($this->smarty);
        $id_especialista	= $_SESSION['id'];
        
        //Grilla Hora Especialista x Paciente
        $arrHoraEspecialista = $this->_DAOPacienteAgendaEspecialista->getAllByIdEspecialista($id_especialista); // Obtener por Especialista
		//print_r($arrHoraEspecialista); die;
        $arrAgenda		= "";
        if (!is_null($arrHoraEspecialista)) {
            foreach($arrHoraEspecialista as $item){
                if ($item->id_agenda_especialista != 0) {
                    $descripcion = "Cita con ". $item->gl_especialidad;
                    $fecha = $item->fecha_agenda_calendar;

                    if (!is_null($item->hora_agenda)){
                        $hora = $item->hora_agenda;                    
                    } else {
                        $hora = "";
                    }
					$id_agenda_especialista	= $item->id_agenda_especialista;
                    $arrAgenda = "$arrAgenda $descripcion,$fecha,$hora,$id_agenda_especialista;";
                }
			}
        }
        
        $this->smarty->assign('arrHoraEspecialista', $arrHoraEspecialista);
        $this->smarty->assign('arrAgenda', $arrAgenda);
        $this->_display('agenda/agendaEspecialista.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/agenda/agenda.js");
		$this->load->javascript(STATIC_FILES . "template/plugins/fullcalendar/fullcalendar.min.js");
		$this->load->javascript(STATIC_FILES . "template/plugins/fullcalendar/locale/es.js");
		$this->load->javascript(STATIC_FILES . "template/plugins/fullcalendar/lib/moment.min.js");
	}
	
	/**
	 * Descripción: Ver Agenda de Horas Especialistas x Paciente
	 * @author David Guzmán <david.guzman@cosof.cl>
	 */
    public function verEspecialista() {
        Acceso::redireccionUnlogged($this->smarty);
        
        $parametros  = $this->request->getParametros();
        $id_paciente = $parametros[0];
        $mostrar_agenda_paciente = 1;
        //Grilla Horas Especialistas x Paciente
        $arrHoraEspecialista = $this->_DAOPacienteAgendaEspecialista->getAllByIdPaciente($id_paciente);
        
        //Genera string de fechas pa calendario
        $arrAgenda   = "";
        if (!is_null($arrHoraEspecialista)) {
            foreach($arrHoraEspecialista as $item){
                if ($item->id_agenda_especialista != 0) {
                    $descripcion = "Cita con ". $item->gl_especialidad;
                    $fecha       = $item->fecha_agenda_calendar;

                    if (!is_null($item->hora_agenda)){
                        $hora = $item->hora_agenda;                    
                    } else {
                        $hora = "";
                    }
					$id_agenda_especialista	= $item->id_agenda_especialista;
					$id_especialista	= $item->id_especialista;
                    $arrAgenda   = "$arrAgenda $descripcion,$fecha,$hora,$id_agenda_especialista,$id_especialista;";
                }
			}
        }
        
        //Datos de Paciente
        $detPaciente = $this->_DAOPaciente->getByIdPaciente($id_paciente);
        if (!is_null($detPaciente)) {            
            $run = "";
            if ($detPaciente->bo_extranjero == 0) {
                $run = $detPaciente->gl_rut;
            } else {
                $run = $detPaciente->gl_run_pass;
            }
            $nombres = $detPaciente->gl_nombres.' '.$detPaciente->gl_apellidos;
            $edad = Fechas::calcularEdadInv($detPaciente->fc_nacimiento);
            
            if ($detPaciente->gl_sexo == "F") {
                $sexo = "FEMENINO";
            } else {
                $sexo = $detPaciente->gl_sexo;
            }
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
            //Dirección Vigente de Paciente
            $detDireccion = $this->_DAOPacienteDireccion->getDireccionVigenteById($id_paciente);
            if (!is_null($detDireccion)) {
                $direccion = $detDireccion->gl_direccion;
                $comuna    = $detDireccion->gl_nombre_comuna;
                $provincia = $detDireccion->gl_nombre_provincia;
                $region    = $detDireccion->gl_nombre_region;
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
            $this->smarty->assign("gl_celular", $detPaciente->gl_celular);
            $this->smarty->assign("gl_email", $detPaciente->gl_email);
            $this->smarty->assign("fc_crea", $detPaciente->fc_crea);
            $this->smarty->assign("bo_reconoce", $reconoce);
            $this->smarty->assign("bo_acepta_programa", $acepta);
            $this->smarty->assign("gl_nombre_comuna", $comuna);
            $this->smarty->assign("gl_nombre_provincia", $provincia);
            $this->smarty->assign("gl_nombre_region", $region);
            $this->smarty->assign("gl_direccion", $direccion);            
        }
        
        $this->smarty->assign('mostrar_agenda_paciente', $mostrar_agenda_paciente);
        $this->smarty->assign('arrHoraEspecialista', $arrHoraEspecialista);
        $this->smarty->assign('arrAgenda', $arrAgenda);
        $this->smarty->display('agenda/verEspecialista.tpl');
		$this->load->javascript(STATIC_FILES . "js/templates/especialista/agenda.js");
		//$this->load->javascript(STATIC_FILES . "js/templates/agenda/agenda.js");
	}
	
}