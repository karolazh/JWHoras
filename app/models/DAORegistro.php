<?php

/* 
!IniHeaderDoc
*****************************************************************************
!NombreObjeto 		: DAORegistro.php
!Sistema 	  	: PREVENCIÓN
!Modulo 	  	: NA
!Descripcion  		: 	
!Plataforma   		: !PHP
!Perfil       		: 
!Itinerado    		: NA
!Uso          		: NA
!Autor        		: Carolina Zamora Hormazábal, Orlando Vázquez G.
!Creacion     		: 14/02/2017
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

class DAORegistro extends Model{
    /**
     * @var string 
     */
    protected $_tabla = "tab_registro";
    protected $_primaria = "registro_id";
    
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Lista Registro
     */
    public function getListaRegistro(){

        $query = "select "
                . "reg_id, "
                . "reg_rut "
                . "from tab_registro r "
                ;
        $resultado = $this->db->getQuery($query);

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
        public function getListaRegistroById($id_registro){

        $query = "select "
                . "date_format(r.reg_fec_ingreso,'%d-%m-%Y') as reg_fec_ingreso, "
                . "date_format(r.reg_hora_ingreso,'%H:%i:%s') as reg_hora_ingreso, "
                . "r.reg_motivo_consulta,"
                . "r.reg_historia_enfermedad, "
                . "r.reg_diagnostico, "
                . "r.reg_indicacion_medica "
                . "from tab_registro r "
                . "inner join tab_pacientes p on p.pac_id= r.reg_pac_id "
                . "where p.pac_id = ? "
                ;
        $resultado = $this->db->getQuery($query,array($id_registro));

        if($resultado->numRows>0){
            return $resultado->rows;
        }else{
            return NULL;
        }
    }
    
    /*
     * Ver Registro
     */
    public function getRegistro($id_registro){
        $query = "select * from tab_registro
                  where registro_id = ?";

        $consulta = $this->db->getQuery($query,array($id_registro));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    public function getRegistro1($rut_registro){
        $query = "select 
                    reg_id,
                    reg_nombres,
                    reg_apellidos,
                    date_format(reg_fec_nac,'%d-%m-%Y') as reg_fec_nac,
                    reg_prevision,
                    reg_convenio,
                    reg_direccion,
                    reg_fono,
                    reg_email,
                    reg_celular
                    from tab_registro 
                  where reg_rut = ?";

        $consulta = $this->db->getQuery($query,array($rut_registro));
        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}

?>