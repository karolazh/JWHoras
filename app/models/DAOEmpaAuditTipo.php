<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Modelo para Tabla pre_empa_audit_tipo
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 03/03/2017
 * 
 * @name             DAOEmpaAuditTipo.php
 * 
 * @version          1.0
 *
 * @author           Orlando Vazquez <orlando.vazquez@cosof.cl>
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
class DAOEmpaAuditTipo extends Model{

    protected $_tabla			= "pre_empa_audit_tipo";
    protected $_primaria		= "id_audit_tipo";
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
	 * Descripción : Obtiene Tipo Audit
	 * @author  S/N
     * @param   int $audit
	 */
    public function getTipoAUDIT($audit){
        $query	= "	SELECT * 
					FROM ".$this->_tabla."
					WHERE ? BETWEEN nr_min AND nr_max";

		$param	= array($audit);
		$result = $this->db->getQuery($query,$param);

        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return NULL;
        }
    }

}

?>