<?php

class DAODatosRemotos extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "origenes_remotos";
    
    /**
     * Constructor
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * 
     * @param int $id_usuario
     * @param int $id_sistema
     * @return array
     */
    public function getOrigenesRemotos($sistema,$idInstalacion){
		
		//Arreglo de parametros	
		$arrComunicacion[0] = "OK";
		$arrComunicacion['id'] 	= trim($idInstalacion);
		
        $query = $this->db->select("s.*")
                          ->from($this->_tabla . " s");

        $resultado = $query->getResult();
		
        if($resultado->numRows > 0){						  
			//Obtener URL y retornar json desencriptado
			
			$url = $resultado->rows->row_0;
			return get_data_encrypt($url,$arrComunicacion);
        }else{
			return false;
		}
    }
	
	
    public function prueba(){
		echo "METODO";
		return true;
    }	
    
}

