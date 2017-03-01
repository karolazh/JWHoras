<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAOEstablecimientoSalud.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Victor Retamal <victor.retamal@cosof.cl>
!Creacion     		: 01/03/2017
!Retornos/Salidas 	: NA
!OrigenReq        	: NA
=============================================================================
!Parametros 		: NA 
=============================================================================
!Testing 		: NA
=============================================================================
!ControlCambio
--------------
!cVersion !cFecha   !cProgramador   !cDescripcion 
-----------------------------------------------------------------------------

-----------------------------------------------------------------------------
*****************************************************************************
!EndHeaderDoc 
*/

class DAOEstablecimientoSalud extends Model{

    protected $_tabla           = "pre_establecimientos_salud";
    protected $_primaria		= "id_establecimiento";
    protected $_transaccional	= false;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    public function getLista(){
        $query		= "SELECT * FROM ".$this->_tabla;
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
						
		$params		= array($id);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getEstablecimientoxIdServicio($id_servicio_salud){
        $query		= "	SELECT * FROM ".$this->_tabla."
						WHERE id_servicio_salud = ?";
						
		$params		= array($id_servicio_salud);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getEstablecimientoxRegion($id_region) {
        $query		= "	SELECT 
							e.gl_nombre_establecimiento, 
							e.id_establecimiento 
						FROM pre_establecimientos_salud e
						WHERE e.id_region = ?";

		$params		= array($id_region);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

    public function getEstablecimientoxComuna($id_comuna) {
        $query		= "	SELECT 
							e.gl_nombre_establecimiento, 
							e.id_establecimiento 
						FROM pre_establecimientos_salud e
						WHERE e.id_comuna = ?";

		$params		= array($id_comuna);
        $resultado	= $this->db->getQuery($query, $params);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }

}

?>