<?php

class VistaExterna extends Controller{

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
    public function editar(){
        //$this->_addJavascript('https://maps.googleapis.com/maps/api/js?v=3.exp');
        $this->_addJavascript(STATIC_FILES.'js/plugins/jquery-2.1.1.min.js');
        $this->_addJavascript(STATIC_FILES.'js/plugins/jquery.flip.min.js');
        $this->_addJavascript(STATIC_FILES.'js/templates/Instalacion/mapa.js');
        //$this->_addJavascript(STATIC_FILES.'js/plugins/DataTables-1.10.5/media/js/jquery.dataTables.min.js');		
		
		if(isset($_POST['accion']) and $_POST['accion'] == "adjunto_nuevo" ){
			echo "Agregar archivo";
		}
		
		//$arrSipresaId 	= $this->_DAODatosRemoto->getOrigenesRemotos("sipresa_id",$idInstalacion)	;
		$arrSipresaId 	= $this->_DAODatosRemoto->getOrigenesRemotos("sipresa_id",62)	;
		//$arrSumanet 	= $this->_DAODatosRemoto->getOrigenesRemotos("sumanet_3_sumarios","?id=".$idInstalacion,false)	;				
		$arrSumanet 	= $this->_DAODatosRemoto->getOrigenesRemotos("sumanet_3_sumarios","?id=62",false)	;				
		
		$arrSumanet = json_decode($arrSumanet);
		
		$e	= str_replace(",",".",$arrSipresaId->datos_generales->ins_c_coordenada_e);
		$n 	= str_replace(",",".",$arrSipresaId->datos_generales->ins_c_coordenada_n);
		
		//Convertir coordenadas de UTM a LatLon
		$arrLatLong = ToLL($n,$e,19);
		
		//Setear nuevas coordenadas	en datos nuevos
		$arrSipresaId->datos_generales->lat = $arrLatLong['lat'];
		$arrSipresaId->datos_generales->lon = $arrLatLong['lon'];		
		
		$this->smarty->assign("id_instalacion",62);			
		$this->smarty->assign("arrAdjuntos",$this->_DAOAdjuntos->getAdjuntosInstalacion(1));			
        $this->smarty->assign('arrSipresa',$arrSipresaId->datos_generales);
        $this->smarty->assign('arrAmbitos',$arrSipresaId->ambitos);		
		$this->smarty->assign('arrTipos',$this->_DAOAdjuntos->getTipos());		
        $this->smarty->assign('arrSumarios',$arrSumanet->expedientes);
        $this->smarty->assign('arrSumariosArchivos',$arrSumanet->adjuntos);		
		$this->smarty->assign("FOLDER",'acceso');	
        $this->_display('instalacion/detalleInstalacion.tpl');
    }
	
    public function ocultarTour(){
		$this->_DAOUsuarios->update(array("gl_ocultar_tour" => "1"), $_SESSION['usuario']['id']);
		$_SESSION['usuario']['gl_ocultar_tour'] = 1;
    }	
	
    public function ocultarTourSession(){
		$_SESSION['usuario']['gl_ocultar_tour'] = 1;
    }		
	
    public function buscarRut(){

		$arrComunicacion[0] = "OK";
		$arrComunicacion['rut']	= trim($_POST['rut']);	
		//echo "http://localhost/sipresa/jsonp/BuscarRut.php?rut=".$arrComunicacion['rut'];
		$arrBusqueda = get_data("http://localhost/sipresa/jsonp/BuscarRut.php?rut=".$arrComunicacion['rut']);		
		$arrBusqueda = json_decode($arrBusqueda);	
		$this->smarty->assign("arrResultado",$arrBusqueda);	
        $this->smarty->display('home/tabla_buscar_rut.tpl');		
    }			
	
    public function buscarDireccion(){
		
		/*Obtener parametros desde */
		$arrComunicacion[0] = "OK";
		$arrComunicacion['region'] 	= trim($_POST['region']);
		$arrComunicacion['comuna'] 	= trim($_POST['id_comuna']);
		$arrComunicacion['calle'] 	= trim($_POST['gl_calle']);
		$arrComunicacion['numero'] 	= trim($_POST['nr_numero']);
		
		$arrBusqueda = get_data_encrypt("http://localhost/sipresa/jsonp/BuscarDireccion.php",$arrComunicacion);		
		$this->smarty->assign("arrResultado",$arrBusqueda);	
        $this->smarty->display('home/tabla_buscar_rut.tpl');		
    }				

}

	
?>	