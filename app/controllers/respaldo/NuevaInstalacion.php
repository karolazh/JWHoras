<?php

class NuevaInstalacion extends Controller{

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
        Acceso::set("ALL");
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/home/plugins/");
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        //$this->_DAOComuna 	= $this->load->model("DAOComuna");
        $this->_DAODatosRemoto = $this->load->model("DAODatosRemotos");		
        $this->_DAOAdjuntos 	= $this->load->model("DAOAdjuntos");
    }

    /**
     * 
     */
    public function index(){
        
    }

    /**
     * 
     */
    public function form(){

        //$this->_addJavascript(STATIC_FILES.'js/templates/AdjuntosInstalacion/editar.js');
		/*
		if(isset($_POST['id_instalacion'])){
			$idInstalacion = $_POST['id_instalacion'];
		}	
		*/
		if(isset($_POST['accion']) and $_POST['accion'] == "adjunto_nuevo" ){
			echo "Agregar archivo";
			//print_r($_POST)	;
			//die("xxx");	
			$idUnico 	= rand();
			$ruta 		= "documentos/".date("Ymd");
			
			@mkdir($ruta);
			
			$nombre 	= $idUnico."-".$_FILES['nuevo_archivo']['name'];
			
			$fp     = fopen($_FILES['nuevo_archivo']['tmp_name'], 'r+b');
			$data = fread($fp, filesize($_FILES['nuevo_archivo']['tmp_name']));
			fclose($fp);    
			
			$out = fopen($ruta."/".$idUnico."-".$_FILES['nuevo_archivo']['name'], "w");
			fwrite($out, $data);
			fclose($out);
			
			$idInstalacion = $_POST['id_agregar'];
			$this->_DAOAdjuntos->insAdjuntoLimpio($idInstalacion,"/".date("Ymd"),$nombre);
			
		}
		
		$arrSipresaId 	= $this->_DAODatosRemoto->getOrigenesRemotos("sipresa_id",$idInstalacion)	;
		$arrSumanet 	= $this->_DAODatosRemoto->getOrigenesRemotos("sumanet_3_sumarios","?id=62",false)	;				
		
		$arrSumanet = json_decode($arrSumanet);
		
		$e	= str_replace(",",".",$arrSipresaId->datos_generales->ins_c_coordenada_e);
		$n 	= str_replace(",",".",$arrSipresaId->datos_generales->ins_c_coordenada_n);
		
		//Convertir coordenadas de UTM a LatLon
		$arrLatLong = ToLL($n,$e,19);
		
		//Setear nuevas coordenadas	en datos nuevos
		$arrSipresaId->datos_generales->lat = $arrLatLong['lat'];
		$arrSipresaId->datos_generales->lon = $arrLatLong['lon'];		
		
		$arrTipoCampo = $this->_DAOAdjuntos->getTiposCampos();
		
		$this->smarty->assign("id_instalacion",$idInstalacion);			
		$this->smarty->assign("arrAdjuntos",$this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion));			
        $this->smarty->assign('arrSipresa',$arrSipresaId->datos_generales);
        $this->smarty->assign('arrAmbitos',$arrSipresaId->ambitos);		
		$this->smarty->assign('arrTipos',$this->_DAOAdjuntos->getTipos());		
		$this->smarty->assign('arrCamposTipo',$arrTipoCampo);		
		$this->smarty->assign("FOLDER",'acceso');	
        $this->_display('NuevaInstalacion/form.tpl');
    }
	
    public function guardarCambios(){

		if($_POST['gl_nombre'] == ""){ echo "Nombre no puede ser vacio\n";}
		if($_POST['cd_tipo'] == "0"){ echo "Debe seleccionar un tipo\n";}
		
		$respuesta = $this->_DAOAdjuntos->uptAdjunto($_POST);
		
		if($respuesta){
			echo "1";
		}else{
			echo "0";
		}
		
				
    }	
	

    public function eliminarADjunto(){

		$respuesta = $this->_DAOAdjuntos->delAdjunto($_POST);
		
		if($respuesta){
			echo "1";
		}else{
			echo "0";
		}
		
				
    }		
	
	
    public function cambiarTipo(){

		$arrUnico 	= explode('_',$_POST['form']);
		$idAdjunto 	= $arrUnico[2];
		
		
		$arrTipoCampo = $this->_DAOAdjuntos->getTiposCampos();
		
		$itm->id_tipo = $_POST['tipo'];		
		$this->smarty->assign('itm',$itm);		
		$this->smarty->assign('arrCamposTipo',$arrTipoCampo);		
		$this->smarty->display("instalacion/bloques/bloqueCamposEspeciales.tpl");

    }	

	/*	
    public function ocultarTour(){
		$this->_DAOUsuarios->update(array("gl_ocultar_tour" => "1"), $_SESSION['usuario']['id']);
		$_SESSION['usuario']['gl_ocultar_tour'] = 1;
    }	
	*/
	/*
    public function ocultarTourSession(){
		$_SESSION['usuario']['gl_ocultar_tour'] = 1;
    }		
	*/
	
	

}

	
?>	