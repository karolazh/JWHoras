<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_perfil
* Plataforma	: !PHP
* Creacion		: 06/05/2017
* @name			DAOPerfil.php
* @version		1.0
* @author		Orlando Vazquez <orlando.vazquez@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOPerfil extends Model {

    protected $_tabla			= "pre_perfil";
    protected $_primaria		= "id_perfil";
    protected $_transaccional	= false;

    function __construct(){
        parent::__construct();       
    }

	/**
	* getLista()
	* Obtiene toda la informacion de la tabla
	* 
	* @author	<orlando.vazquez@cosof.cl>	06-03-2017
	* 
	*
	* @return object Informacion de toda la tabla
	*/
    public function getLista(){
        $query	= "	SELECT * FROM ".$this->_tabla;
        $result	= $this->db->getQuery($query);

        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }
	/**
	* getById()
	* Obtiene informacion del perfil por id
	* 
	* @author	<orlando.vazquez@cosof.cl>	06-03-2017
	* 
	* @param	int		$id_perfil
	*
	* @return	object	Informacion del perfil por id
	*/
    public function getById($id_perfil){
        $query	= "	SELECT * FROM ".$this->_tabla."
					WHERE ".$this->_primaria." = ?";

		$param	= array($id_perfil);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return null;
        }
    }

}

?>