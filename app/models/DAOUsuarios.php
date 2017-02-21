<?php

class DAOUsuarios extends Model{

    /**
     *
     * @var string 
     */
    //protected $_tabla = "usuario";
    protected $_tabla = "pre_usuarios";
    protected $_primaria = "id_usuario";
    
    
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();       
    }
    
    /**
     * Busca un usuario por email
     * @param string $mail
     * @param array $not_in
     * @return array
     */
    public function getByMail($mail, $not_in = array()){

        $query = $this->db->select("u.*")
                          ->from($this->_tabla." u")
                          ->whereAND("u.gl_email" , $mail);
        
        if(count($not_in)>0){
            $query->whereAND("u.".$this->_primaria, $not_in, "NOT IN");
        }
        
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
                          ->from($this->_tabla." u")
                          ->whereAND("u.gl_rut" , $rut);
        
        if(count($not_in)>0){
            $query->whereAND("u.".$this->_primaria, $not_in, "NOT IN");
        }
        
        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        } else{
            return NULL;
        }
    }
    
     /*
     * 20170201 - Setea Password de Usuario
     */
    public function setUltimoLogin($datos){
        $query = "UPDATE ".$this->_tabla."
                  SET    fc_ultimo_login = ?
                  WHERE  ".$this->_primaria." = ? ";

        if ($this->db->execQuery($query, $datos)) {
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * 20170201 - Setea Password de Usuario
     */
    public function setPassword($datos){
        $query = "UPDATE ".$this->_tabla."
                  SET    gl_password = ? , fc_ultimo_login = ?
                  WHERE  ".$this->_primaria." = ? ";
/*
        $parametros = array(
            $password,
            $ultimo_login,
            $id_usuario
        );
*/
        if ($this->db->execQuery($query, $datos)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @param array $parametros
     * @return array
     */
    /*
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
    */
    
    /**
     * 
     * @param array $parametros
     * @return Database
     */
    /*
    public function queryBusqueda($parametros){

        $query = $this->db->select("u.*")
                          ->from($this->_tabla . " u ");
        
        if(!empty($parametros["rut"])){
            $query->whereAND("u.rut" , "%" . $parametros["rut"] . "%", "LIKE");
        }
        
        if(!empty($parametros["nombre"])){
            $query->whereAND("u.nombres" , "%" . $parametros["nombre"] . "%", "LIKE");
        }
        
        if(!empty($parametros["apellido"])){
            $query->whereAND("u.apellidos" , "%" . $parametros["apellido"] . "%", "LIKE");
        }
        
        if(!empty($parametros["email"])){
            $query->whereAND("u.email" , "%" . $parametros["email"] . "%", "LIKE");
        }
        
	//if(!empty($parametros["letra"])){
        //    $query->whereAND("u.nombres" , $parametros["letra"] . "%", "LIKE");
        //}
        
        if(!empty($parametros["region"])){
            $query->whereAND("u.id_region" , $parametros["region"], "=");
        }
        
        if(!empty($parametros["oficinas"])){
            if(count($parametros["oficinas"])>0){
                $query2 = New Database();

                $query2->select("s.id_usuario")
                       ->from("usuario_oficina s")
                       ->whereAND("s.id_oficina",$parametros["oficinas"] , "IN");

                $usuarios = array();
                $resultado = $query2->getResult();
                if($resultado->numRows>0){
                    foreach($resultado->rows as $item){
                        $usuarios[] = $item->id_usuario;
                    }
                }

                if(count($usuarios)>0){
                    $query->whereAND("u.id", $usuarios, "IN");
                }
            }
        }
        
        if(!empty($parametros["sistemas"])){
            if(count($parametros["sistemas"])>0){
                $query2 = New Database();

                $query2->select("s.id_usuario")
                       ->from("usuario_sistema s")
                       ->whereAND("s.id_sistema",$parametros["sistemas"] , "IN");

                $usuarios = array();
                $resultado = $query2->getResult();
                if($resultado->numRows>0){
                    foreach($resultado->rows as $item){
                        $usuarios[] = $item->id_usuario;
                    }
                }

                if(count($usuarios)>0){
                    $query->whereAND("u.id", $usuarios, "IN");
                }
            }
        }
        fb($query->query());
        return $query;
    }
    */
    
    /**
     * Busca un usuario por el rut
     * @param string $rut
     * @param array $not_in
     * @return array
     */
    /*
    public function getByCodigo($codigo){
        $query = $this->db->select("u.*")
                          ->from("usuario u")
                          ->whereAND("u.codigo_cambiar_password" , $codigo);

        $resultado = $query->getResult();
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        } else{
            return NULL;
        }
    }
    */
    
    /*
    public function getUsuariosPorPerfil($id_perfil){
        $query = "select * from ".$this->_tabla." where id_perfil = ? order by nombres,apellidos ASC ";
        $consulta = $this->db->getQuery($query,array($id_perfil));

        return $consulta->rows;
    }
    */

    /*
    public function getUsuarioPorId($id_usuario){
        $query = "select rut, nombres, apellidos, email from usuario where id = ? limit 1";
        $consulta = $this->db->getQuery($query,array($id_usuario));

        if ($consulta->numRows > 0) {
            return $consulta->rows->row_0;
        } else {
            return null;
        }
    }
    */
}