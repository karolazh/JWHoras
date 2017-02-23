<?php


class DAOVisadores extends Model {

    function __construct()
    {
        parent::__construct();
    }


    public function getVisadoresPorCentro($centro){
        $query = "select * from visadores 
            left join usuario on id = id_usuario_visador 
            left join centro_responsabilidad on codigo_centroresponsabilidad = cod_cr_visador 
            where cod_cr_visador = ? ";

        $consulta = $this->db->getQuery($query,array($centro));

        return $consulta;
    }


}