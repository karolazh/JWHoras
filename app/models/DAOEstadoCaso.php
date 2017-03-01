<?php

class DAOEstadoCaso extends Model{
    /**
     * @var string 
     */
    protected $_tabla		= "pre_estados_caso";
    protected $_primaria	= "id_estado_caso";

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Casos de Egreso
     */
    public function getListaEstadoCaso(){
        $query		= "SELECT * FROM ".$this->_tabla;
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    /*
     * Ver Caso de Egreso
     */
    public function getEstadoCaso($id_estado_caso){
        $query		= "	SELECT * FROM ".$this->_tabla. " 
						where ".$this->_primaria." = ?";

        $consulta	= $this->db->getQuery($query,array($id_estado_caso));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }

}