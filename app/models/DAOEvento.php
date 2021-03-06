<?php
/**
 ******************************************************************************
 * Sistema           : PREVENCION DE FEMICIDIOS
 * 
 * Descripcion       : Helper de Eventos
 *
 * Plataforma        : !PHP
 * 
 * Creacion          : 24/02/2017
 * 
 * @name             DAOEvento.php
 * 
 * @version          1.0
 *
 * @author           Orlando Vázquez <orlando.vazquez@cosof.cl>
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
class DAOEvento extends Model{

    protected $_tabla           = "pre_evento";
    protected $_primaria		= "id_evento";
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
	 * Descripción : Busqueda de Eventos
	 * @author  S/N
     * @param   array  $parametros
	 */
    public function selBusquedaEventos($parametros){
		$query = "  SELECT
						e.id_evento, 
						e.gl_descripcion,
						e.id_evento_tipo,
						date_format(e.fc_crea,'%d-%m-%Y') as fc_crea,
						e.id_paciente
					FROM pre_evento e
					WHERE 1 ";

		if(!empty($parametros["gl_descripcion"])){
			$query	.= " AND e.gl_descripcion LIKE %" . $parametros["gl_descripcion"] . "%";
		}
		if(!empty($parametros["id_evento_tipo"])){
			$query	.= " AND e.id_evento_tipo = " . $parametros["id_evento_tipo"];
		}
		if(!empty($parametros["id_paciente"])){
			$query	.= " AND e.id_paciente = " . $parametros["id_paciente"];
		}

		$result	= $this->db->getQuery($query);

		if($result->numRows>0){
			return $result->rows;
		}else{
			return NULL;
		}
    }

    /**
	 * Descripción : Inserta Evento
	 * @author  S/N
     * @param   array  $data
	 */
    public function insEvento($data){
		$query 	= "INSERT into pre_evento values(null,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)";

		$param	= array(
						$data['eventos_tipo'],
						$data['id_paciente'],
						$data['id_empa'],
						$data['gl_descripcion'],
						$data['bo_estado'],
						$data['bo_mostrar'],
						$data['id_usuario_crea']
					);

		if($this->db->execQuery($query, $param)) {
			return $this->db->getLastId();
		}else{
			return FALSE;
		}
	}

    /**
	 * Descripción : Actualiza Tipo de Evento
	 * @author  S/N
     * @param   array  $datos
	 */
    public function updTipoEvento($datos){
		$query	= "	UPDATE ".$this->_tabla."
					SET    id_evento_tipo = ?
					WHERE  " . $this->_primaria . " = ? ";

		$param	= array($datos['id_evento_tipo'], $datos['id_evento']);

		if($this->db->execQuery($query, $param)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

    /**
	 * Descripción : Actualiza descripción de Evento
	 * @author  S/N
     * @param   array  $datos
	 */
    public function updDescripcion($datos){
		$query	= "	UPDATE ".$this->_tabla."
                    SET    gl_descripcion = ?
                    WHERE  " . $this->_primaria . " = ? ";

        $param	= array($datos['gl_descripcion'], $datos['id_evento']);

		if($this->db->execQuery($query, $param)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

    /**
	 * Descripción : Obtiene Eventos por Paciente
	 * @author  Carolina Zamora <carolina.zamora@cosof.cl>
     * @param   int $id_paciente
	 */
    public function getEventosPaciente($id_paciente){
        $query = "  SELECT
                        eve.id_evento, 
                        eve.id_evento_tipo, 
                        tip.gl_nombre_evento_tipo,
                        eve.id_paciente,
                        eve.gl_descripcion,
                        date_format(eve.fc_crea,'%d-%m-%Y') AS fc_crea,
                        usr.gl_rut,
                        concat_ws(' ' , usr.gl_nombres, usr.gl_apellidos) AS funcionario
                    FROM pre_evento eve
                    LEFT JOIN pre_evento_tipo tip ON tip.id_evento_tipo = eve.id_evento_tipo
                    LEFT JOIN pre_usuario usr ON usr.id_usuario = eve.id_usuario_crea
                    WHERE eve.id_paciente = ?
					AND bo_mostrar = 1";

        $param	= array($id_paciente);
        $result	= $this->db->getQuery($query,$param);
        
        if($result->numRows>0){
            return $result->rows;
        }else{
            return NULL;
        }
    }

    /**
	 * Descripción : Actualiza Eventos, actualiza estado a "0"
	 * @author  S/N
     * @param   int $id_evento_tipo
	 */
	public function ocultarEventos($id_evento_tipo){
		$query = "  UPDATE pre_evento 
                    SET bo_mostrar			= 0,
						id_usuario_crea		= ".$_SESSION['id'].",
						fc_crea				= now()
					WHERE id_evento_tipo	= ".$id_evento_tipo;

        if($this->db->execQuery($query)) {
			return TRUE;
        }else{
			return FALSE;
        }
	}

}