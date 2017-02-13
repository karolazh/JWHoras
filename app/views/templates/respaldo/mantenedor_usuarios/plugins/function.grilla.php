<?php

require_once(APP_PATH . "libs/Helpers/View/Grid.php");

/**
 * 
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */
function smarty_function_grilla($params, &$smarty) {
    $grid = New View_Grid("lista_usuarios");
    $grid->setModel("DAOUsuarios");
    $grid->addHelperPath(__DIR__, "");
    $grid->setQuery("queryBusqueda", array("rut" => "rut",
                                           "nombre" => "nombre",
                                           "apellido" => "apellido",
                                           "email" => "email",
                                           "region" => "region",
                                           "sistemas" => "sistemas"), 
                                   array());
    //coloca los nombres de la cabecera de la tabla y permite ordenar los registros
    $grid->setColumns(array(
            array("column_name" => "Rut",
                "column_table" => array("rut"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "u.rut"),
                "width" => "5%"),
            array("column_name" => "Nombre",
                "column_table" => array("nombres"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "u.nombres"),
                "width" => "20%"),
            array("column_name" => "Apellido",
                "column_table" => array("apellidos"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "u.apellidos"),
                "width" => "20%"),
            array("column_name" => "Email",
                "column_table" => array("email"),
                "column_type" => "method",
                "sortable" => array("active" => true,
                                    "sortable_field" => "u.email"),
                "width" => "20%"),
            
            array("column_name" => "",
                "column_table" => array("id"),
                "column_type" => "html",
                "column_html" => "<button data-toggle=\"tooltip\" type=\"button\" onclick=\"location.href='".BASE_URI."/MantenedorUsuarios/editar/%';\" class=\"btn btn-sm btn-flat btn-success\" title=\"Ver Detalle\">"
                                ."<i class=\"fa fa-edit\"></i> Editar"
                                ."</button>",
                "column_align" => "center",
                "sortable" => false,
                "width" => "5%")
        ));
    
    return $grid->getGrid();
}