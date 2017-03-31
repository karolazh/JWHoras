<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Modelo para Tabla pre_perfil_opcion
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 06/03/2017
 * 
 * @name             DAOPerfilOpcion.php
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
class DAOPerfilOpcion extends Model {

    protected $_tabla			= "pre_perfil_opcion";
    protected $_primaria_1		= "id_perfil";
	protected $_primaria_2		= "id_opcion";
    protected $_transaccional	= false;

    function __construct(){
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
	
	public function getById($id_perfil){
        $query	= "	SELECT * FROM ".$this->_tabla."
					WHERE ".$this->_primaria_1." = ?";

		$param	= array($id_perfil);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return null;
        }
    }
	
    /**
	 * Descripción : Obtiene Opciones Raiz
     * @author  S/N
     * @param   int $id_perfil
	 */
	public function getOpcionesRaiz($id_perfil){
        $query = "  SELECT 
						o.id_opcion AS id_opcion, 
						id_opcion_padre, 
						bo_tiene_hijo, 
						gl_nombre_opcion, 
						gl_icono, 
						gl_url
					FROM pre_perfil_opcion po
					LEFT JOIN pre_opcion o  ON po.id_opcion = o.id_opcion
					WHERE id_perfil = ? AND bo_activo = 1 AND id_opcion_padre = 0";

		$param	= array($id_perfil);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return null;
        }
    }
	
    /**
	 * Descripción : Obtiene Opciones Compuestas
     * @author  S/N
     * @param   int $id_perfil
     * @param   int $id_opcion
	 */
    public function getByIdCompuesta($id_perfil, $id_opcion){
        $query	= "	SELECT * FROM ".$this->_tabla."
					WHERE ".$this->_primaria_1." = ? AND ".$this->_primaria_2." = ? " ;

		$param	= array($id_perfil,$id_opcion);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows->row_0;
        }else{
            return null;
        }
    }
    
    /**
	 * Descripción : Obtiene Sub-Opciones
     * @author  S/N
     * @param   int $id_perfil
	 */
	public function getSubOpciones($id_perfil){
        $query	= "	SELECT 
						o.id_opcion AS id_opcion, 
						id_opcion_padre, 
						bo_tiene_hijo, 
						gl_nombre_opcion, 
						gl_icono, 
						gl_url
					FROM pre_perfil_opcion po
					LEFT JOIN pre_opcion o  ON po.id_opcion = o.id_opcion
					WHERE id_perfil = ? AND bo_activo = 1 AND id_opcion_padre != 0"
					;

		$param	= array($id_perfil);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return null;
        }
    }

    /**
	 * Descripción : Obtiene Menú-Perfil por Id
     * @author  S/N
     * @param   int $id_perfil
	 */
	public function getAllMenuPerfilPorID($id_perfil){
        $query	= "	SELECT 
						o.id_opcion AS id_opcion, 
						id_opcion_padre, 
						bo_tiene_hijo, 
						gl_nombre_opcion, 
						gl_icono, 
						gl_url
					FROM pre_perfil_opcion po
					LEFT JOIN pre_opcion o  ON po.id_opcion = o.id_opcion
					WHERE id_perfil = ? AND bo_activo = 1"
					;

		$param	= array($id_perfil);
        $result	= $this->db->getQuery($query,$param);
		
        if($result->numRows > 0){
            return $result->rows;
        }else{
            return null;
        }
    }
	
}

?>