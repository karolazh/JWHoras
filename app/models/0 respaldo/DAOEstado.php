<?php
	class DAOEstado extends Model{

		protected $_tabla = "tipo_estado";

		function __construct(){
        	parent::__construct();
    	}

		public function queryBusquedaEstado($parametros){
	        $query = $this->db->select("e.id_estado,gl_descripcion,date_format(fc_fecha_creacion,'%d-%m-%Y') as fc_fecha_creacion,gl_descripcion_estado")
	                          ->from($this->_tabla . " e ");
	                
	        if(!empty($parametros["gl_descripcion"])){
	            $query->whereAND("e.gl_descripcion" , "%" . $parametros["gl_descripcion"] . "%", "LIKE");
	        }

	        if(!empty($parametros["gl_descripcion_estado"])){
	            $query->whereAND("e.gl_descripcion_estado" , "%" . $parametros["gl_descripcion_estado"] . "%", "LIKE");
	        }

	          if(!empty($parametros["fc_fecha_creacion"])){
	            $query->whereAND("e.fc_fecha_creacion" , "%" . $parametros["fc_fecha_creacion"] . "%", "LIKE");
	        }
	               
	        fb($query->query());
	        return $query;
	    }

	    public function insEstado($datos){
	    	extract($datos);
	        $query = "insert into tipo_estado values(null,?,1,?,?)";
	        $parametros = array(//son lols nombres de los campos de texto de la vista
	            $nombre_estado,
	            $fecha,
	            $descripcion,
	            //$estado,
	            
	        );

	        if ($this->db->execQuery($query, $parametros)) {
	            return $this->db->lastInsertId();

	        } 
	        else {
	            return null;
	        }
	    }

	    public function getEstadoById($id_estado){
	        $query = "select id_estado,gl_descripcion,nr_estado,date_format(fc_fecha_creacion,'%d-%m-%Y')as fc_fecha_creacion,gl_descripcion_estado from tipo_estado where id_estado= $id_estado ";
	        $consulta = $this->db->getQuery($query,array($id_estado));

	        if ($consulta->numRows > 0) {
	            return $consulta->rows->row_0;
	        } else {
	            return null;
	        }
	    }  
	}

?>