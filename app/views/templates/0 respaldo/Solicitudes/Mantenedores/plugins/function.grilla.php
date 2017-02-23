<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_grilla($params, &$smarty) {
    
    $grid = New View_Grid("lista_solicitudes");
    $grid->setModel("DAOSolicitudes");
    $grid->addHelperPath(__DIR__, "");
    $grid->setQuery("queryBusquedaTicket", array("id_ticket" => "id_ticket",
                                           "nombre" => "nombre",
                                           "gl_comentario" => "gl_comentario",
                                           "fc_fecha_creacion" => "fc_fecha_creacion",
                                           "cd_id_proyecto" => "cd_id_proyecto",
                                           "gl_nombre_proyecto" => "gl_nombre_proyecto"), 
                                   array());

    //coloca los nombres de la cabecera de la tabla y permite ordenar los registros
    $grid->setColumns(array(
            array("column_name" => "ID",
                "column_table"  => array("id_ticket"),
                "column_type"   => "method",
                "sortable"      => array("active"         => true,
                                         "sortable_field" => "t.id_ticket"),
                "width" => "5%"),
            array("column_name" => "Proyecto",
                "column_table"  => array("gl_nombre_proyecto"),
                "column_type"   => "method",
                "sortable"      => array("active"         => true,
                                         "sortable_field" => "p.gl_nombre_proyecto"),
                "width" => "5%"),
            array("column_name" => "Nombre",
                "column_table"  => array("nombre"),
                "column_type"   => "method",
                "sortable"      => array("active"         => true,
                                         "sortable_field" => "t.nombre"),
                "width" => "20%"),
            array("column_name" => "Comentario",
                "column_table" => array("gl_comentario"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "t.gl_comentario"),
                "width" => "20%"),
             array("column_name" => "Fecha Creacion",
                "column_table" => array("fc_fecha_creacion"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "t.fc_fecha_creacion"),
                "width" => "20%"),
            array("column_name" => "",
                "column_table" => array("id_ticket"),
                "column_type" => "html",
                "column_html" => "<button data-toggle=\"tooltip\" type=\"button\" onclick=\"location.href='".BASE_URI."/MantenedorSolicitudes/editar/%';\" class=\"btn btn-sm btn-flat btn-success\" title=\"Ver Detalle\">"
                                ."<i class=\"fa fa-edit\"></i> Actualizar"
                                ."</button>",
                "column_align" => "center",
                "sortable" => false,
                "width" => "5%")     
        ));
    
    return $grid->getGrid();
}