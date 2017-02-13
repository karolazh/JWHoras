<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_grilla($params, &$smarty) {
    $grid = New View_Grid("lista_pendientes");
    $grid->setModel("DAOSolicitudes");
    $grid->addHelperPath(__DIR__, "");
    $grid->setQuery("queryBusquedaPendientes", array(
                                           "nombre" => "nombre",
                                           "gl_comentario" => "gl_comentario",
                                           "fc_fecha_creacion"=>"fc_fecha_creacion", 
                                           "fc_plazo"=>"fc_plazo",
                                           "nombres"=>"nombres"), 
                                   array());
    //coloca los nombres de la cabecera de la tabla y permite ordenar los registros
    $grid->setColumns(array(
            array("column_name" => "Nombre",
                "column_table" => array("nombre"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "t.nombre"),
                "width" => "20%"),
           array("column_name" => "Comentario",
                "column_table" => array("gl_comentario"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "t.gl_comentario"),
                "width" => "20%"),
            
            array("column_name" => "Fecha creación",
                "column_table" => array("fc_fecha_creacion"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "t.fc_fecha_creacion"),
                "width" => "20%"),

            array("column_name" => "Plazo",
                "column_table" => array("fc_plazo"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "t.fc_plazo"),
                "width" => "20%"),

            array("column_name" => "Asignado a",
                "column_table" => array("nombres"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "t.nombres"),
                "width" => "30%"),
        ));
    
    return $grid->getGrid();
}