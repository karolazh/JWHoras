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
    protected $_tabla		= "tab_registro";
    protected $_primaria	= "registro_id";
    
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
                . "reg_rut, "
                . "reg_nombres, "
                . "reg_apellidos "
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
        $query	= "	SELECT 
						date_format(r.reg_fec_ingreso,'%d-%m-%Y') as reg_fec_ingreso,
						date_format(r.reg_hora_ingreso,'%H:%i:%s') as reg_hora_ingreso,
						r.reg_motivo_consulta,
						r.reg_historia_enfermedad,
						r.reg_diagnostico,
						r.reg_indicacion_medica
					FROM tab_registro r 
						INNER JOIN tab_pacientes p ON p.pac_id= r.reg_pac_id 
					WHERE p.pac_id = ? " ;
		
		$param		= array($id_registro);
        $resultado	= $this->db->getQuery($query,$param);

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
        $query = "select "
                . "reg_id, "
                . "reg_rut, "
                . "reg_extranjero, "
                . "reg_run_pass, "
                . "reg_nombres, "
                . "reg_apellidos, "
                . "date_format(reg_fec_nac,'%d-%m-%Y') as reg_fec_nac, "
                . "reg_sexo, "
                . "reg_id_prev, "
                . "reg_direccion, "
                . "reg_com_id, "
                . "reg_fono, "
                . "reg_celular, "
                . "reg_email, "
                . "reg_fec_act, "
                . "reg_latitud, "
                . "reg_longitud, "
                . "reg_reconoce, "
                . "reg_acepta_programa, "
                . "reg_adj_id_aut, "
                . "reg_seguimiento, "
                . "reg_est_cas_id, "
                . "reg_ins_id,"
                . "reg_usr_id_crea, "
                . "reg_fec_crea "
                . "from tab_registro "
                . "where reg_id = ?";


        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
    
    public function getRegistro1($rut_registro){

        $query	= "SELECT "
                . "reg_id,reg_nombres,"
                . "reg_apellidos,"
                . "date_format(reg_fec_nac,'%d-%m-%Y') as reg_fec_nac,"
                . "reg_prevision,"
                . "reg_convenio,"
                . "reg_direccion,reg_fono, "
                . "reg_email,"
                . "reg_celular"
                . "FROM tab_registro WHERE reg_rut = ?";

		$param		= array($rut_registro);
        $consulta	= $this->db->getQuery($query,$param);


        if($consulta->numRows > 0){
            return $consulta->rows->row_0;
        }else{
            return null;
        }
    }
}

?>