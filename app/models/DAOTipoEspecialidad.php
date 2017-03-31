<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Modelo para Tabla pre_tipo_especialidad
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 09/03/2017
 * 
 * @name             DAOTipoEspecialidad.php
 * 
 * @version          1.0
 *
 * @author           Victor Retamal <victor.retamal@cosof.cl>
 * 
 ******************************************************************************
 * !ControlCambio
 * --------------
 * !cProgramador				!cFecha		!cDescripcion 
 * ----------------------------------------------------------------------------
 * 
 * ----------------------------------------------------------------------------
 * ****************************************************************************
 */
class DAOTipoEspecialidad extends Model{

    protected $_tabla			= "pre_tipo_especialidad";
    protected $_primaria		= "id_tipo_especialidad";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getLista(){
        $query	= "	SELECT * FROM ".$this->_tabla;
        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query	= "	SELECT * FROM ".$this->_tabla."
					WHERE ".$this->_primaria." = ?";

		$param	= array($id);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

    public function getByMostrar(){
        $query	= " SELECT 
						esp.*
					FROM pre_tipo_especialidad esp
					WHERE esp.bo_mostrar = 1";

        $result	= $this->db->getQuery($query);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

}

?>