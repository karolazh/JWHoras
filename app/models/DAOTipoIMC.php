<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_tipo_imc
* Plataforma        : !PHP
* Creacion          : 03/03/2017
* @name             DAOTipoIMC.php
* @version          1.0
* @author           David Gusmán <david.guzman@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOTipoIMC extends Model{

    protected $_tabla			= "pre_tipo_imc";
    protected $_primaria		= "id_tipo_imc";
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

    /**
	 * Descripción : Obtiene tipo de IMC
     * @author  S/N
     * @param   int $imc
	 */
    public function getTipoIMC($imc){
        $query	= "	SELECT  * 
					FROM pre_tipo_imc
					WHERE ? BETWEEN nr_min AND nr_max";

		$param	= array($imc);
		$result = $this->db->getQuery($query,array($imc));

        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

}

?>