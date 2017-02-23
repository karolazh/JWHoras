<?php

class DAOInstalacion extends Model{

    /**
     *
     * @var string 
     */
    protected $_tabla = "usuario";
    
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }
    
    /**
     * 
     * @param array $parametros
     * @return array
     */
    public function listarBusqueda($parametros, $limit = array()){
        $query = $this->queryBusqueda($parametros);
        
        if(count($limit)>0){
            $query->limit($limit["comienzo"] * $limit["resultados"], $limit["resultados"]);
        }
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else{
            return NULL;
        }
    }
    
    /**
     * 
     * @param array $parametros
     * @return Database
     */
    public function queryBusqueda($parametros){
		
	
        $query = $this->db->select("	ins_ia_id,
										ins_c_rut,
										ins_c_razon_social,
										ins_c_nombre_fantasia,
										ins_c_nombre_direccion,
										ins_c_resto_direccion,
										ins_c_numero_direccion,
										ins_c_latitud,
										(select count(*) from maestro_ambitos where id_instalacion = ins_ia_id) as total_ambitos ") 
                          ->from("maestro_instalaciones");
        
		$query->whereAND("reg_ia_id" , $parametros['region']);
		
		if($parametros['comuna'] != 0){
			$query->whereAND("com_ia_id" , $parametros['comuna']);
		}	
		
		if(trim($parametros['calle']) != ""){
			$query->whereAND("ins_c_nombre_direccion" , "%".$parametros['calle']."%" , "like");
		}			

        fb($query->query());
		
        $resultado = $query->getResult();
		
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else{
            return false;
        }		
		
    }
    
    public function getDetalleInstalacion($idInstalacion){
		
		
	//Obtener datos generales
		
        $query = $this->db->select("*")
                          ->from("maestro_instalaciones")
						  ->whereAND("ins_ia_id" , $idInstalacion);
						  
        
	
        //fb($query->query());
		
		
		$salida = array();
		$salida['datos_generales'] = array();
		
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
			$salida['datos_generales'] = $resultado->rows->row_0;
        } else{
            return false;
        }		
		
	//Obtener detalle de ámbitos
		
        $query = $this->db->select("*")
                          ->from("maestro_ambitos")
						  ->whereAND("id_instalacion" , $idInstalacion);
						  
        
	
        //fb($query->query());
		
		
		$salida['ambitos'] = array();
		
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
			$salida['ambitos'] = $resultado->rows;
        } 			
		
	//Obtener detalle de expedientes
		
        $query = $this->db->select("*")
                          ->from("maestro_expedientes")
						  ->whereAND("id_instalacion" , $idInstalacion);
						  
        
	
        //fb($query->query());
		
		
		$salida['expedientes'] = array();
		
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
			$salida['expedientes'] = $resultado->rows;
        } 					
		
		return (object)$salida;
		
    }	
	
    /**
     * Busca un usuario por el rut
     * @param string $rut
     * @param array $not_in
     * @return array
     */
    public function getByCodigo($codigo){
        $query = $this->db->select("u.*")
                          ->from($this->_tabla . " u")
                          ->whereAND("u.codigo_cambiar_password" , $codigo);

        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        } else{
            return NULL;
        }
    }
    
    /**
     * Busca un usuario por el rut
     * @param string $rut
     * @param array $not_in
     * @return array
     */
    public function getByRut($rut, $not_in = array()){
        $query = $this->db->select("u.*")
                          ->from($this->_tabla . " u")
                          ->whereAND("u.rut" , $rut);
        
        if(count($not_in)>0){
            $query->whereAND("u.id", $not_in, "NOT IN");
        }
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        } else{
            return NULL;
        }
    }
	
    public function getAmbitosLocales($idInstalacion){
        $query = $this->db->select("id_ambito")
                          ->from("instalaciones_ambito_local")
                          ->whereAND("id_instalacion" , $idInstalacion);

        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows;
        } else{
            return (object) array();
        }
    }	
	
}

