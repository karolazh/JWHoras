<?php

class Instalacion extends Controller{
    
    /**
     *
     * @var DAOUsuarios 
     */
    protected $_DAOUsuarios;
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->_DAOUsuarios = $this->load->model("DAOUsuarios");
        $this->_DAODatosRemoto = $this->load->model("DAODatosRemotos");
        $this->_DAOAdjuntos = $this->load->model("DAOAdjuntos");
		$this->_DAOInstalacion 	= $this->load->model("DAOInstalacion");		
		$this->_DAOAmbitos 	= $this->load->model("DAOAmbitos");		
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/busca_personas/plugins/");
    }
    
    /**
     * Index
     */
    public function index(){

        $this->_addJavascript(STATIC_FILES.'js/plugins/waterfall/handlebars.js');
        $this->_addJavascript(STATIC_FILES.'js/plugins/waterfall/waterfall.min.js');
        $this->_addJavascript(STATIC_FILES.'js/templates/busca_personas/index.js');
        $this->_addJavascript(STATIC_FILES.'js/plugins/jquery.flip.min.js');
        
        $this->_display('busca_personas/index.tpl');
    }
    
    public function nueva(){

		//$this->smarty->assign('rutUsuario',$_SESSION['usuario']['rut']);
		$this->smarty->assign('rutUsuario',"11724261-7");
        $this->_display('NuevaInstalacion/form.tpl');
    }	
	
    /**
     * Resultados de búsqueda
     */
    public function buscar(){
        header('Content-type: application/json');
        
        $limit = array("comienzo"   => $this->_request->getParam("page")-1,
                       "resultados" => 20);
        
        $lista = $this->_DAOUsuarios->listarBusqueda($this->_request->getParams(), $limit);
        $resultados = array();
        $cantidad = 0;
        if(!is_null($lista)){
            foreach($lista as $usuario){
				$imagen = "images/personas/".substr($usuario->rut,0,-2).".jpg";
				if(file_exists("static/".$imagen)){
					$imagen =  "/images/personas/".substr($usuario->rut,0,-2).".jpg";
				}else{
					$imagen =  "/images/no-image.png";
				}					
                $resultados["result"][] = array("image" => STATIC_FILES.$imagen,
                                                "width" => "150",
                                                "id" => $usuario->id,
                                                "rut" => $usuario->rut,
                                                "nombre" => $usuario->nombres." ".$usuario->apellidos);
                $cantidad++;
            }
        }
        $resultados["total"] = $cantidad;
        
        echo Zend_Json_Encoder::encode($resultados);
    }
	
    public function detalleInstalacion(){

		$parametros = $this->request->getParametros();
		$idInstalacion = $parametros[0];
		
		//$arrSipresaId = $this->_DAOInstalacion->getDetalleInstalacion($idInstalacion)	;
		$arrSipresaId 	= $this->_DAODatosRemoto->getOrigenesRemotos("sipresa_id","?id=".$idInstalacion,false)	;		
		$arrSumanet 	= $this->_DAODatosRemoto->getOrigenesRemotos("sumanet_3_sumarios","?id=".$idInstalacion,false)	;		
		//$arrSumanet 	= $this->_DAODatosRemoto->getOrigenesRemotos("sumanet_3_sumarios","?id=12903",false)	;		
		
	
		$arrSumanet = json_decode($arrSumanet);
		$arrSipresaId = json_decode($arrSipresaId);
		
		$resoluciones = array();
	
		
		foreach($arrSipresaId->ambitos as $item){
			$resoluciones[$item->gl_resolucion] = $item;
		}
		
		$arrSipresaId->arrResoluciones = $resoluciones;
		
		
		//print_r($arrSipresaId->resoluciones);
		
		//print_r($arrSipresaId->resoluciones);
		
		$e	= str_replace(",",".",$arrSipresaId->datos_generales->ins_c_coordenada_e);
		$n 	= str_replace(",",".",$arrSipresaId->datos_generales->ins_c_coordenada_n);
		
		//Convertir coordenadas de UTM a LatLon
		$arrLatLong = ToLL($n,$e,19);
		
		//Setear nuevas coordenadas	en datos nuevos
		$arrSipresaId->datos_generales->lat = $arrLatLong['lat'];
		$arrSipresaId->datos_generales->lon = $arrLatLong['lon'];
		
		$arrAmbitosResumen = array();
		foreach($arrSipresaId->ambitos as $itm){
			if(isset($arrAmbitosResumen[$itm->id_ambito])){
				$arrAmbitosResumen[$itm->id_ambito] = $arrAmbitosResumen[$itm->id_ambito] + 1;
			}else{
				$arrAmbitosResumen[$itm->id_ambito] = 1;
			}	
		}
		
		//print_r($arrAmbitosResumen);		
		
		//print_r($arrSipresaId->datos_generales);
		
		/*
		if($idInstalacion == 207314){
			
			$arrSipresaId->datos_generales->gl_resolucion = 160540661;
		}
		
		if($idInstalacion == 206864){			
			$arrSipresaId->datos_generales->gl_resolucion = 160550327;	
		}
		*/
		//echo "::".$arrSipresaId->datos_generales->gl_resolucion."::";
		
		
		//print_r($arrSipresaId->resoluciones);
		
		
		foreach($arrSipresaId->resoluciones as $itemResolucion){ 
			$strASD 		= $this->_DAODatosRemoto->getOrigenesRemotos("asd_antecedentes","?gl_codigo=".$itemResolucion->resolucion,false)	;				
			$arrASD[$itemResolucion->resolucion] = json_decode($strASD);
		
			//$this->_DAOAdjuntos->exportarDesdeASD($idInstalacion,$arrASD);			
			
		}		
		
		
		//if(trim($arrSipresaId->datos_generales->gl_resolucion) != ""){		
		

		//}
		
		//print_r($arrASD);		
		//die();
		
		$arrAdjuntos = $this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion);

		
		$arrAdjuntosTipo = array();	
		foreach($this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion) as $itemAdjunto){
			$arrAdjuntosTipo[$itemAdjunto->id_ambito][$itemAdjunto->id_tipo][] = $itemAdjunto;
		}		
		

		$arrAdjuntosResumen = array();
		foreach($arrAdjuntos as $itm){
			if(isset($arrAdjuntosResumen[$itm->id_tipo])){
				$arrAdjuntosResumen[$itm->id_tipo] = $arrAdjuntosResumen[$itm->id_tipo] + 1;
			}else{
				$arrAdjuntosResumen[$itm->id_tipo] = 1;
			}	
		}		
		
		foreach($arrSipresaId->ambitos as $item){
			
			$arrAmbitos[$item->id_ambito] = $item;
			
		}
		
		//Obtener adjuntos desde ASD
		
		
		//print_r($arrSipresaId->resoluciones);
		
		//print_r($arrSipresaId->arrResoluciones);
		
		//Llenar los arreglos de datos para el template
        $this->smarty->assign('idInstalacion',$idInstalacion);
        $this->smarty->assign('arrSipresa',$arrSipresaId->datos_generales);
        $this->smarty->assign('arrAdjuntos',$this->_DAOAdjuntos->getAdjuntosInstalacion($idInstalacion));
        $this->smarty->assign('arrAdjuntosASD',$arrASD);
        $this->smarty->assign('arrAdjuntosResumen',$arrAdjuntosResumen);
		$this->smarty->assign("arrAdjuntosTipo",$arrAdjuntosTipo);					
        $this->smarty->assign('arrTipos',$this->_DAOAdjuntos->getTipos());
        $this->smarty->assign('arrAmbitos',$arrAmbitos);
        $this->smarty->assign('arrAmbitosBD',$this->_DAOAmbitos->getAmbitos());
        $this->smarty->assign('arrActividades',$arrSipresaId->actividades);
		$this->smarty->assign('arrCamposTipo',$this->_DAOAdjuntos->getTiposCampos());		
        $this->smarty->assign('arrAmbitosResumen',$arrAmbitosResumen);
        $this->smarty->assign('arrSumarios',$arrSumanet->expedientes);
        $this->smarty->assign('arrSumariosArchivos',$arrSumanet->adjuntos);
        $this->smarty->assign('arrResoluciones',$arrSipresaId->arrResoluciones);
		
        $this->smarty->display('instalacion/detalleInstalacion.tpl');
		
    }	
}