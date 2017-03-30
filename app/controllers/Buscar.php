<?php

/**
******************************************************************************
* Sistema			: PREVENCION DE FEMICIDIOS
* Descripcion		: Controller para Buscar dentro del sistema
* Plataforma		: !PHP
* Creacion			: 27/03/2017
* @name				Buscar.php
* @version			1.0
* @author			Victor Retamal <victor.retamal@cosof.co>
* =============================================================================
* !ControlCambio
* --------------
* !cProgramador				!cFecha		!cDescripcion 
* -----------------------------------------------------------------------------
*
* -----------------------------------------------------------------------------
*******************************************************************************
*/

class Buscar extends Controller {

	protected $_Evento;
	protected $_DAORegion;
	protected $_DAOPaciente;
	protected $_DAOCentroSalud;


	function __construct() {
		parent::__construct();
		$this->load->lib('Fechas', false);
		$this->load->lib('Boton', false);
		$this->load->lib('Seguridad', false);
		$this->load->lib('Evento', false);

		$this->_Evento					= new Evento();
		$this->_DAORegion				= $this->load->model("DAORegion");
		$this->_DAOPaciente				= $this->load->model("DAOPaciente");
		$this->_DAOCentroSalud			= $this->load->model("DAOCentroSalud");
	}

	public function index() {
		Acceso::redireccionUnlogged($this->smarty);
	}

	/**
	* Descripción: buscar
	* @author: David Gusmán <david.guzman@cosof.cl>
	*/
	public function buscarPaciente() {
		Acceso::redireccionUnlogged($this->smarty);

		$mostrar		= 0;
		$bool_region	= 0;
		$parametros		= $this->_request->getParams();		
		$arrRegiones	= $this->_DAORegion->getLista();
		$arrCentroSalud	= $this->_DAOCentroSalud->getListaOrdenada();

		if ($_SESSION['perfil'] != 1 && $_SESSION['perfil'] != 5){
			$region			= $_SESSION['id_region'];
			$bool_region	= 1;
			$jscode1		= "$(\"#region option[value='".$region."']\").attr('selected',true);";
			$jscode2		= "$('#region').attr('readonly',true);";
			$jscode3		= "setTimeout(function(){ $('#region').trigger('change'); },100);";

			$this->smarty->assign('reg', $region);
			$this->_addJavascript($jscode1);
			$this->_addJavascript($jscode2);
			$this->_addJavascript($jscode3);
		}

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
				$jscode		= "xModal.danger('Error: No se puede buscar por Rut y Pasaporte a la vez');";
				$this->_addJavascript($jscode);
			} else if($rut != '' || $pasaporte != '' || $nombres != '' || $apellidos != '' || $cod_fonasa != '' || $centro_salud != 0 || $region != 0 || $comuna != 0){
				$mostrar	= 1;
				$arr		= $this->_DAOPaciente->buscarPaciente($parametros);

				$this->smarty->assign('reg', $region);
				$this->smarty->assign('arrResultado', $arr);
				$this->smarty->assign('rut',$rut);
				$this->smarty->assign('pasaporte',$pasaporte);
				$this->smarty->assign('nombres',$nombres);
				$this->smarty->assign('apellidos',$apellidos);
				$this->smarty->assign('cod_fonasa',$cod_fonasa);
				$this->_addJavascript(STATIC_FILES . "js/regiones.js");

				$jscode4	= "$(\"#centro_salud option[value='".$centro_salud."']\").attr('selected',true);";
				$jscode5	= "$(\"#region option[value='".$region."']\").attr('selected',true);";
				$jscode6	= "$('#region').trigger('change')";
				$jscode7	= "setTimeout(function(){ $(\"#comuna option[value='".$comuna."']\").attr('selected',true); },100);";

				$this->_addJavascript($jscode4);
				$this->_addJavascript($jscode5);
				$this->_addJavascript($jscode6);
				$this->_addJavascript($jscode7);
			}
		}
		
		$this->smarty->assign('bool_region', $bool_region);
		$this->smarty->assign("arrRegiones", $arrRegiones);
		$this->smarty->assign("arrCentroSalud", $arrCentroSalud);
		$this->smarty->assign('mostrar',$mostrar);
		$this->smarty->assign('origen', 'Buscar');

		$this->_display('buscar/paciente.tpl');
		$this->load->javascript(STATIC_FILES . "js/regiones.js");
		$this->load->javascript(STATIC_FILES . "js/templates/buscar/buscar.js");
	}

}