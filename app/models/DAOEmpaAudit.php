<?php

/**
*****************************************************************************
* Sistema		: PREVENCION DE FEMICIDIOS
* Descripcion	: Modelo para Tabla pre_empa_audit
* Plataforma	: !PHP
* Creacion		: 27/02/2017
* @name			DAOEmpaAudit.php
* @version		1.0
* @author		Orlando Vázquez <orlando.vazquez@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOEmpaAudit extends Model{

    protected $_tabla           = "pre_empa_audit";
    protected $_primaria		= "id_audit";
    protected $_transaccional	= false;

    function __construct()
    {
        parent::__construct();
    }

    public function getLista(){
        $query		= "	SELECT * FROM ".$this->_tabla;
        $resultado	= $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getById($id){
        $query		= "	SELECT * FROM ".$this->_tabla."
						WHERE ".$this->_primaria." = ?";

		$param		= array($id);
        $resultado	= $this->db->getQuery($query,$param);
		
        if($resultado->numRows > 0){
            return $resultado->rows->row_0;
        }else{
            return null;
        }
    }

    public function getByIdEmpa($id_empa){
        $query		= "	SELECT 
							id_audit,
							id_empa,
							id_pregunta,
							nr_valor
						FROM pre_empa_audit 
						WHERE id_empa = ".$id_empa;

		$param		= array($id_empa);
        $resultado	= $this->db->getQuery($query,$param);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
	public function updateEmpaAudit( $id_empa, $id_pregunta, $valor){

        $query	= "	UPDATE pre_empa_audit SET
						 nr_valor	=	".$valor."
                        WHERE id_empa   = ".$id_empa." AND id_pregunta = ".$id_pregunta."";
                  
        if ($this->db->execQuery($query)) {
            return true;
        } else {
            return false;
        }
    }

}

?>