<?php
	class DAOPrioridad extends Model{

		protected $_tabla = "prioridad";

		function __construct(){
        	parent::__construct();
    	}

	    public function queryBusquedaPrioridad($parametros){
	        $query = $this->db->select("date_format(pr.fc_fecha_creacion,'%d-%m-%Y')as fc_fecha_creacion ,pr.id,pr.gl_descripcion")
	                          ->from($this->_tabla . " pr ");
	                
	        if(!empty($parametros["fc_fecha_creacion"])){
	            $query->whereAND("pr.fc_fecha_creacion" , "%" . $parametros["fc_fecha_creacion"] . "%", "LIKE");
	        }

	        if(!empty($parametros["gl_descripcion"])){
	            $query->whereAND("pr.gl_descripcion" , "%" . $parametros["gl_descripcion"] . "%", "LIKE");
	        }
	               
	       
	        fb($query->query());
	        return $query;
	    }

	    public function prioridadEditar($idPrioridad){
	    	$query=$this->db->select('*')
	    		 ->from('prioridad')
	    		 ->whereAND('id',$idPrioridad);
	    	$resultado = $query->getResult();
	    	if($resultado->numRows > 0){
            	return $resultado->rows;
        	}
        	else{
            	return NULL;
        	}
	    }

	    public function getPrioridadById($id_prioridad){
	        $query = "select id,gl_descripcion,nr_estado,date_format(fc_fecha_creacion,'%d-%m-%Y') as fc_fecha_creacion from prioridad where id= $id_prioridad";
	        $consulta = $this->db->getQuery($query,array($id_prioridad));

	        if ($consulta->numRows > 0) {
	            return $consulta->rows->row_0;
	        } else {
	            return null;
	        }
	    } 

	    public function insPrioridad($datos){
	        extract($datos);
	        $query = "insert into prioridad values(null,?,1,?)";
	        $parametros = array(//son lols nombres de los campos de texto de la vista
	            $nombre_prioridad,
	            $fecha,
	            //$estado,
	            
	        );

	        if ($this->db->execQuery($query, $parametros)) {
	            return $this->db->lastInsertId();

	        } else {
	            return null;
	        }
	    }
	}
?>