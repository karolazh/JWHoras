<?php


class DAOProveedores extends Model {

    function __construct()
    {
        parent::__construct();
    }


    public function getEmisorRut($rut){
        $rut = $rut.'%';
        $query = 'select * from proveedores where gl_rut_proveedor like ? ';
        $consulta = $this->db->getQuery($query,array($rut));

        return $consulta->rows;
    }


    public function guardarProveedor($datos){
        $query = "insert into proveedores(gl_rut_proveedor,gl_nombre_proveedor,cd_vigencia_proveedor, gl_categoria_proveedor) values(?,?,?,?)";
        $parametros = array($datos['rut'],$datos['nombre'],$datos['vigencia'],$datos['categoria']);
        if($this->db->execQuery($query,$parametros)){
            return true;
        }else{
            return false;
        }
    }


    public function getProveedorPorRut($rut){
        $query = "select * from proveedores where gl_rut_proveedor = ? limit 1";
        $consulta = $this->db->getQuery($query,array(trim($rut)));

        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}