<?php
	class DAOProyecto extends Model{

		protected $_tabla = "proyecto";

		function __construct(){
        	parent::__construct();
    	}

	    public function queryBusquedaProyecto($parametros){
	        $query = $this->db->select("proy.*")
	                          ->from($this->_tabla . " proy ");
	                
	        if(!empty($parametros["gl_nombre_proyecto"])){
	            $query->whereAND("proy.gl_nombre_proyecto" , "%" . $parametros["gl_nombre_proyecto"] . "%", "LIKE");
	        }

	        if(!empty($parametros["gl_descripcion_proyecto"])){
	            $query->whereAND("proy.gl_descripcion_proyecto" , "%" . $parametros["gl_descripcion_proyecto"] . "%", "LIKE");
	        }

	        if(!empty($parametros["gl_cliente"])){
	            $query->whereAND("proy.gl_cliente" , "%" . $parametros["gl_cliente"] . "%", "LIKE");
	        }

	               
	       
	        fb($query->query());
	        return $query;
	    }

	    public function insProyecto($datos){
	        extract($datos);
	        $query = "insert into proyecto values(null,?,?,1,?)";
	        $parametros = array(//son lols nombres de los campos de texto de la vista
	            $nombre_proyecto,
	            $descripcion,
	            $cliente,
	            //$estado
	            
	        );

	        if ($this->db->execQuery($query, $parametros)) {
	            return $this->db->lastInsertId();

	        } else {
	            return null;
	        }
	    }

	    public function getProyectoById($id_proyecto){
	        $query = "select * from proyecto where id_proyecto= $id_proyecto ";
	        $consulta = $this->db->getQuery($query,array($id_proyecto));

	        if ($consulta->numRows > 0) {
	            return $consulta->rows->row_0;
	        } else {
	            return null;
	        }
	    }  
	}
?>