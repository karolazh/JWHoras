<?php

/**
*****************************************************************************
* Sistema           : PREVENCION DE FEMICIDIOS
* Descripcion       : Modelo para Tabla pre_laboratorio
* Plataforma        : !PHP
* Creacion          : 13/03/2017
* @name             DAOLaboratorio.php
* @version          1.0
* @author           Carolina Zamora H. <carolina.zamora@cosof.cl>
*=============================================================================
*!ControlCambio
*--------------
*!cProgramador				!cFecha		!cDescripcion 
*-----------------------------------------------------------------------------
*
*-----------------------------------------------------------------------------
*****************************************************************************
*/

class DAOLaboratorio extends Model{

    protected $_tabla           = "pre_laboratorio";
    protected $_primaria		= "id_laboratorio";
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
	 * Descripción : Obtiene Laboratorios por Centro de Salud
	 * @author  Carolina Zamora <carolina.zamora@cosof.cl>
     * @param   int $id_centro
	 */
    public function getByIdCentroSalud($id_centro){
        $query = "  SELECT  lab.id_laboratorio,
                            lab.gl_nombre_laboratorio,
                            labCS.id_centro_salud
                    FROM pre_laboratorio lab
                    INNER JOIN pre_laboratorio_centro_salud labCS 
							ON (labCS.id_laboratorio = lab.id_laboratorio
                           AND labCS.id_centro_salud = ?)";

        $param	= array($id_centro);
        $result	= $this->db->getQuery($query, $param);

        if ($result->numRows > 0) {
            return $result->rows;
        } else {
            return NULL;
        }
    }
}

?>