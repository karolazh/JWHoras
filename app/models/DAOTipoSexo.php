<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Modelo para Tabla pre_tipo_sexo
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 08/03/2017
 * 
 * @name             DAOTipoSexo.php
 * 
 * @version          1.0
 *
 * @author           David Guzmán <david.guzman@cosof.cl>
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
class DAOTipoSexo extends Model{

    protected $_tabla			= "pre_tipo_sexo";
    protected $_primaria		= "id_tipo_sexo";
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

}

?>