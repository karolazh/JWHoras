<?php

class comuna extends Controller{

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
        Acceso::set("ALL");
        $this->smarty->addPluginsDir(APP_PATH . "views/templates/home/plugins/");
        $this->_DAOComuna 	= $this->load->model("DAOComuna");
    }

    /**
     * 
     */
    public function index(){
        
    }

    public function listaComuna(){
		
		$parametros = $this->request->getParametros();
		$idRegion = $parametros[0];		
		
		echo "<option value=\"0\" >-- TODAS --</option>";
		
		foreach($this->_DAOComuna->listar("name") as $item){
			if($item->region == $idRegion){	
				echo "<option value=\"{$item->id_sipresa}\" >{$item->name}</option>";		
			}	
		}
		
    }				

	
}

