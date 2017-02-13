<?php

class DAOHistorico extends Model {

    protected $_tabla = "historico_tickets";

    function __construct()
    {
        parent::__construct();
    }

    public function insHistorico($datos){
       extract($datos);
       $query = "insert into historico_tickets values(null,?,?,?,?)";
       $parametros = array(//son lols nombres de los campos de texto de la vista
           $cd_id_solicitud,
           $cd_id_estado,
           $cd_id_usuario,
           $fc_fecha_creacion,
       );

       if ($this->db->execQuery($query, $parametros)) {
           return $this->db->lastInsertId();

       } else {
           return null;
       }
   }

}