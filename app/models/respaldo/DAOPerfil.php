<?php

class DAOPerfil extends Model{

    const ADMINSTRADOR = 1;
    const USUARIO      = 2;
    
    /**
     *
     * @var string 
     */
    protected $_tabla = "perfil";
    
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }

     public function queryBusquedaPerfil($parametros){
        $query = $this->db->select("p.*")
                          ->from($this->_tabla . " p ");
                
        if(!empty($parametros["nombre"])){
            $query->whereAND("p.nombre" , "%" . $parametros["nombre"] . "%", "LIKE");
        }

        if(!empty($parametros["gl_descripcion"])){
            $query->whereAND("p.gl_descripcion" , "%" . $parametros["gl_descripcion"] . "%", "LIKE");
        }
               
       
        fb($query->query());
        return $query;
    }

     //creada  por BC
        public function insPerfil($datos){
            extract($datos);
            $query = "insert into perfil values(null,?,?,?,1)";
            $parametros = array(//son lols nombres de los campos de texto de la vista
                $nombre_perfil,
                $descripcion,
                $fecha,
                //$estado,
                
            );

            if ($this->db->execQuery($query, $parametros)) {
                return $this->db->lastInsertId();

            } 
            else {
                return null;
            }
        }
    // fin creada por BC

        public function getPerfilById($id_perfil){
            $query = "select * from perfil where id=$id_perfil";
            $consulta = $this->db->getQuery($query,array($id_perfil));

            if ($consulta->numRows > 0) {
                return $consulta->rows->row_0;
            } else {
                return null;
            }
        }  

}

